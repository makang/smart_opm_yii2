<?php

namespace backend\controllers;
use Yii;
class CommonController extends \yii\web\Controller
{


    public $_ERROR_CODE = array(
        'NOPARAM'   =>'100'                     //错误code,100代表没有参数
    );

    public function init(){
        parent::init();
        // 检查操作员是否有对本功能操作的权限

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
