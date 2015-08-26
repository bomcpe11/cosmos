<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ef_proj_hdlr".
 *
 * @property integer $PROJ_HDLR_ID
 * @property string $NAME
 * @property string $ADDRESS_NO
 * @property string $VILLAGE_NO
 * @property string $BUILDING_NAME
 * @property string $ROAD
 * @property string $TAMBOL_CODE
 * @property string $AMPHOE_CODE
 * @property string $PROVINCE_CODE
 * @property string $ZIP_CODE
 * @property string $TELEPHONE_NO
 * @property string $FAX_NO
 * @property string $EMAIL
 * @property string $RESP_FIRST_NAME
 * @property string $RESP_LAST_NAME
 * @property string $RESP_ID_NO
 * @property string $RESP_MOBILE_NO
 * @property string $RESP_EMAIL
 * @property integer $USER_ID
 * @property integer $CREATE_BY
 * @property string $CREATE_DATE
 * @property integer $LAST_UPD_BY
 * @property string $LAST_UPD_DATE
 */
class EfProjHdlr extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ef_proj_hdlr';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PROJ_HDLR_ID', 'NAME', 'USER_ID', 'CREATE_BY', 'CREATE_DATE', 'LAST_UPD_BY', 'LAST_UPD_DATE'], 'required'],
            [['PROJ_HDLR_ID', 'USER_ID', 'CREATE_BY', 'LAST_UPD_BY'], 'integer'],
            [['CREATE_DATE', 'LAST_UPD_DATE'], 'safe'],
            [['NAME', 'BUILDING_NAME', 'TAMBOL_CODE'], 'string', 'max' => 255],
            [['ADDRESS_NO', 'ROAD', 'AMPHOE_CODE', 'PROVINCE_CODE', 'ZIP_CODE', 'RESP_ID_NO'], 'string', 'max' => 50],
            [['VILLAGE_NO'], 'string', 'max' => 5],
            [['TELEPHONE_NO', 'FAX_NO', 'EMAIL', 'RESP_FIRST_NAME', 'RESP_LAST_NAME', 'RESP_MOBILE_NO', 'RESP_EMAIL'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PROJ_HDLR_ID' => 'เลขที่อ้างอิง',
            'NAME' => 'ชื่อหน่วยงาน',
            'ADDRESS_NO' => 'เลขที่',
            'VILLAGE_NO' => 'หมู่',
            'BUILDING_NAME' => 'หน่วยงานที่รับผิดชอบ - ชื่ออาคาร',
            'ROAD' => 'ถนน',
            'TAMBOL_CODE' => 'ตำบล/แขวง',
            'AMPHOE_CODE' => 'อำเภอ/เขต',
            'PROVINCE_CODE' => 'จังหวัด',
            'ZIP_CODE' => 'รหัสไปรษณีย์',
            'TELEPHONE_NO' => 'หมายเลขโทรศัพท์',
            'FAX_NO' => 'หมายเลขโทรสาร',
            'EMAIL' => 'อีเมล์',
            'RESP_FIRST_NAME' => 'ชื่อ',
            'RESP_LAST_NAME' => 'นามสกุล',
            'RESP_ID_NO' => 'หมายเลขบัตรประชาชน',
            'RESP_MOBILE_NO' => 'หมายเลขโทรศัพท์',
            'RESP_EMAIL' => 'อีเมล์',
            'USER_ID' => 'เลขที่อ้างอิงผู้ใช้งาน',
            'CREATE_BY' => 'รหัสผู้บันทึกข้อมูล',
            'CREATE_DATE' => 'เวลาที่บันทึกข้อมูล',
            'LAST_UPD_BY' => 'รหัสผู้ปรับปรุงข้อมูล',
            'LAST_UPD_DATE' => 'เวลาที่ปรับปรุงข้อมูล',
        ];
    }
}
