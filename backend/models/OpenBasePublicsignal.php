<?php

/**
 * This is the model class for table "open_base_publicsignal".
 *
 * The followings are the available columns in table 'open_base_publicsignal':
 * @property integer $pid
 * @property string $Id
 * @property string $PublicSignalShort
 * @property string $PublicSignalInitId
 * @property string $PublicSignalName
 * @property string $PublicSignalNickname
 * @property string $PublicSignalType
 * @property string $PublicSignalTheme
 * @property string $PriceRule
 * @property string $Token
 * @property string $AppId
 * @property string $AppSecret
 * @property string $CallBackUrl
 * @property string $InterfaceConfig
 * @property string $PaySignKey
 * @property string $PartnerId
 * @property string $PartnerKey
 * @property string $InterfaceConfigType
 * @property string $WexinPay
 * @property string $SystemAccountID
 * @property string $PublicSignalPortrait
 * @property string $CustomerInterface
 * @property string $SelfNickName
 * @property string $StartTime
 * @property string $EndTime
 * @property string $WechatTechSupport
 * @property string $WechatServiceType
 * @property string $ContactorName
 * @property string $ContactorPhone
 * @property string $CompanyName
 * @property string $Type
 * @property string $CooperationStatus
 * @property string $Status
 * @property string $CreatorId
 * @property string $CreateTime
 * @property string $EditerId
 * @property string $EditTime
 * @property string $MongoCheckCode
 * @property string $PublicSignalTitle
 * @property string $PublicSignalUnderpainting
 * @property string $PublicSignalFontColor
 * @property string $SuccessWeCathTemplateID
 * @property string $PublicSignalCustomerServicePhone
 * @property string $PublicSignalReplyNickname
 * @property string $DingzuoInterfaceType
 * @property string $IsChildAccount
 * @property string $IsAcceptance
 * @property integer $qrcode
 * @property integer $hasMember
 * @property string $SuccessWeCathTemplate
 * @property string $FailedWeCathTemplate
 * @property string $FailedWeCathTemplateID
 */

namespace backend\models;
use Yii;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;

