<?php
/**
 * Created by PhpStorm.
 * User: zoco
 * Date: 16/12/29
 * Time: 18:21
 */

namespace DoubanSDK;

/**
 * Class Core
 *
 * @package DoubanSDK
 */
class Core {

    /**
     * @var resource
     */
    private $ch;

    /**
     * @var int
     */
    private $timeout = 2;

    /**
     * @var string
     */
    private $apiUrl = 'https://api.douban.com';

    /**
     * @var array
     */
    private $apiMap= array(
        'searchBook' => '/v2/book/search',
        'book' => '/v2/book',
        'searchMovie' => '/v2/movie/search',
        'movie' => '/v2/movie/subject',
        'searchMusic' => '/v2/music/search',
        'music' => '/v2/music'
    );

    /**
     * Core constructor.
     */
    public function __construct() {
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
    }

    /**
     * @param $query
     * @return mixed|string
     */
    public function searchBook($query) {
        $url = $this->apiUrl . $this->apiMap['searchBook'];
        $query = http_build_query($query);
        $url = $url . '?' . $query;
        return $result = $this->curl_http($url);
    }

    /**
     * @param $query
     * @return mixed|string
     */
    public function searchMusic($query) {
        $url = $this->apiUrl . $this->apiMap['searchMusic'];
        $query = http_build_query($query);
        $url = $url . '?' . $query;
        return $result = $this->curl_http($url);
    }

    /**
     * @param $query
     * @return mixed|string
     */
    public function searchMovie($query) {
        $url = $this->apiUrl . $this->apiMap['searchMovie'];
        $query = http_build_query($query);
        $url = $url . '?' . $query;
        return $result = $this->curl_http($url);
    }

    /**
     * @param $id
     * @return mixed|string
     */
    public function movie($id) {
        $url = $this->apiUrl . $this->apiMap['movie'];
        $url = $url . '/' . $id;
        return $result = $this->curl_http($url);
    }

    /**
     * @param $id
     * @return mixed|string
     */
    public function music($id) {
        $url = $this->apiUrl . $this->apiMap['music'];
        $url = $url . '/' . $id;
        return $result = $this->curl_http($url);
    }

    /**
     * @param $id
     * @return mixed|string
     */
    public function book($id) {
        $url = $this->apiUrl . $this->apiMap['book'];
        $url = $url . '/' . $id;
        return $result = $this->curl_http($url);
    }

    /**
     * @param       $url
     * @param array $param
     * @return mixed|string
     */
    public function curl_http($url, $param = array()) {
        curl_setopt($this->ch, CURLOPT_URL, $url);
        if ($param) {
            curl_setopt($this->ch, CURLOPT_POST, true);
            curl_setopt($this->ch, CURLOPT_POSTFIELDS, $param);
        }
        $response = curl_exec($this->ch);
        curl_close($this->ch);
        if ($response) {
            return $response;
        } else {
            return json_encode([]);
        }
    }
}