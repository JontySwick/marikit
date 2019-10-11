<?php

namespace app\controllers;

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
        $response = $curl->get('https://www.rbc.ru/v10/ajax/get-news-feed/project/rbcnews/lastDate/' . $lastDate . '/limit/22');
        $response = Json::decode($response, true);

        foreach ($response['items'] as $arNews){
            $previewText .= htmlspecialchars($arNews['html']);
        }

        preg_match_all('/href=&quot;(.+)&quot;/', $previewText, $urlMatches, PREG_PATTERN_ORDER);
        foreach ($urlMatches[1] as $url) {
            $arUrl = parse_url($url);
            $arPath = explode('/', $arUrl['path']);
            $hash = end($arPath);
            if($hash){
                $response = $curl->get('https://www.rbc.ru/v10/ajax/news/slide/' . $hash);
                $response = Json::decode($response, true);

                $news = htmlspecialchars($response['html']);

                VarDumper::dump($url, 10, true);
                VarDumper::dump($response['html'], 10, true);
                preg_match_all('/(itemprop=&quot;headline&quot;&gt;(.+)&lt;\/span&gt;)|(&lt;p&gt;(.*)&lt;\/p&gt;)/', $news, $matches, PREG_PATTERN_ORDER);
                VarDumper::dump($matches, 10, true);

                break;
            }
        }

        #https://www.rbc.ru/v10/ajax/news/slide/5da0de1f9a7947d805a90f4b?slide=8
        #VarDumper::dump($response, 10, true);
        #var_dump($response);
        die();
        return '';
    }
}
