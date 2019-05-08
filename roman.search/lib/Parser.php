<?php
namespace Roman\Search;

class Parser {

    private function parserPage($url, $type) {
        if(!$url) return false;
        $output = curl_init();
        curl_setopt($output, CURLOPT_URL, $url);
        curl_setopt($output, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($output, CURLOPT_HEADER, 0);
        $out = curl_exec($output);
        curl_close($output);

        switch ($type) {
            case "link":
                preg_match_all('|<a.* href=(.*)>(.*)</a>|U', $out, $result);
                break;
            case "img":
                preg_match_all('/<img[^>]+src="(.*?)"[^>]*>/',$out, $result);
                break;
            case "block":
                preg_match_all('/<div>(.*?)<\/div>/',$out, $result);
                break;
            default: $result = "";
        }

        if(!$result) return false;
        return $result[0];
    }

    public function enter($url, $type) {
        $obj = new Parser();
        if($parse = $obj->parserPage($url, $type)) {
            $data = array();
            $data["name"] = $url;
            $data["content"] = $parse;
            $data["type"] = $type;
            $data["count"] = count($parse)-1;

            return $data;
        }
        return false;
    }

}