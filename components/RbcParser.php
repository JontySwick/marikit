<?php

namespace app\components;

use yii\helpers\Json;
use linslin\yii2\curl;

abstract class RbcParser
{
    function makeRequest($url){
        $curl = new curl\Curl();
        $curl->setOption(CURLOPT_FOLLOWLOCATION, true);
        $response = $curl->get($url);
        return $response;
    }

    function getNewsList($lastDate = false){
        if(!$lastDate){
            $lastDate = time();
        }
        $response = self::makeRequest('https://www.rbc.ru/v10/ajax/get-news-feed/project/rbcnews/lastDate/' . $lastDate . '/limit/16');
        $response = Json::decode($response, true);
        return $response;
    }

    abstract function getNewsUrl();

    abstract function parseOneNews($url);
}