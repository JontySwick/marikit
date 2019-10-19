<?php

namespace app\controllers;

use app\models\News;
use app\components\PhpQueryRbcParser as Parser;
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
        $allNews = News::find()->select(['xml_id'])->indexBy(['xml_id'])->asArray()->all();

        $newsUrls = Parser::getNewsUrl();

        foreach ($newsUrls as $index => $url) {
            $arUrl = parse_url($url);
            if (strpos($arUrl['host'], 'rbc.ru') === false) {
                continue; #Реклама
            }

            $arPath = explode('/', $arUrl['path']);
            $hash = end($arPath);

            if ($hash && !isset($allNews[$hash])) {
                $newsInfo = Parser::parseOneNews($url);

                $obNews = new News();
                $obNews->name = $newsInfo['name'];
                $obNews->xml_id = $hash;
                $obNews->img = $newsInfo['img'];
                $obNews->preview_text = $newsInfo['preview_text'];
                $obNews->detail_text = $newsInfo['detail_text'];

                $result = $obNews->save();

                if($result){

                }
            }
        }

        return '';
    }
}
