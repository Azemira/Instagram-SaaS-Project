<?php

/**
 * Get Proxy Info
 * @param  string  $proxy [description]
 * @return string        [description]
 */
function getProxyInfo($proxy)
{
    if (!is_string($proxy) && !is_array($proxy)) {
        return false;
    }

    $client = new \GuzzleHttp\Client();
    $res = $client->request('GET', 'http://ipinfo.io/json',
        [
            "verify" => SSL_ENABLED,
            "timeout" => 10,
            "proxy" => $proxy
        ]);
    $body = $res->getBody();

    if(empty($body)) {
        return false;
    }

    return $body;
}