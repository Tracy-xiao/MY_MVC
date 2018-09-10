<?php
/**
 * Created by PhpStorm.
 * User: 武晓
 * Date: 2018/8/31
 * Time: 8:33
 */
//var_dump($_SERVER);die;
if(empty($_SERVER['PATH_INFO'])){
    $_SERVER['PATH_INFO'] = '/home/home2';
}
$pathInfo = $_SERVER['PATH_INFO'];

$pathInfo = ltrim($pathInfo,'/');

$path = explode('/',$pathInfo);

include 'common/db.config.php';

include 'vendor/db.class.php';

$GLOBALS['data'] = new db($config);

$host = $_SERVER['HTTP_HOST'];

$array = explode('.',$_SERVER['SERVER_NAME']);

define("__PUBLIC__",'http://106.12.29.219/myself/public');
//echo __PUBLIC__;die;
include "controller/".$path[0].".class.php";

@call_user_func_array($path,array());
