<?php
namespace frontend\controllers;

use frontend\models\Position;
use frontend\models\PositionCate;
use Yii;
use yii\web\Controller;

/**
 * Index controller
 */
header("content-type:text/html;charset=utf-8");
class IndexController extends Controller
{
    public $layout = false;

    public $enableCsrfValidation = false;


    /********************************* 前台首页 **********************************/

    public function actionIndex()
    {
        /**
         * 侧栏展示出分类
         */
        $data = PositionCate::find()->asArray()->all();
        $cate = $this->CateSonTree($data);

        /********************** 热门职位 && 最新职位 Begin *******************************/
        //更新时间排序
        $t_sql = "	SELECT 	position_name,position_id,workcity,
        					salaryMin,workYear,education,
        					positionAdvantage,create_time,c.id,
        					c.companyallname,c.companyfield 
        			FROM lg_position as p LEFT JOIN lg_company as c ON p.company_id = c.id  
        			ORDER BY create_time DESC
        			LIMIT 5";
        $t_res = Yii::$app->db->createCommand($t_sql)->queryAll();

        //热度排序
        $h_sql = "	SELECT 	position_name,position_id,workcity,
        					salaryMin,workYear,education,
        					positionAdvantage,create_time,c.id,c.companyallname,c.companyfield 
        			FROM lg_position as p LEFT JOIN lg_company as c ON p.company_id = c.id 
        			ORDER BY seek_num DESC
        			LIMIT 5";

        $h_res = Yii::$app->db->createCommand($h_sql)->queryAll();

        /********************** 热门职位 && 最新职位 End *******************************/


        /**
         * $h_res: 热度职位
         * $t_res: 最新职位
         */
        return $this->render('index', ['cate' => $cate, 'h_res' => $h_res, 't_res' => $t_res]);

    }

    /**
     *  无限极    包含类 分类树
     * @param   $data      处理的数组
     * @param  $parent_id  父id
     * @return $arr        处理后返回的数组
     */
    public function CateSonTree($data, $parent_id = 0)
    {
        $arr = array();

        foreach ($data as $k => $v) {
            if ($v['parent_id'] == $parent_id) {

                $arr[$k] = $v;
                $arr[$k]['SonCate'] = $this->CateSonTree($data, $v['pcate_id']);
            }
        }
        return $arr;
    }

    /** ------------------- 根据不同身份的登录者判断点击公司时所显示的内容 ----------------- **/


    public function actionCom()
    {

        $session = Yii::$app->session;
        //   获取登录者的身份
        $type = $session['type'];

        /********************************************************************************\
         *****************     取出session中存储的type(登录者身份)      *****************
         *****************     type   0         表示登录者是求职者      *****************
         *****************     type   1         表示登录者是招人者      *****************
         *****************     id     空        表示公司信息还未填写    *****************
         *****************     id    其他       公司id                  *****************
         * \********************************************************************************/

        if (isset($session['user_id'])) {
            if ($type == 0) {
                return $this->redirect('?r=index/companylist');
            } else {
                if (!isset($session['id'])) {
                    return $this->redirect('?r=company/rcompany');
                } else {
                    $company_id = $session['id'];
                    return $this->redirect(array('company/cpinfo', 'company_id' => $company_id));
                }
            }
        } else {
            return $this->redirect('?r=index/companylist');
        }
    }

    /**-------------------------------- 公司列表页 ---------------------------**/

    public function actionCompanylist()
    {
        //判断是否有筛选条件
        $type_id = Yii::$app->request->get();
        if (isset($type_id['type_id']) || !empty($type_id['type_id'])){

            //根据筛选条件查询
            $c_sql = "SELECT id,companyallname,companyfield,companycity,companylogo FROM `lg_company` WHERE t_id = " . $type_id['type_id'] . " limit 10";

        } else{

            //正常查询
            $c_sql = "SELECT id,companyallname,companyfield,companycity,companylogo FROM `lg_company` LIMIT 10";

        }

        $company = Yii::$app->db->createCommand($c_sql)->queryAll();

        //查询 类型分类
        $t_sql = "SELECT type_id,c_type_name FROM lg_type";
        $type = Yii::$app->db->createCommand($t_sql)->queryAll();


        return $this->render('companylist', ['company' => $company, 'type' => $type]);

    }

    // 发布职位

    /**-------------------------------- 公司详情页 ---------------------------**/
    public function actionCompanydetails()
    {
        return $this->render('index04');

    }

    //更多职位

    public function actionCreate()
    {
        return $this->render('create');
    }

    //投个简历

    public function actionList()
    {
        return $this->render('list');
    }

    //投个简历

    public function actionToudi()
    {
        return $this->render('toudi');
    }

    public function actionMlist()
    {
        return $this->render('mlist');
    }

    /** 搜索公司 */
    public function actionSearchcp()
    {

        $data = \yii::$app->request->post();
        $company_name = $data['kd'];

        print_r($data);

    }

    /** 搜索职位 */
    public function actionSearchps()
    {
        $post = \yii::$app->request->post();
        $position_name = $post['kd'];
        $sql = 'SELECT * FROM lg_position p,lg_company c 
                where p.company_id = c.id  
                and position_name like "%' . $position_name . '%"';
        $data = Position::findBySql($sql)->asArray()->all();
        // echo "<pre>";
        // print_r($data);die;
        return $this->render('list', ['data' => $data, 'name' => $position_name]);
    }

    /** 公司长尾联想词搜索 */
    public function actionSearchcpp()
    {
        $company_name = $_POST['keyword'];
        $data = Position::findBySql('SELECT companyallname FROM lg_company where companyallname like "%' . $company_name . '%"')->asArray()->all();
        foreach ($data as $key => $value) {
            $arr[$key] = $data[$key]['companyallname'];
        }
        echo json_encode($arr);
    }

    /** 职位长尾联想词搜索 */
    public function actionSearchpss()
    {
        $position_name = $_POST['keyword'];
        $data = Position::findBySql('SELECT position_name FROM lg_position where position_name like "%' . $position_name . '%"')->asArray()->all();
        foreach ($data as $key => $value) {
            $arr[$key] = $data[$key]['position_name'];
        }
        echo json_encode($arr);
    }


}