<?php

/**
 * Created by PhpStorm.
 * User: 武晓
 * Date: 2018/8/31
 * Time: 8:36
 */
class a
{

    function b()
    {
//        $aa = $GLOBALS['data']->query('show tables;')->fetchAll();
//        $aa = $GLOBALS['data']->add('a',array('id'=>null,'name'=>'你'));
//        $aa = $GLOBALS['data']->update('a',array('name'=>'啥'),$condition = 'id=8');
        $aa = $GLOBALS['data']->delete('a',7);
    }
}