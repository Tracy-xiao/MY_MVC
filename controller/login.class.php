<?php

/**
 * Created by PhpStorm.
 * User: 武晓
 * Date: 2018/8/31
 * Time: 11:46
 */

class login
{

    /**
     * @desc 跳转登录界面
     */
    function doLogin()
    {
        include "view/phpmyadmin/login.html";
    }

    function actionLogin()
    {
        $user = $_POST['pma_username'];
        $password = $_POST['pma_password'];
//        var_dump($_POST);exit;

        $result = $GLOBALS['data']->query("select * from mysql.`user` where `User`='".$user."'")->fetchOne();
        if(empty($result)){
            die('此用户不存在');
        }else{
            $aa = $GLOBALS['data']->query('select '."'".$result['Password']."'".'=password("'.$password.'") as res;')->fetchOne();
            if($aa['res'] != 1){
                die('密码有误');
            }else{
                echo '欢迎登陆成功';
                $_SESSION['user'] = $result;
            }
        }
    }
}