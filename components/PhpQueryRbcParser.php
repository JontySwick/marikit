<?php

namespace app\components;


use phpQuery;

class PhpQueryRbcParser extends RbcParser
{
    function getNewsUrl($lastDate)
    {
        if(!$lastDate){
            $lastDate = time();
        }
        $newsList = self::getNewsList($lastDate);
        $arNewsUrls = [];
        foreach ($newsList['items'] as $arNews) {
            $arNewsUrls['url'][] = phpQuery::newDocument($arNews['html'])->find('a')->attr('href');
            $arNewsUrls['last_news_date'] = $arNews['publish_date_t'];
        }

        return $arNewsUrls;
    }

    function parseOneNews($url)
    {
        $response = self::makeRequest($url);

        $phpJQueryResponse = phpQuery::newDocument($response);

        $name = $phpJQueryResponse->find('.article__header__title')->text();
        $img = $phpJQueryResponse->find('img.article__main-image__image')->attr('src');

        $obDetailText = $phpJQueryResponse->find('.article__text p');
        $previewText = '<p>' . mb_strimwidth($obDetailText->text(), 0, 200, '...') . '</p>';

        $arDetailText = [];
        foreach ($obDetailText as $oneP) {
            $arDetailText[] = pq($oneP)->html();
        };
        $detailText = '<p>' . implode('</p><p>', $arDetailText) . '</p>';

        $result = [
            'name' => $name,
            'img' => $img,
            'preview_text' => $previewText,
            'detail_text' => $detailText,
        ];

        return $result;
    }
}
