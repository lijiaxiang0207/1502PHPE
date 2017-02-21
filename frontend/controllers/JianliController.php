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

    // 我的简历
    public function actionJianli()
    {
        return $this->render('jianli');
    }
}

?>