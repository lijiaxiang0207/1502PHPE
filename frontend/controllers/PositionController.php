<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

/**
 * Index controller
 */
header("content-type:text/html;charset=utf-8");

class PositionController extends Controller
{
    public $layout = false;
    public $enableCsrfValidation = false;


     /**-------------------------------- 职位详情页 ---------------------------**/

    public function  actionJobdetail()
    {
        //根据接收的职位id查询职位信息

        $position_id = Yii::$app -> request -> get('position_id');

        if (!isset($position_id)||empty($position_id))
        {
            echo "你访问的页面不存在";die;
        }

        $sql = "SELECT position_name,position_id,salaryMin,workcity,position_demand,workYear,education,department,c.id,c.companyallname,companylogo,companyfield,positionAddress,p.positionAdvantage,p.positionDetail,p.jobNature  FROM `lg_position` as p LEFT JOIN lg_company as c ON p.company_id = c.id WHERE p.position_id = $position_id";
        $res = Yii::$app -> db -> createCommand($sql) -> queryOne();

//           var_dump($res);die;
        return $this -> render('jobdetail',['res'=>$res]);
    }



    /**-------------------------------- 订阅职位列表页面 --------------------------------**/
    public function actionScribelist()
    {
        return $this->renderPartial('scribelist');
    }



    /**-------------------------------- 订阅职位添加页面 --------------------------------**/
    public function actionScribeadd()
    {
        return $this->renderPartial('scribeadd');
    }

    public function actionScribeadd2(){
        $data = Yii::$app->request->post();
        var_dump($data);die;
    }

}