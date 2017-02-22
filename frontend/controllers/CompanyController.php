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
            $arr['success'] = true;
            $arr['msg'] = '添加成功！';

        } /*-----------------添加失败，返回重添加----------------*/
        else {
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
    public function actionSettwopro()
    {
        $data = Yii::$app->request->post();
        print_r($data);
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


    //公司验证  first

    public function actionVctstep1()
    {

        if (Yii::$app->request->isGet) {
            return $this->render('step1');
        }

        //筛选
        $post = Yii::$app->request->post() ? Yii::$app->request->post() : '';
        if (empty($post)) {
            echo "<script>alert('非法输入数据');history.go(-1)</script>";
        }

        //验证通过进入第二步
        return $this->render('step2', ['post' => $post]);


    }

    //公司验证 second
    public function actionVctstep2()
    {

        if (Yii::$app->request->isGet) {

            return $this->redirect('?r=company/vctstep1');
        }


        $post = Yii::$app->request->post() ? Yii::$app->request->post() : '';
        if (empty($post)) {
            echo "<script>alert('非法输入数据');history.go(-1)</script>";
        }

        $sql = "INSERT  INTO lg_companyact(`c_name`,c_stu,c_email,c_tel) VALUES('" . $post['companyName'] . "', '1','" . $post['email'] . "','" . $post['tel'] . "')";
        $stu = Yii::$app->db->createCommand($sql)->execute();

        if ($stu) {
            return $this->render('step3');
        } else {
            echo "入库失败";
        }


    }

    /*----------------------------------------------------------------------------*\
                                       公司详情页
    \*----------------------------------------------------------------------------*/
    public function actionCpinfo()
    {

        $data = Yii::$app->request->get();
        $company_id = $data['company_id'];
        // echo "<pre>";
        // print_r($data);die;
        $sql = "SELECT * FROM `lg_company` where id = $company_id";
        $arr = Yii::$app->db->createCommand($sql)->queryOne();
        return $this->renderPartial('cpinfo', ['company' => $arr]);
    }


}

?>