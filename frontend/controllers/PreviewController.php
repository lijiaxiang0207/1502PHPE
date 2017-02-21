<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

header("content-type:text/html;charset=utf-8");

class PreviewController extends Controller
{
    public $layout = false;

    public $enableCsrfValidation = false;

    /*----------------------------------------------------------------------------*\
                                发送信息到预览模板
    \*----------------------------------------------------------------------------*/
    public function actionPreview()
    {
        $session = \Yii::$app->session;
        $user_id = $session['user_id'];

        /*------------------查询基本信息------------------------------*/
        $sql = "SELECT 	re_name,re_gender,re_topdegree,re_workyear,re_tel,
						re_email,re_currentState
				FROM lg_resume WHERE user_id = $user_id";
        $data = Yii::$app->db->createCommand($sql)->queryOne();

        /*------------------查询期望工作------------------------------*/
        $sql = "SELECT 	wantcity,wanttype,wantposition,wantmoney
				FROM lg_wantwork WHERE user_id = $user_id";
        $data_wantwork = Yii::$app->db->createCommand($sql)->queryOne();

        /*------------------查询工作经历------------------------------*/
        $sql = "SELECT 	companyname,positionname,workstartyear,workstartmonth,
						workstopyear,workstopmonth
				FROM lg_workexperience WHERE user_id = $user_id";
        $data_workexperience = Yii::$app->db->createCommand($sql)->queryOne();

        /*------------------查询项目经验------------------------------*/
        $sql = "SELECT 	projectname,projectposition,projectstartyear,projectstartmonth,
						projectstopyear,projectstopmonth,projectdesc
				FROM lg_projectexperience WHERE user_id = $user_id";
        $data_projectexperience = Yii::$app->db->createCommand($sql)->queryOne();

        /*------------------查询教育背景------------------------------*/
        $sql = "SELECT 	schoolname,schooldegree,schoolprofessional,schoolstartyear,
						schoolstopyear
				FROM lg_educationbackground WHERE user_id = $user_id";
        $data_educationbackground = Yii::$app->db->createCommand($sql)->queryOne();

        /*------------------查询自我描述------------------------------*/
        $sql = "SELECT 	descriptself
				FROM lg_descriptself WHERE user_id = $user_id";
        $data_descriptself = Yii::$app->db->createCommand($sql)->queryOne();

        /*------------------查询作品展示------------------------------*/
        $sql = "SELECT 	worklink,workdesc
				FROM lg_workdisplay WHERE user_id = $user_id";
        $data_workdisplay = Yii::$app->db->createCommand($sql)->queryOne();

        return $this->render('preview', [
            'data' => $data,
            'data_wantwork' => $data_wantwork,
            'data_workexperience' => $data_workexperience,
            'data_projectexperience' => $data_projectexperience,
            'data_educationbackground' => $data_educationbackground,
            'data_descriptself' => $data_descriptself,
            'data_workdisplay' => $data_workdisplay,
        ]);
    }

}

?>