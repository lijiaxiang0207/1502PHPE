<?php
namespace frontend\controllers;

use yii\web\Controller;

/**
 * Index controller
 */
header("content-type:text/html;charset=utf-8");

class IndexController extends Controller
{
    public $layout = false;
    public $enableCsrfValidation = false;

    //首页
    public function actionIndex()
    {


    }
}

?>