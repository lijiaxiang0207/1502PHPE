<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

/**
 * Index controller
 */
header("content-type:text/html;charset=utf-8");

class ResumeController extends Controller
{
    public $layout = false;

    public $enableCsrfValidation = false;

    /*----------------------------------------------------------------------------*\
                            发送基本信息，进行默认展示
    \*----------------------------------------------------------------------------*/
    public function actionResume()
    {
        $session = \Yii::$app->session;
        $user_id = $session['user_id'];
        if (empty($user_id)) {
            return $this->render('resume');
        } else {
            /*----------------------查询基本信息--------------------------*/
            $sql = "SELECT 	re_id,re_name,re_gender,re_topdegree,re_workyear,re_tel,
							re_email,re_currentState,re_content,_token,re_is_examine,
							re_currentState ,re_lasttime
					FROM lg_resume WHERE user_id = $user_id";
            $data = Yii::$app->db->createCommand($sql)->queryOne();
            return $this->render('resume', ['data' => $data]);
        }
    }

    /*----------------------------------------------------------------------------*\
                                重命名简历名称
    \*----------------------------------------------------------------------------*/
    public function actionRename()
    {
        $session = \Yii::$app->session;
        $user_id = $session['user_id'];

        if (empty($user_id)) {
            $arr['msg'] = '保存失败！';
        } else {
            $data = Yii::$app->request->post();
            $name = $data['resumeName'];
            $sql = "UPDATE lg_resume SET re_name = '$name' WHERE user_id = $user_id ";
            $bloon = Yii::$app->db->createCommand($sql)->execute();
            if ($bloon) {
                $arr['success'] = 'success';
            } else {
                $arr['msg'] = '保存失败！';
            }
        }
        echo json_encode($arr);
        die;
    }

