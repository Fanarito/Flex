<?php
function get_url_contents($url) {
    $crl = curl_init();

    curl_setopt($crl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0');
    curl_setopt($crl, CURLOPT_URL, $url);
    curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($crl, CURLOPT_CONNECTTIMEOUT, 0);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);

    $ret = curl_exec($crl);
    curl_close($crl);
    return $ret;
}

function getImage($name) {
    $json = get_url_contents('http://ajax.googleapis.com/ajax/services/search/images?v=1.0&q=' . str_replace(" ", "+", $name));

    $data = json_decode($json);
    return $data->responseData->results[0]->url;
}
?>