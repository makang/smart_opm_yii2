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

class OpenBasePublicsignalCinema extends \yii\db\ActiveRecord
{

    public static function getDb()
    {
        return Yii::$app->db_opensystem;
    }
	public static function tableName()
	{
		return 'open_base_publicsignal_cinema';
	}
    public static function model($className=__CLASS__){
        return new $className;
    }


}
