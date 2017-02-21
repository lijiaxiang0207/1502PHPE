<?php
namespace frontend\controllers;

use yii\web\Controller;

/**
 * Index controller
 */
class CreateController extends Controller
{
    public $layout = false;
    public $enableCsrfValidation = false;

    public function actionIndex()
    {

        header('content-type:text/html;charset=utf-8');
        $arr = $this->get_cat_array();
        //var_dump($arr);die;
        return $this->render('create', ['arr' => $arr]);
    }


    public function get_cat_array($parent_id = 0)
    {
        // $category=Yii::$app->db->createCommand("select 'pcate_id', 'pcate_name', 'parent_id' from lg_users ")->queryAll();
        $category = (new \yii\db\Query())->select(['pcate_id', 'pcate_name', 'parent_id'])->from('lg_position_category')->all();

        $arr = array();
        //var_dump($category);die;
        foreach ($category as $k => $row) {
            // 对每个分类进行循环。
            if ($category[$k]['parent_id'] == $parent_id) {
                //如果有子类
                $row['child'] = $this->get_cat_array($category[$k]['pcate_id']);
                //调用函数，传入参数，继续查询下级
                $arr[] = $row; //组合数组
            }
        }
        return $arr;
    }

    /**-------------------------------- 待定简历页面 --------------------------------**/
    public function actionInterview()
    {
        return $this->renderPartial('interview');
    }


    /**------------------------------- 不合适简历页面 --------------------------------**/
    public function actionRefuse()
    {
        return $this->renderPartial('refuse');
    }


    /**------------------------------ 自动过滤简历页面 --------------------------------**/
    public function actionFilter()
    {
        return $this->renderPartial('filter');
    }


    /**------------------------------ 有效职位页面 --------------------------------**/
    public function actionPositions()
    {
        return $this->renderPartial('positions');
    }


}