    /*----------------------------------------------------------------------------*\
                                添加或修改基本信息
    \*----------------------------------------------------------------------------*/
    public function actionBaseinfo()
    {
        $session = \Yii::$app->session;
        $user_id = $session['user_id'];

        if (empty($user_id)) {
            $arr['msg'] = '保存失败！';
        } else {
            $data = Yii::$app->request->post();
            $name = $data['name'];
            $sex = $data['sex'];
            $highestEducation = $data['highestEducation'];
            $workYear = $data['workYear'];
            $status = $data['status'];
            $phone = $data['phone'];
            $email = $data['email'];
            $resubmitToken = $data['resubmitToken'];
            $re_lasttime = date("Y-m-d", time());

            //添加信息之前，首先判断是否已经训在，存在的话就进行修改
            $sel_sql = "SELECT re_id FROM lg_resume WHERE user_id = $user_id";
            $sel_data = Yii::$app->db->createCommand($sel_sql)->queryOne();
            if ($sel_data) {

                $sql = "UPDATE lg_resume SET 
							re_name 		= '$name',
							re_gender 		= '$sex',
							re_topdegree 	= '$highestEducation',
							re_workyear 	= '$workYear',
							re_tel 			= '$phone', 
							re_email 		= '$email',
							re_currentState = '$status',
							_token 			= '$resubmitToken',
							re_lasttime 	= '$re_lasttime'
						WHERE user_id = $user_id ";
            } else {
                $sql = "INSERT 	INTO lg_resume (re_name,re_gender,re_topdegree,
									re_workyear,re_tel,re_email,re_currentState,_token,user_id) 
						VALUES ('$name','$sex','$highestEducation','$workYear','$phone',
							'$email','$status','$resubmitToken','$user_id')";
            }
            $bloon = Yii::$app->db->createCommand($sql)->execute();
            if ($bloon) {
                $arr['msg'] = '保存成功！';
            } else {
                $arr['msg'] = '保存失败！';
            }
        }
        echo json_encode($arr);
        die;
    }


    /*----------------------------------------------------------------------------*\
                                添加或修改期望工作
    \*----------------------------------------------------------------------------*/
    public function actionWantwork()
    {
        $session = \Yii::$app->session;
        $user_id = $session['user_id'];

        if (empty($user_id)) {
            $arr['msg'] = '保存失败！';
        } else {
            $data = Yii::$app->request->post();
            $wantcity = $data['city'];
            $wanttype = $data['positionType'];
            $wantposition = $data['positionName'];
            $wantmoney = $data['salarys'];

            //添加信息之前，首先判断是否已经训在，存在的话就进行修改
            $sel_sql = "SELECT id FROM lg_wantwork WHERE user_id = $user_id";
            $sel_data = Yii::$app->db->createCommand($sel_sql)->queryOne();
            if ($sel_data) {
                $sql = "UPDATE lg_wantwork SET 
							wantcity 		= '$wantcity',
							wanttype 		= '$wanttype',
							wantposition 	= '$wantposition',
							wantmoney 		= '$wantmoney'
						WHERE user_id = $user_id ";
            } else {
                $sql = "INSERT 	INTO lg_wantwork (
									wantcity,
									wanttype,
									wantposition,
									wantmoney,
									user_id) 
						VALUES (	
									'$wantcity',
									'$wanttype',
									'$wantposition',
									'$wantmoney',
									'$user_id')";
            }
            $bloon = Yii::$app->db->createCommand($sql)->execute();
            if ($bloon) {
                $arr['msg'] = '保存成功！';
            } else {
                $arr['msg'] = '保存失败！';
            }
        }
        echo json_encode($arr);
        die;
    }


    /*----------------------------------------------------------------------------*\
                                添加或修改工作经历
    \*----------------------------------------------------------------------------*/
    public function actionWorkexperience()
    {
        $session = \Yii::$app->session;
        $user_id = $session['user_id'];

        if (empty($user_id)) {
            $arr['msg'] = "保存失败！";
        } else {
            $data = Yii::$app->request->post();
            $companyname = $data['companyName'];
            $positionname = $data['positionName'];
            $workstartyear = $data['startYear'];
            $workstartmonth = $data['startMonth'];
            $workstopyear = $data['endYear'];
            $workstopmonth = $data['endMonth'];

            //添加信息之前，首先判断是否已经训在，存在的话就进行修改
            $sel_sql = "SELECT id FROM lg_workexperience WHERE user_id = $user_id";
            $sel_data = Yii::$app->db->createCommand($sel_sql)->queryOne();
            if ($sel_data) {
                $sql = "UPDATE lg_workexperience SET 
							companyname = '$companyname',
							positionname = '$positionname',
							workstartyear = '$workstartyear',
							workstartmonth = '$workstartmonth',
							workstopyear = '$workstopyear', 
							workstopmonth = '$workstopmonth'
						WHERE user_id = $user_id ";
            } else {
                $sql = "INSERT 	INTO lg_workexperience (
									companyname,
									positionname,
									workstartyear,
									workstartmonth,
									workstopyear,
									workstopmonth,
									user_id) 
						VALUES (	
									'$companyname',
									'$positionname',
									'$workstartyear',
									'$workstartmonth',
									'$workstopyear',
									'$workstopmonth',
									'$user_id')";
            }
            $bloon = Yii::$app->db->createCommand($sql)->execute();
            if ($bloon) {
                $arr['msg'] = '保存成功！';
            } else {
                $arr['msg'] = '保存失败！';
            }
        }
        echo json_encode($arr);
        die;
    }

    /*----------------------------------------------------------------------------*\
                                添加或修改自项目经验
    \*----------------------------------------------------------------------------*/
    public function actionProjectexperience()
    {
        $session = \Yii::$app->session;
        $user_id = $session['user_id'];

        if (empty($user_id)) {
            $arr['msg'] = '保存失败！';
        } else {
            $data = Yii::$app->request->post();
            $projectname = $data['projectName'];
            $projectposition = $data['positionName'];
            $projectstartyear = $data['startYear'];
            $projectstartmonth = $data['startMonth'];
            $projectstopyear = $data['endYear'];
            $projectstopmonth = $data['endMonth'];
            $projectdesc = $data['projectRemark'];

            //添加信息之前，首先判断是否已经存在，存在的话就进行修改
            $sel_sql = "SELECT id FROM lg_projectexperience WHERE user_id = $user_id";
            $sel_data = Yii::$app->db->createCommand($sel_sql)->queryOne();
            if ($sel_data) {
                $sql = "UPDATE lg_projectexperience SET 
							projectname 		= '$projectname',
							projectposition 	= '$projectposition',
							projectstartyear 	= '$projectstartyear',
							projectstartmonth 	= '$projectstartmonth',
							projectstopyear 	= '$projectstopyear', 
							projectstopmonth 	= '$projectstopmonth',
							projectdesc 		= '$projectdesc'
						WHERE user_id = $user_id ";
            } else {
                $sql = "INSERT 	INTO lg_projectexperience (
									projectname ,	
									projectposition ,
									projectstartyear ,
									projectstartmonth,
									projectstopyear ,
									projectstopmonth ,
									projectdesc ,
									user_id) 
						VALUES (	
									'$projectname',
									'$projectposition',
									'$projectstartyear',
									'$projectstartmonth',
									'$projectstopyear', 
									'$projectstopmonth',
									'$projectdesc',
									'$user_id')";
            }
            $bloon = Yii::$app->db->createCommand($sql)->execute();
            if ($bloon) {
                $arr['msg'] = '保存成功！';
            } else {
                $arr['msg'] = '保存失败！';
            }
        }
        echo json_encode($arr);
        die;
    }

    /*----------------------------------------------------------------------------*\
                                添加或修改背景教育
    \*----------------------------------------------------------------------------*/
    public function actionEducationbackground()
    {
        $session = \Yii::$app->session;
        $user_id = $session['user_id'];

        if (empty($user_id)) {
            $arr['msg'] = '保存失败！';
        } else {
            $data = Yii::$app->request->post();
            $schoolname = $data['schoolName'];
            $schooldegree = $data['education'];
            $schoolprofessional = $data['professional'];
            $schoolstartyear = $data['startYear'];
            $schoolstopyear = $data['endYear'];

            //添加信息之前，首先判断是否已经训在，存在的话就进行修改
            $sel_sql = "SELECT id FROM lg_educationbackground WHERE user_id = $user_id";
            $sel_data = Yii::$app->db->createCommand($sel_sql)->queryOne();
            if ($sel_data) {
                $sql = "UPDATE lg_educationbackground SET 
								schoolname 			= '$schoolname', 		
								schooldegree 		= '$schooldegree', 		
								schoolprofessional 	= '$schoolprofessional', 
								schoolstartyear 	= '$schoolstartyear', 	
								schoolstopyear 		= '$schoolstopyear' 	
						WHERE user_id = $user_id ";
            } else {
                $sql = "INSERT 	INTO lg_educationbackground (
									schoolname 	,		
									schooldegree 	,	
									schoolprofessional 	,
									schoolstartyear 	,
									schoolstopyear 	,	
									user_id) 
						VALUES (	
									'$schoolname',
									'$schooldegree',
									'$schoolprofessional',
									'$schoolstartyear',
									'$schoolstopyear',
									'$user_id')";
            }
            $bloon = Yii::$app->db->createCommand($sql)->execute();
            if ($bloon) {
                $arr['msg'] = '保存成功！';
            } else {
                $arr['msg'] = '保存失败！';
            }
        }
        echo json_encode($arr);
        die;
    }


    /*----------------------------------------------------------------------------*\
                                添加或修改自我描述
    \*----------------------------------------------------------------------------*/
    public function actionDescriptself()
    {
        $session = \Yii::$app->session;
        $user_id = $session['user_id'];

        if (empty($user_id)) {
            $arr['msg'] = "保存失败！";
        } else {
            $data = Yii::$app->request->post();
            $descriptself = $data['myRemark'];

            //添加信息之前，首先判断是否已经训在，存在的话就进行修改
            $sel_sql = "SELECT id FROM lg_descriptself WHERE user_id = $user_id";
            $sel_data = Yii::$app->db->createCommand($sel_sql)->queryOne();
            if ($sel_data) {
                $sql = "UPDATE lg_descriptself SET 
							descriptself = '$descriptself'
						WHERE user_id = $user_id ";
            } else {
                $sql = "INSERT 	INTO lg_descriptself (
									descriptself,
									user_id) 
						VALUES (	
									'$descriptself',
									'$user_id')";
            }
            $bloon = Yii::$app->db->createCommand($sql)->execute();
            if ($bloon) {
                $arr['msg'] = '保存成功！';
            } else {
                $arr['msg'] = '保存失败！';
            }
        }
        echo json_encode($arr);
        die;
    }


    /*----------------------------------------------------------------------------*\
                                添加或修改作品展示
    \*----------------------------------------------------------------------------*/
    public function actionWorkdisplay()
    {
        $session = \Yii::$app->session;
        $user_id = $session['user_id'];

        if (empty($user_id)) {
            $arr['msg'] = '保存失败！';
        } else {
            $data = Yii::$app->request->post();
            $worklink = $data['url'];
            $workdesc = $data['workName'];

            //添加信息之前，首先判断是否已经训在，存在的话就进行修改
            $sel_sql = "SELECT id FROM lg_workdisplay WHERE user_id = $user_id";
            $sel_data = Yii::$app->db->createCommand($sel_sql)->queryOne();
            if ($sel_data) {
                $sql = "UPDATE lg_workdisplay SET 
							worklink = '$worklink',
							workdesc = '$workdesc'
						WHERE user_id = $user_id ";
            } else {
                $sql = "INSERT 	INTO lg_workdisplay (
									worklink,
									workdesc,
									user_id) 
						VALUES (	
									'$worklink',
									'$workdesc',
									'$user_id')";
            }
            $bloon = Yii::$app->db->createCommand($sql)->execute();
            if ($bloon) {
                $arr['msg'] = '保存成功！';
            } else {
                $arr['msg'] = '保存失败！';
            }
        }
        echo json_encode($arr);
        die;
    }


}

?>