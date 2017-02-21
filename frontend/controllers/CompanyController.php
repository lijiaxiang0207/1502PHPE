<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

/**
 * Index controller
 */
header("content-type:text/html;charset=utf-8");

class CompanyController extends Controller
{
    public $layout = false;
    public $enableCsrfValidation = false;


    /*----------------------------------------------------------------------------*\
                            注册公司第一步：基本信息展示
    \*----------------------------------------------------------------------------*/
    public function actionRcompany()
    {
        return $this->renderPartial('rcompany01.php');
    }


    /*----------------------------------------------------------------------------*\
                            注册公司第一步：基本信息添加
    \*----------------------------------------------------------------------------*/
    public function actionSetone()
    {
        $data = Yii::$app->request->post();
        echo "<pre>";
        print_r($data);
        die;

        $companyallname = $data['companyName'];
        $companyshortname = $data['companyShortName'];
        $companylink = $data['companyUrl'];
        $companycity = $data['city'];
        $companyfield = $data['industryField'];
        $companysize = $data['companySize'];
        $companydevelopment = $data['financeStage'];
        $companydesc = $data['companyFeatures'];
        $cpmpanylogo = './uploads/1.png';

        $sql = "INSERT INTO lg_company (
					companyallname,companyshortname,
					companylink,companycity,companyfield,
					companysize,companydevelopment,companydesc,
					companylogo
				) VALUES (
					'$companyallname','$companyshortname',
					'$companylink','$companycity',
					'$companyfield','$companysize',
					'$companydevelopment','$companydesc',
					'$cpmpanylogo'
				) ";
        $bloon = Yii::$app->db->createCommand($sql)->execute();
        /*-----------------添加成功，跳转第二步----------------*/
        if ($bloon) {
            // $company_id = Yii::$app->db->getLastInsertId();
            // $session = Yii::$app->session();
            // $session['company_id'] = $company_id;
            // echo "<script>alert('添加成功，跳转第二步！');location.href='?r=company/settwo'</script>";
            $arr['success'] = true;
            $arr['msg'] = '添加成功！';

        } /*-----------------添加失败，返回重添加----------------*/
        else {
            // echo "<script>alert('添加失败，返回重添加！');history.go(-1)</script>";
            $arr['success'] = false;
            $arr['msg'] = '添加失败！';
        }
        echo json_encode($arr);
        die;
    }

    /*----------------------------------------------------------------------------*\
                            注册公司第二步：公司标签展示
    \*----------------------------------------------------------------------------*/
    public function actionSettwo()
    {
        return $this->render('tag.php');
    }

    /*----------------------------------------------------------------------------*\
                            注册公司第二步：公司标签添加
    \*----------------------------------------------------------------------------*/
    public function actionSettwo_pro()
    {
        echo '第二步';
        die;
    }

    /*----------------------------------------------------------------------------*\
                            注册公司第三步：创始团队展示
    \*----------------------------------------------------------------------------*/
    public function actionSetthree()
    {
        return $this->render('createteam.php');
    }

    /*----------------------------------------------------------------------------*\
                            注册公司第三步：创始团队添加
    \*----------------------------------------------------------------------------*/
    public function actionSetthree_pro()
    {
        echo '第三步';
        die;
    }

    /*----------------------------------------------------------------------------*\
                            注册公司第四步：公司产品展示
    \*----------------------------------------------------------------------------*/
    public function actionSetfour()
    {
        return $this->render('companyproduct.php');
    }

    /*----------------------------------------------------------------------------*\
                            注册公司第四步：公司产品添加
    \*----------------------------------------------------------------------------*/
    public function actionSetfour_pro()
    {
        echo '第四步';
        die;
    }

    /*----------------------------------------------------------------------------*\
                            注册公司第五步：公司介绍展示
    \*----------------------------------------------------------------------------*/
    public function actionSetfive()
    {
        return $this->render('companyintro.php');
    }

    /*----------------------------------------------------------------------------*\
                            注册公司第五步：公司介绍添加
    \*----------------------------------------------------------------------------*/
    public function actionSetfive_pro()
    {
        echo '第五步';
        die;
    }


}

?>