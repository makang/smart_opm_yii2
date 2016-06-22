<?php

namespace backend\controllers;
use backend\models\CommonModel;
use Yii;
class CommonController extends \yii\web\Controller
{
    protected $mo       =   '';                 //设置动态模型
    protected $orderBy  =   '';                 //设置模型的排序
    protected $param    = array();              //附带参数
    protected $map      = '';              //查询参数

    public $_CODE = array(
        'NOPARAM'   =>'100',                     //错误code,100代表没有参数
        'FAILED'    =>'101',                     //错误code,101代表保存失败
        'SUC'       =>'200'                      //正确code，代表成功
    );

    public function init(){
        parent::init();
        // 检查操作员是否有对本功能操作的权限

    }

    //查询条件
    public function _map(){}
    public function actionList(){
        $model       = $this->mo ?$this->mo:$this->id;
        $map = $this->_map();
        $searchModel = new CommonModel();
        $dataProvider   = $searchModel->oSearch($map,$model,$this->orderBy);
        $this->param['dataProvider'] = $dataProvider;
        return $this->render('list', $this->param);
    }


    public function actionEdit(){
        $model      = $this->mo?$this->mo:$this->id;
        $id         = Yii::$app->request->get('id');
        $searchModel = new CommonModel();
        $row        = $searchModel->oGet($model,$id);
        $this->param['row'] = $row;
        return $this->render('edit',$this->param);
    }


    public function actionSave(){
        $data       = Yii::$app->request->post();
        $model      = $this->mo?$this->mo:$this->id;
        $searchModel    = new CommonModel();
        $ret        =   $searchModel->bSave($model,$data);

        $params     =   $this->sGetUrlParam(Yii::$app->request->getReferrer());

        if($ret)$this->jump($this->id.'/edit?'.$params);
    }

    public function actionDetail(){
        $model      = $this->mo?$this->mo:$this->id;
        $id         = Yii::$app->request->get('id');
        $searchModel = new CommonModel();
        $row        = $searchModel->oGet($model,$id);
        $this->param['row'] = $row;
        return $this->render('detail',$this->param);
    }

    public function actionAdd(){
        return $this->render('add',$this->param);
    }






    /**跳转
     * @param $url
     * @param $withParam    是否带get参数跳转
     */
    protected  function jump($url,$withParam=''){
        if($withParam){
            foreach($withParam as $k=>$v){
                $get[] = $k.'='.$v;
            }
            $url .= '?'.implode('&',$get);
        }
        $this->redirect( Yii::$app->getUrlManager()->createUrl($url));
    }

    protected function sGetUrlParam($url){
        $url = parse_url($url);
        return $url['query'];
    }

    protected function output($data){
        echo json_encode($data);exit;
    }

    protected function AjaxError($errMsg,$errCode='200'){
        $this->output(array('code'=>$errCode,'msg'=>$errMsg));
    }


}
