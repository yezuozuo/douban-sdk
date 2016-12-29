<?php
/**
 * Created by PhpStorm.
 * User: zoco
 * Date: 16/12/29
 * Time: 18:24
 */

namespace DoubanSDK;

/**
 * Class Proxy
 *
 * @package DoubanSDK
 */
class Proxy {

    /**
     * @var
     */
    private $ctx;

    /**
     * @var Core
     */
    private $doubanAPI;

    /**
     * Proxy constructor.
     */
    public function __construct() {
        $this->doubanAPI = new Core();
    }

    /**
     * @param $keyword
     * @param $index
     * @param $count
     * @return mixed
     */
    public function searchBook($keyword, $index, $count) {
        $keyword = mb_substr($keyword, 0, 100, 'utf-8');
        $query   = ['q' => $keyword, 'start' => $index, 'count' => $count];
        $results = json_decode($this->doubanAPI->searchBook($query), true);

        return $results;
    }

    /**
     * @param $keyword
     * @param $index
     * @param $count
     * @return mixed
     */
    public function searchMusic($keyword, $index, $count) {
        $query   = ['q' => $keyword, 'start' => $index, 'count' => $count];
        $results = json_decode($this->doubanAPI->searchMusic($query), true);

        return $results;
    }

    /**
     * @param $keyword
     * @param $index
     * @param $count
     * @return array
     */
    public function searchMovie($keyword, $index, $count) {
        $keyword = mb_substr($keyword, 0, 100, 'utf-8');
        $query   = ['q' => $keyword, 'start' => $index, 'count' => $count];
        $results = json_decode($this->doubanAPI->searchMovie($query), true);

        return $results;
    }

    /**
     * @param $id
     * @return array|mixed
     */
    public function bookProfile($id) {
        $res = json_decode($this->doubanAPI->book($id), true);

        return $res;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function musicProfile($id) {
        $res = json_decode($this->doubanAPI->music($id), true);

        return $res;
    }

    /**
     * 调取电影的数据
     *
     * @param $id
     * @return array|mixed
     */
    public function movieProfile($id) {
        $res = json_decode($this->doubanAPI->movie($id), true);

        return $res;
    }

}