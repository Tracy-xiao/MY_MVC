<?php

/**
 * Created by PhpStorm.
 * User: 武晓
 * Date: 2018/9/2
 * Time: 15:45
 */
class first
{

    /**
     * @desc
     * 数据库名列表
     */
    public function home()
    {
        $db = $GLOBALS['data']->query('show databases;')->fetchAll();
        foreach($db as $k => $v){
            $db[$k] = $v['Database'];
        }
        include "view/phpmyadmin/home.html";
    }

    /**
     * @desc 表名列表
     */
    public static function getTable()
    {
        $database = $_GET['database'];
        $GLOBALS['data']->query("use $database;");
        $result =$GLOBALS['data'] ->query('show tables;')->fetchAll();
        $jsonString = json_encode($result);
        $jsonString = str_replace("Tables_in_$database",'name',$jsonString);
        $array = json_decode($jsonString,true);
        include "view/phpmyadmin/table_list.html";
        die;
    }

    public static function getTableIndex()
    {
        $database = $_GET['database'];
        $table = $_GET['table'];
        include "view/phpmyadmin/table_index.html";
        die;
    }

    /**
     * @desc 显示字段
     */
    public static function fieldIndex()
    {
        $database = $_GET['database'];
        $table = $_GET['table'];
        $array = $GLOBALS['data']->query("desc $database.$table")->fetchAll();
        include "view/phpmyadmin/field_index.html";
        die;
    }

    /**
     * @desc 显示索引
     */
    public static function index()
    {
        include "view/phpmyadmin/index.html";
    }


    /**
     * 展示数据库中所有的表
     */
    public static function tables()
    {
        $database = $_GET['database'];
        $GLOBALS['data']->query('use '.$database.";");
        $tables = $GLOBALS['data']->query('show tables;')->fetchAll();
        $json = json_encode($tables);
        $json = str_replace("Tables_in_$database",'name',$json);
        $tables = json_decode($json,true);
        include "view/phpmyadmin/tables.html";
    }

    /**
     * @desc 展示表的内容
     */
    public static function table_detail()
    {
        $table = $_GET['table'];
        $database = $_GET['database'];
        $GLOBALS['data']->query("use $database;");
        $array = $GLOBALS['data']->query("select * from $table")->fetchAll();
        foreach($array as $k => $v){
            $index = array_keys($v);
            break;
        }
        include "view/phpmyadmin/table_detail.html";
    }

    /**
     *@desc 新建数据库
     */
    public static function news()
    {
        $array = $GLOBALS['data']->query('show databases;')->fetchAll();
        include "view/phpmyadmin/new.html";
    }

    /**
     * @desc 新建表
     */
    public static function new_table()
    {
        $database = $_GET['database'];
        $sql = $_GET['sql'];
        include "view/phpmyadmin/new_table.html";
    }


    public function add()
    {
        $database = $_POST['db'];
        $data = $_POST;
        var_dump($data);exit;
        if(empty($data['orig_num_fields'])){
            $data['orig_num_fields'] = 4;
        }
        $sql = 'create table '.$_POST['table'].'('."<br>";
        $sql2 = '';
        for($i=0;$i<$data['orig_num_fields'];$i++) {
            $sql2 .= $_POST['field_name'][$i] . ' ' . $_POST['field_type'][$i] . '(' . $_POST['field_length'][$i] . ')' . $_POST['field_null'][$i] . ' ' . $_POST['field_extra'][$i] . ',' . "<br>";
        }
        $sql .= $sql2;
        $sql .= 'primary key('.$data['field_name'][0].')'."<br>".')'.'ENGINE='.$data['tbl_storage_engine'].' '.'DEFAULT'.' charset=utf8 collate=utf8_general_ci;';
//        echo $sql;exit;
        $GLOBALS['data']->query('use '.$data['db']);
        $result = $GLOBALS['data']->query($sql);
        if($result){
            echo "成功";
        }else{
            echo "失败";
        }
    }

    /**
     * @desc dialog插件弹框
     */
    public function dialog()
    {
        include "view/phpmyadmin/dialog.html";
    }

    /**
     * @desc sql页面
     */
    public function sql()
    {
        include "view/phpmyadmin/sql.html";
    }

    /**
     * @desc 状态页面
     */
    public function status()
    {
        include "view/phpmyadmin/status.html";
    }

    /**
     * @desc 账户页面
     */
    public function user()
    {
        include "view/phpmyadmin/user.html";
    }

    /**
     * @desc 导出页面
     */
    public function out()
    {
        include "view/phpmyadmin/out.html";
    }

    /**
     * @desc 导入页面
     */
    public function in()
    {
        include "view/phpmyadmin/in.html";
    }

    /**
     * @desc 设置页面
     */
    public function setting()
    {
        include "view/phpmyadmin/setting.html";
    }

    /**
     * @desc copy页面
     */
    public function copy()
    {
        include "view/phpmyadmin/copy.html";
    }

    /**
     * @desc 变量页面
     */
    public function variate()
    {
        include "view/phpmyadmin/variate.html";
    }

    /**
     * @desc 字符集页面
     */

    public function strings()
    {
        include "view/phpmyadmin/strings.html";
    }

    /**
     * @desc 引擎页面
     */
    public function engine()
    {
        include "view/phpmyadmin/engine.html";
    }

    /**
     * @desc 插件页面
     */
    public function plug()
    {
        include "view/phpmyadmin/plug.html";
    }
}