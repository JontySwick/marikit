<?php


namespace app\components;

class RegExpRbcParser extends RbcParser
{

    function getNewsUrl()
    {
        $newsList = self::getNewsList();
        $previewHtml = '';
        foreach ($newsList['items'] as $arNews) {
            $previewHtml .= htmlspecialchars($arNews['html']);
        }

        preg_match_all('/href=&quot;(.+)&quot;/', $previewHtml, $urlMatches, PREG_PATTERN_ORDER);
        return $urlMatches[1];
    }

    function parseOneNews($url)
    {
        $result = [];

        $response = self::makeRequest($url);
        $news = htmlspecialchars($response);

        $arPattens = [
            'name' => '(itemprop=&quot;headline&quot;&gt;(.+)&lt;\/span&gt;)',
            'img' => '(&lt;img src=&quot;(.+?)&quot; class=&quot;article__main-image__image)',
            'detail_text' => '(&lt;p&gt;(.*)&lt;\/p&gt;)',
        ];
        foreach ($arPattens as $fieldName => $patten) {
            preg_match_all($patten, $news, $newsMatches, PREG_PATTERN_ORDER);
            $result[$fieldName] = $newsMatches[1];
        }

        $preparedText = implode('</p><p>', $result['detail_text']);
        $previewText = '<p>' . (mb_strimwidth($preparedText, 0, 193, '...') ). '</p>'; #193 символа + 7 сиволов на <p></p>
        $detailText = htmlspecialchars_decode('<p>' . $preparedText . '</p>');

        $result['name'] = current($result['name']);
        $result['img'] = current($result['img']);
        $result['preview_text'] = $previewText;
        $result['detail_text'] = $detailText;

        return $result;
    }
}