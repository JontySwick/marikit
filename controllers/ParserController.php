<?php

namespace app\controllers;

use app\models\News;
use Exception;
use yii\helpers\Json;
use yii\helpers\VarDumper;
use yii\web\Controller;
use linslin\yii2\curl;

class ParserController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        #return $this->render('index');
    }

    /**
     * Parse action.
     *
     * @return Response|string
     * @throws Exception
     */
    public function actionParse()
    {
        $lastDate = time();
        $previewText = '';

        $curl = new curl\Curl();
        $curl->setOption(CURLOPT_FOLLOWLOCATION, true);
        $response = $curl->get('https://www.rbc.ru/v10/ajax/get-news-feed/project/rbcnews/lastDate/' . $lastDate . '/limit/16');
        $response = Json::decode($response, true);

        foreach ($response['items'] as $arNews) {
            $previewText .= htmlspecialchars($arNews['html']);
        }

        preg_match_all('/href=&quot;(.+)&quot;/', $previewText, $urlMatches, PREG_PATTERN_ORDER);
        $allNews = News::find()->select(['xml_id'])->indexBy(['xml_id'])->asArray()->all();
        VarDumper::dump($urlMatches);
        foreach ($urlMatches[1] as $index => $url) {
            $arUrl = parse_url($url);
            if(strpos($arUrl['host'],'rbc.ru') === false){
                continue; #Реклама
            }

            $arPath = explode('/', $arUrl['path']);
            $hash = end($arPath);

            if ($hash && !isset($allNews[$hash])) {
                $response = $curl->get($url);
                $news = htmlspecialchars($response);

                $arNews = [];
                $arPattens = [
                    'name' => '(itemprop=&quot;headline&quot;&gt;(.+)&lt;\/span&gt;)',
                    'img' => '(&lt;img src=&quot;(.+?)&quot; class=&quot;article__main-image__image)',
                    'detail_text' => '(&lt;p&gt;(.*)&lt;\/p&gt;)',
                ];
                foreach ($arPattens as $fieldName => $patten) {
                    preg_match_all($patten, $news, $newsMatches, PREG_PATTERN_ORDER);
                    $arNews[$fieldName] = $newsMatches[1];
                }

                $preparedText = implode('</p><p>', $arNews['detail_text']);
                $previewText = '<p>' . (mb_strimwidth($preparedText, 0, 193, '...') ). '</p>'; #193 символа + 7 сиволов на <p></p>
                $detailText = htmlspecialchars_decode('<p>' . $preparedText . '</p>');

                $obNews = new News();
                $obNews->name = current($arNews['name']);
                $obNews->xml_id = $hash;
                //$obNews->img = current($arNews['img']);
                $obNews->preview_text = $previewText;
                $obNews->detail_text = $detailText;
                VarDumper::dump($obNews);
                $obNews->save();
            }
        }
        return '';
    }
}