class OpenBasePublicsignal extends \yii\db\ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public static function tableName()
	{
		return 'open_base_publicsignal';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Id', 'required'),
			array('qrcode, hasMember', 'numerical', 'integerOnly'=>true),
			array('Id, PublicSignalShort, PublicSignalInitId, PublicSignalName, PublicSignalNickname, Token, AppId, AppSecret, CallBackUrl, InterfaceConfigType, SystemAccountID, SelfNickName, WechatServiceType, ContactorName, ContactorPhone, CompanyName, CreatorId, EditerId, PublicSignalTitle', 'length', 'max'=>50),
			array('PublicSignalType, PublicSignalTheme, PriceRule, CooperationStatus, Status, DingzuoInterfaceType, IsChildAccount, IsAcceptance', 'length', 'max'=>1),
			array('InterfaceConfig', 'length', 'max'=>2000),
			array('PaySignKey, PartnerId, PartnerKey, PublicSignalPortrait, WechatTechSupport', 'length', 'max'=>200),
			array('WexinPay, CustomerInterface', 'length', 'max'=>4),
			array('StartTime, EndTime', 'length', 'max'=>20),
			array('Type', 'length', 'max'=>6),
			array('MongoCheckCode', 'length', 'max'=>32),
			array('PublicSignalUnderpainting, PublicSignalFontColor', 'length', 'max'=>10),
			array('SuccessWeCathTemplateID, SuccessWeCathTemplate, FailedWeCathTemplate, FailedWeCathTemplateID', 'length', 'max'=>100),
			array('PublicSignalCustomerServicePhone', 'length', 'max'=>15),
			array('PublicSignalReplyNickname', 'length', 'max'=>60),
			array('CreateTime, EditTime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pid, Id, PublicSignalShort, PublicSignalInitId, PublicSignalName, PublicSignalNickname, PublicSignalType, PublicSignalTheme, PriceRule, Token, AppId, AppSecret, CallBackUrl, InterfaceConfig, PaySignKey, PartnerId, PartnerKey, InterfaceConfigType, WexinPay, SystemAccountID, PublicSignalPortrait, CustomerInterface, SelfNickName, StartTime, EndTime, WechatTechSupport, WechatServiceType, ContactorName, ContactorPhone, CompanyName, Type, CooperationStatus, Status, CreatorId, CreateTime, EditerId, EditTime, MongoCheckCode, PublicSignalTitle, PublicSignalUnderpainting, PublicSignalFontColor, SuccessWeCathTemplateID, PublicSignalCustomerServicePhone, PublicSignalReplyNickname, DingzuoInterfaceType, IsChildAccount, IsAcceptance, qrcode, hasMember, SuccessWeCathTemplate, FailedWeCathTemplate, FailedWeCathTemplateID', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pid' => 'Pid',
			'Id' => 'ID',
			'PublicSignalShort' => 'Public Signal Short',
			'PublicSignalInitId' => 'Public Signal Init',
			'PublicSignalName' => 'Public Signal Name',
			'PublicSignalNickname' => 'Public Signal Nickname',
			'PublicSignalType' => 'Public Signal Type',
			'PublicSignalTheme' => 'Public Signal Theme',
			'PriceRule' => 'Price Rule',
			'Token' => 'Token',
			'AppId' => 'App',
			'AppSecret' => 'App Secret',
			'CallBackUrl' => 'Call Back Url',
			'InterfaceConfig' => 'Interface Config',
			'PaySignKey' => 'Pay Sign Key',
			'PartnerId' => 'Partner',
			'PartnerKey' => 'Partner Key',
			'InterfaceConfigType' => 'Interface Config Type',
			'WexinPay' => 'Wexin Pay',
			'SystemAccountID' => '关联表open_base_manager的id',
			'PublicSignalPortrait' => 'Public Signal Portrait',
			'CustomerInterface' => 'Customer Interface',
			'SelfNickName' => 'Self Nick Name',
			'StartTime' => 'Start Time',
			'EndTime' => 'End Time',
			'WechatTechSupport' => 'Wechat Tech Support',
			'WechatServiceType' => 'Wechat Service Type',
			'ContactorName' => 'Contactor Name',
			'ContactorPhone' => 'Contactor Phone',
			'CompanyName' => 'Company Name',
			'Type' => 'Type',
			'CooperationStatus' => 'Cooperation Status',
			'Status' => 'Status',
			'CreatorId' => 'Creator',
			'CreateTime' => 'Create Time',
			'EditerId' => 'Editer',
			'EditTime' => 'Edit Time',
			'MongoCheckCode' => 'Mongo Check Code',
			'PublicSignalTitle' => 'Public Signal Title',
			'PublicSignalUnderpainting' => 'Public Signal Underpainting',
			'PublicSignalFontColor' => 'Public Signal Font Color',
			'SuccessWeCathTemplateID' => '成功消息模板ID',
			'PublicSignalCustomerServicePhone' => 'Public Signal Customer Service Phone',
			'PublicSignalReplyNickname' => 'Public Signal Reply Nickname',
			'DingzuoInterfaceType' => '前端是否显示二维码: 0:关闭(默认) 1:开启',
			'IsChildAccount' => 'Is Child Account',
			'PublicKey' => 'public key',
			'PrivateKey' => 'private key',
			'IsAcceptance' => 'Is Acceptance',
			'qrcode' => '前端是否显示二维码: 0:关闭(默认) 1:开启',
			'hasMember' => '拥有会员卡功能 0无 1前端拥有会员卡入口',
			'SuccessWeCathTemplate' => '成功消息模板',
			'FailedWeCathTemplate' => '失败消息模板',
			'FailedWeCathTemplateID' => '失败消息模板ID',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('pid',$this->pid);
		$criteria->compare('Id',$this->Id,true);
		$criteria->compare('PublicSignalShort',$this->PublicSignalShort,true);
		$criteria->compare('PublicSignalInitId',$this->PublicSignalInitId,true);
		$criteria->compare('PublicSignalName',$this->PublicSignalName,true);
		$criteria->compare('PublicSignalNickname',$this->PublicSignalNickname,true);
		$criteria->compare('PublicSignalType',$this->PublicSignalType,true);
		$criteria->compare('PublicSignalTheme',$this->PublicSignalTheme,true);
		$criteria->compare('PriceRule',$this->PriceRule,true);
		$criteria->compare('Token',$this->Token,true);
		$criteria->compare('AppId',$this->AppId,true);
		$criteria->compare('AppSecret',$this->AppSecret,true);
		$criteria->compare('CallBackUrl',$this->CallBackUrl,true);
		$criteria->compare('InterfaceConfig',$this->InterfaceConfig,true);
		$criteria->compare('PaySignKey',$this->PaySignKey,true);
		$criteria->compare('PartnerId',$this->PartnerId,true);
		$criteria->compare('PartnerKey',$this->PartnerKey,true);
		$criteria->compare('InterfaceConfigType',$this->InterfaceConfigType,true);
		$criteria->compare('WexinPay',$this->WexinPay,true);
		$criteria->compare('SystemAccountID',$this->SystemAccountID,true);
		$criteria->compare('PublicSignalPortrait',$this->PublicSignalPortrait,true);
		$criteria->compare('CustomerInterface',$this->CustomerInterface,true);
		$criteria->compare('SelfNickName',$this->SelfNickName,true);
		$criteria->compare('StartTime',$this->StartTime,true);
		$criteria->compare('EndTime',$this->EndTime,true);
		$criteria->compare('WechatTechSupport',$this->WechatTechSupport,true);
		$criteria->compare('WechatServiceType',$this->WechatServiceType,true);
		$criteria->compare('ContactorName',$this->ContactorName,true);
		$criteria->compare('ContactorPhone',$this->ContactorPhone,true);
		$criteria->compare('CompanyName',$this->CompanyName,true);
		$criteria->compare('Type',$this->Type,true);
		$criteria->compare('CooperationStatus',$this->CooperationStatus,true);
		$criteria->compare('Status',$this->Status,true);
		$criteria->compare('CreatorId',$this->CreatorId,true);
		$criteria->compare('CreateTime',$this->CreateTime,true);
		$criteria->compare('EditerId',$this->EditerId,true);
		$criteria->compare('EditTime',$this->EditTime,true);
		$criteria->compare('MongoCheckCode',$this->MongoCheckCode,true);
		$criteria->compare('PublicSignalTitle',$this->PublicSignalTitle,true);
		$criteria->compare('PublicSignalUnderpainting',$this->PublicSignalUnderpainting,true);
		$criteria->compare('PublicSignalFontColor',$this->PublicSignalFontColor,true);
		$criteria->compare('SuccessWeCathTemplateID',$this->SuccessWeCathTemplateID,true);
		$criteria->compare('PublicSignalCustomerServicePhone',$this->PublicSignalCustomerServicePhone,true);
		$criteria->compare('PublicSignalReplyNickname',$this->PublicSignalReplyNickname,true);
		$criteria->compare('DingzuoInterfaceType',$this->DingzuoInterfaceType,true);
		$criteria->compare('IsChildAccount',$this->IsChildAccount,true);
		$criteria->compare('PublicKey',$this->PublicKey,true);
		$criteria->compare('PrivateKey',$this->PrivateKey,true);
		$criteria->compare('IsAcceptance',$this->IsAcceptance,true);
		$criteria->compare('qrcode',$this->qrcode);
		$criteria->compare('hasMember',$this->hasMember);
		$criteria->compare('SuccessWeCathTemplate',$this->SuccessWeCathTemplate,true);
		$criteria->compare('FailedWeCathTemplate',$this->FailedWeCathTemplate,true);
		$criteria->compare('FailedWeCathTemplateID',$this->FailedWeCathTemplateID,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OpenBasePublicsignal the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return new $className;
	}


    public function aGetAllPublicSignal(){
        $ret = array();
        $res = $this->find()->select('pid,PublicSignalNickname')->where('status=3')->asArray()->all();
        foreach($res as $v){
            $ret[$v['pid']] = $v['PublicSignalNickname'];
        }
        return $ret;
    }
}
