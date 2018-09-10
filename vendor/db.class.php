<?php

/**
 * Created by PhpStorm.
 * User: 武晓
 * Date: 2018/8/31
 * Time: 8:45
 */
class db
{

    private static $link,$result;

    /**
     * db constructor.
     * @param $config
     * @desc构造函数拼写连接数据库sql
     */
    public function __construct($config)
    {
        self::$link = mysqli_connect(
            $config['host'],
            $config['username'],
            $config['password'],
            $config['database']
        );
        //设置字符集
        mysqli_query(self::$link,'set names utf8');
    }

    /**
     * @param $sql
     * @return $this
     * @desc 执行sql
     */
    public function query($sql)
    {
        self::$result = mysqli_query(self::$link,$sql);
        return $this;
    }

    /**
     * @return array|null
     * @desc转为数组
     */
    public function fetchAll()
    {
        $last = mysqli_fetch_all(self::$result,MYSQLI_ASSOC);
        return $last;
    }



    /**
     * @return array|null
     * @desc 转数组 （一维）
     */
    public function fetchOne()
    {
        $last = mysqli_fetch_array(self::$result,MYSQLI_ASSOC);
        return $last;
    }
    /**
     * @param $tableName
     * @param array $array
     * @desc 添加操作
     */
    public function add($tableName,$array = array())
    {
        $value = '(';
        foreach($array as $k => $v)
        {
            is_string($v) ? $value .= "'".$v."'" : '';
            if(empty($v)){
                $v = 'null';
                $value .= $v.",";
            }
        }
        $value = rtrim($value);
        $value .= ")";
        $sql = 'insert into '.$tableName.' values '.$value;
        $this->query($sql);
    }

    /**
     * @param $tableName
     * @param array $array
     * @param string $condition
     * @desc 修改操作
     */
    public function update($tableName,$array = array(),$condition = '')
    {
        $value = '';
        foreach($array as $k => $v)
        {
            is_string($v) ? $value .= $k ."="."'".$v."'"."," : $value .= $k."=".$v.",";
            $value = rtrim($value,',');
            $sql = 'update '.$tableName.' set '.$value.' where '.$condition;
            $this->query($sql);
        }
    }

    /**
     * @param $tableName
     * @param $id
     * @desc 删除操作
     */
    public function delete($tableName,$id)
    {
        $sql = 'delete from '.$tableName.' where id='.$id;
        $this->query($sql);
    }

}