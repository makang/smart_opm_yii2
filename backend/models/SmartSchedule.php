<?php

namespace backend\models;

use linslin\yii2\curl;
use Yii;

/**
 * This is the model class for table "smart_schedule".
 *
 * @property integer $schedule_id
 * @property string $cinema_name
 * @property string $cinema_no
 * @property string $movie_no
 * @property string $movie_name
 * @property string $show_date
 * @property integer $show_time
 * @property string $show_type
 * @property string $language
 * @property string $hall_no
 * @property string $hall_name
 * @property string $section_no
 * @property string $close_time
 * @property string $city_no
 * @property integer $cinema_price
 * @property integer $sale_price
 * @property integer $lowest_price
 * @property integer $settlement_price
 * @property integer $actual_sell_price
 * @property integer $booking_system_fee
 * @property integer $open_system_fee
 * @property integer $cinema_fee
 * @property integer $price_type
 * @property integer $status
 * @property integer $schedule_status
 * @property string $price_rule_id
 * @property string $bis_cinema_no
 * @property string $bis_movie_no
 * @property string $bis_schedule_id
 * @property integer $create_time
 * @property integer $edit_time
 * @property string $show_seq_no
 * @property string $seq_no
 */
class SmartSchedule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'smart_schedule';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['schedule_id', 'cinema_name'], 'required'],
            [['schedule_id', 'show_time', 'cinema_price', 'sale_price', 'lowest_price', 'settlement_price', 'actual_sell_price', 'booking_system_fee', 'open_system_fee', 'cinema_fee', 'price_type', 'status', 'schedule_status', 'create_time', 'edit_time'], 'integer'],
            [['cinema_name', 'cinema_no', 'movie_no', 'movie_name', 'show_type', 'language', 'hall_no', 'hall_name', 'section_no', 'city_no', 'price_rule_id', 'bis_cinema_no', 'bis_movie_no', 'bis_schedule_id', 'show_seq_no'], 'string', 'max' => 50],
            [['show_date', 'close_time'], 'string', 'max' => 13],
            [['seq_no'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'schedule_id' => Yii::t('app', 'Schedule ID'),
            'cinema_name' => Yii::t('app', 'Cinema Name'),
            'cinema_no' => Yii::t('app', '影院名称'),
            'movie_no' => Yii::t('app', '影院编号'),
            'movie_name' => Yii::t('app', '排期编号'),
            'show_date' => Yii::t('app', '放映日期'),
            'show_time' => Yii::t('app', '放映时间'),
            'show_type' => Yii::t('app', '影片类型'),
            'language' => Yii::t('app', '影片语言版本'),
            'hall_no' => Yii::t('app', '影厅编号'),
            'hall_name' => Yii::t('app', '影片名称'),
            'section_no' => Yii::t('app', '区域编号'),
            'close_time' => Yii::t('app', '接入时间'),
            'city_no' => Yii::t('app', '城市id'),
            'cinema_price' => Yii::t('app', '门市价,单位分'),
            'sale_price' => Yii::t('app', '售卖价，单位分'),
            'lowest_price' => Yii::t('app', '最低保护价，单位分'),
            'settlement_price' => Yii::t('app', '按规则批出的价格，单位分'),
            'actual_sell_price' => Yii::t('app', '结算价，单位分'),
            'booking_system_fee' => Yii::t('app', '订座系统费用，单位分'),
            'open_system_fee' => Yii::t('app', '平台费用，单位分'),
            'cinema_fee' => Yii::t('app', '影院费用，单位分'),
            'price_type' => Yii::t('app', 'Price Type'),
            'status' => Yii::t('app', '状态'),
            'schedule_status' => Yii::t('app', '排期状态'),
            'price_rule_id' => Yii::t('app', '规则id'),
            'bis_cinema_no' => Yii::t('app', 'Bis Cinema No'),
            'bis_movie_no' => Yii::t('app', '订座系统影片编号'),
            'bis_schedule_id' => Yii::t('app', '订座系统影院id'),
            'create_time' => Yii::t('app', 'Create Time'),
            'edit_time' => Yii::t('app', 'Edit Time'),
            'show_seq_no' => Yii::t('app', 'Show Seq No'),
            'seq_no' => Yii::t('app', '外部排期编号'),

        ];
    }

    public static function getStatistic()
    {
        $today = strtotime(date('Y-m-d', time()));
        do {
            $num = SmartSchedule::find()->where(['show_date' => $today])->count();
            $stop_num = SmartSchedule::find()->where('status=1 or  schedule_status=9')->andWhere(['show_date' => $today])->count();

            $schedule_list[] = array(
                'date' => date('Y-m-d', $today),
                'num' => $num,
                'stop_num' => $stop_num
            );

            $today = strtotime(date('Y-m-d H:i:s', $today) . '+1 day');
        } while ($today <= (time() + 3 * 24 * 60 * 60));

        $day = strtotime(date('Y-m-d', time()));
        $stop_schedule = SmartSchedule::find()->select('cinema_no,cinema_name,count(*) top_stop_num ')->where('status=1 or  schedule_status=9')->andWhere(['show_date' => $day])->groupBy('cinema_no')->limit(10)->orderBy(['top_stop_num' => SORT_DESC])->asArray()->all();

        foreach ($stop_schedule as $stop) {
            $cinema_no[] = $stop['cinema_no'];
        }
        $top_schedule = SmartSchedule::find()->select('cinema_no, count(*) total_num')->where(['cinema_no' => $cinema_no])->andWhere(['show_date' => $day])->groupBy('cinema_no')->orderBy(['total_num' => SORT_DESC])->asArray()->all();
        $top_schedule_list = [];
        foreach ($stop_schedule as $value) {
            foreach ($top_schedule as $top) {
                if ($top['cinema_no'] == $value['cinema_no']) {
                    $value['total_num'] = $top['total_num'];
                    $top_schedule_list[] = $value;
                }
            }
            if ($top_schedule_list) {
                $top_schedule_list = self::array_unique_schedule($top_schedule_list);
            }
        }
        if ($schedule_list) {
            foreach ($schedule_list as $sche) {
                $total_num[] = $sche['num'];
                $total_stop_num[] = $sche['stop_num'];
            }
        }
        return $data = [
            'schedule_list' => $schedule_list,
            'total_num' => array_sum($total_num),
            'stop_num' => array_sum($total_stop_num),
            'top_schedule_list' => $top_schedule_list,
        ];

    }

    private static function array_unique_schedule($array2D)
    {//二维数组去掉重复值
        foreach ($array2D as $k => $v) {
            $v = implode(",", $v);  //降维,也可以用implode,将一维数组转换为用逗号连接的字符串
            $temp[$k] = $v;
        }
        $temp = array_unique($temp);    //去掉重复的字符串,也就是重复的一维数组
        foreach ($temp as $k => $v) {
            $array = explode(",", $v);   //再将拆开的数组重新组装
            $temp2[$k]["cinema_no"] = $array[0];
            $temp2[$k]["cinema_name"] = $array[1];
            $temp2[$k]["top_stop_num"] = $array[2];
            $temp2[$k]["total_num"] = $array[3];
        }
        return $temp2;
    }

    public static function getScheduleInfo($params)
    {

        $cinema_no = isset($params['cinema_no'])?$params['cinema_no']:'1013943';
        $cinema_name = isset($params['cinema_name'])?$params['cinema_name']:'金逸电影';

        $schedule_url = 'http://10.66.166.163/api/schedulePrice/getList?baseCinemaNo=' . $cinema_no;
        $curl = new curl\Curl();
        $return = json_decode($curl->get($schedule_url),true);
        $schedules = array();
        $show_date = array();
        $movie_list = array();
//         echo '<pre>';
//        print_r($return);die;
        $schedule_list = array();
        if ($return && $return['ret'] == 0 && is_array($return['data'])) {
            foreach ($return['data'] as $sche) {

                if ($sche[0]['tpId'] == -1) {
                    $schedule_list[] = $sche[0];
                    $cinema_no = $sche[0]['cinemaNo'];
                    $movie_list[] = $sche[0]['movieName'];
                    $show_date[] = substr($sche[0]['showDate'], 0, -3);

                }
            }

            if (!empty($schedule_list))
                $schedule_list = self::SortByTime($schedule_list);
            $movie_list = array_values(array_flip(array_flip($movie_list)));
            $show_date = array_values(array_flip(array_flip($show_date)));
            usort($show_date, function ($a, $b) {
                if ($a == $b) return 0;
                return ($a < $b) ? -1 : 1;
            });
            $movie_name = isset($params['movie_name'])?$params['movie_name']: (isset($movie_list[0]) ? $movie_list[0] : '');
            $key = 0;
            foreach ($show_date as $date) {

                foreach ($schedule_list as $schedule) {
                    if ($date == substr($schedule['showDate'], 0, -3)) {
                        if ($schedule['movieName'] == $movie_name) {
                            $movie_sches[] = $schedule;
                        }

                    }
                }
                $schedules[$key] = isset($movie_sches) ? $movie_sches : array();

                if (!empty($schedules[$key])) {
                    $day[] = date('Y-m-d', $date);
                    $key++;
                }
                unset($movie_sches);

            }
        }
        return  [
            'cinema_no'  => $cinema_no,
            'cinema_name' => $cinema_name,
            'schedule' => isset($schedules)?$schedules:array(),
            'movie_list' => $movie_list,
            'show_date' => isset($day)?$day:array(),
            'movie_name'=>isset($movie_name)?$movie_name:''
        ];
    }

    private static function SortByTime($schedule)
    {

        $showDates = $baseScheduleIds = array();

        foreach ($schedule as $key => $row) {

            $time[$key] = $row['showTime'];
            $baseScheduleIds[$key] = $row['baseScheduleId'];
        }
        array_multisort($time, SORT_NUMERIC, SORT_ASC, $baseScheduleIds, SORT_NUMERIC, SORT_ASC, $schedule);

        return $schedule;
    }
    /*
     * 根据影院编号拉取排期
     */
    public static  function  pullSchedule(){

    }
}
