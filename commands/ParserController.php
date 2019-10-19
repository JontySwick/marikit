<?php

namespace app\commands;

use app\models\News;
use app\components\PhpQueryRbcParser as Parser;
use Exception;
use yii\console\Controller;
use yii\console\ExitCode;

class ParserController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        echo "For parse 15 news from rbc.ru enter parser/parse \n";

        return ExitCode::OK;
    }

    /**
     * Parse news from rbc.ru
     * @param int $count required amount of news
     * @return int Exit code
     */
    public function actionParse($count = 15)
    {
        //Наверное, стоит тут добавить фильтр по дате добавления/изменения (если бы она у нас была)
        $allNews = News::find()->select(['xml_id'])->indexBy(['xml_id'])->asArray()->all();

        $count = intval($count);
        if($count){
            $lastDate = time();
            while ($count > 0){
                $newsUrls = Parser::getNewsUrl($lastDate);
                $lastDate = $newsUrls['last_news_date'];
                foreach ($newsUrls['url'] as $index => $url) {
                    if($count <=0){
                        return ExitCode::OK;
                    }
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
                        echo var_dump('<pre>',$result) ."\n";
                        if($result){
                            $count--;
                            echo var_dump('<pre>',$count) ."\n";
                        }
                    }
                }
                echo var_dump('<pre>',$lastDate) ."\n";
            }
        }

        return ExitCode::OK;
    }
}
