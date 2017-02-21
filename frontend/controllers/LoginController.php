<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

/**
 * Index controller
 */
class LoginController extends Controller
{
    public $layout = false;
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        return $this->render('login');
    }


    public function actionLogin()
    {
        $data = Yii::$app->request->post();
        $email = $data['email'];
        $password = md5($data['password']);
        $sql = Yii::$app->db->createCommand("select * from lg_users where email='$email' AND password='$password'")->queryOne();
        if ($sql) {
            $session = Yii::$app->session;
            $session['email'] = $email;
            $session['user_id'] = $sql['user_id'];
            $session['type'] = $sql['type'];
            $session['id'] = $sql['id'];
            return $this->redirect(array('index/index'));
        } else {
            echo "<script> alert('登陆失败');location.href='?r=login/index'</script>";
        }
    }


    public function actionOut()
    {
        Yii::$app->session->removeall();
        return $this->redirect(array('index/index'));
    }


// ---------------注册--------------------------------
    public function actionRegister()
    {
        return $this->render('register');
    }


    public function actionAdd()
    {

        $data = Yii::$app->request->post();
        $email = $data['email'];
        $type = $data['type'];
        $password = md5($data['password']);

        $sql = Yii::$app->db->createCommand("select * from lg_users where email='$email'")->queryOne();
        if ($sql) {
            echo "<script> alert('邮箱已注册');location.href='?r=login/register'</script>";
        } else {
            $sql = Yii::$app->db->createCommand("insert into lg_users(email,password,type)values('$email','$password','$type')")->execute();
            if ($sql) {
                return $this->redirect(array('login/index'));
            } else {
                echo "<script> alert('注册失败');location.href='?r=login/register'</script>";
            }
        }


    }

// ---------------找回密码-------------------------------
    public function actionRes()
    {

        return $this->render('reset');

    }

    public function actionResone()
    {
        $data = Yii::$app->request->post();
        $session = Yii::$app->session;
        $email = $session['email'] = $data['email'];
        $sql = Yii::$app->db->createCommand("select * from lg_users where email='$email'")->queryOne();
        if ($sql) {
            return $this->render('resetpwd');
        } else {
            echo "<script> alert('邮箱不正确');location.href='?r=login/res'</script>";
        }

    }

    public function actionResetpwd()
    {
        $data = Yii::$app->request->post();
        // var_dump($data);die;
        $session = Yii::$app->session;
        $email = $session['email'];
        // var_dump($email);die;
        $password = md5($data['password']);
        $sql = Yii::$app->db->createCommand("update lg_users set password='$password' where email='$email'")->execute();
        if ($sql) {
            echo "<script> alert('修改成功');location.href='?r=login/index'</script>";
        } else {
            echo "<script> alert('修改失败');location.href='?r=login/resetpwd'</script>";
        }

    }


}