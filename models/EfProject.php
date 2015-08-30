<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ef_project".
 *
 * @property integer $PROJECT_ID
 * @property string $FISCAL_YEAR
 * @property integer $PROJECT_TYPE_ID
 * @property string $PLAN_NAME
 * @property string $MAIN_PRODUCTIVITY
 * @property string $PROJECT_NAME
 * @property integer $UNIT_ID
 * @property integer $DIVISION_ID
 * @property string $START_DATE
 * @property string $END_DATE
 * @property integer $BUDGET_TYPE_ID
 * @property string $BUDGET_RECEIVE
 * @property string $BUDGET_ACTUAL
 * @property string $PROJECT_STATUS
 * @property integer $PROJ_HDLR_ID
 * @property string $CONTRACT_NUM
 * @property string $PLACE
 * @property string $AMPHOE_CODE
 * @property string $PROVINCE_CODE
 * @property string $PRINC_N_REASON
 * @property string $OBJECTIVE
 * @property string $TARGET
 * @property string $TARGET_GROUP
 * @property string $OUTPUT
 * @property string $INDICATOR
 * @property string $RESULT
 * @property string $SCOPE
 * @property string $PLAN
 * @property integer $CREATE_BY
 * @property string $CREATE_DATE
 * @property integer $LAST_UPD_BY
 * @property string $LAST_UPD_DATE
 *
 * @property EfDivision $dIVISION
 * @property EfProjHdlr $pROJHDLR
 * @property EfProjectType $pROJECTTYPE
 * @property EfUnit $uNIT
 */
class EfProject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ef_project';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PROJECT_ID', 'FISCAL_YEAR', 'PROJECT_TYPE_ID', 'PROJECT_NAME', 'UNIT_ID', 'DIVISION_ID', 'START_DATE', 'END_DATE', 'PROJECT_STATUS', 'PROJ_HDLR_ID', 'CREATE_BY', 'CREATE_DATE', 'LAST_UPD_BY', 'LAST_UPD_DATE'], 'required'],
            [['PROJECT_ID', 'PROJECT_TYPE_ID', 'UNIT_ID', 'DIVISION_ID', 'BUDGET_TYPE_ID', 'PROJ_HDLR_ID', 'CREATE_BY', 'LAST_UPD_BY'], 'integer'],
            [['START_DATE', 'END_DATE', 'CREATE_DATE', 'LAST_UPD_DATE'], 'safe'],
            [['BUDGET_RECEIVE', 'BUDGET_ACTUAL'], 'number'],
            [['PRINC_N_REASON', 'OBJECTIVE', 'TARGET', 'TARGET_GROUP', 'OUTPUT', 'INDICATOR', 'RESULT', 'SCOPE', 'PLAN'], 'string'],
            [['FISCAL_YEAR'], 'string', 'max' => 4],
            [['PLAN_NAME', 'MAIN_PRODUCTIVITY', 'PROJECT_NAME', 'PLACE'], 'string', 'max' => 255],
            [['PROJECT_STATUS'], 'string', 'max' => 2],
            [['CONTRACT_NUM'], 'string', 'max' => 100],
            [['AMPHOE_CODE', 'PROVINCE_CODE'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PROJECT_ID' => 'เลขที่อ้างอิง ตารางข้อมูลโครงการที่ได้รับการสนับสนุนจากกองทุนสิ่งแวดล้อม',
            'FISCAL_YEAR' => 'ปีงบประมาณ',
            'PROJECT_TYPE_ID' => 'Project  Type  ID',
            'PLAN_NAME' => 'Plan  Name',
            'MAIN_PRODUCTIVITY' => 'Main  Productivity',
            'PROJECT_NAME' => 'ชื่องาน/โครงการ',
            'UNIT_ID' => 'Unit  ID',
            'DIVISION_ID' => 'Division  ID',
            'START_DATE' => 'เวลาเริ่มดำเนินการ',
            'END_DATE' => 'เวลาสิ้นสุดดำเนินการ',
            'BUDGET_TYPE_ID' => 'Budget  Type  ID',
            'BUDGET_RECEIVE' => 'งบประมาณ (ได้รับ)',
            'BUDGET_ACTUAL' => 'งบประมาณ (ใช้จริง)',
            'PROJECT_STATUS' => 'สถานะโครงการ (1:อยู่ระหว่างดำเนินการ,2:ดำเนินการเสร็จสิ้น,3:ยกเลิกโครงการ)',
            'PROJ_HDLR_ID' => 'Proj  Hdlr  ID',
            'CONTRACT_NUM' => 'เลขที่สัญญา',
            'PLACE' => 'ที่ตั้งโครงการ',
            'AMPHOE_CODE' => 'Amphoe  Code',
            'PROVINCE_CODE' => 'Province  Code',
            'PRINC_N_REASON' => 'หลักการและเหตุผล',
            'OBJECTIVE' => 'วัตถุประสงค์',
            'TARGET' => 'เป้าหมาย',
            'TARGET_GROUP' => 'กลุ่มเป้าหมาย',
            'OUTPUT' => 'ผลผลิต',
            'INDICATOR' => 'ตัวชี้วัด',
            'RESULT' => 'ผลลัพธ์',
            'SCOPE' => 'ขอบเขต',
            'PLAN' => 'แผนการดำเนินงาน',
            'CREATE_BY' => 'รหัสผู้บันทึกข้อมูล',
            'CREATE_DATE' => 'เวลาที่บันทึกข้อมูล',
            'LAST_UPD_BY' => 'รหัสผู้ปรับปรุงข้อมูล',
            'LAST_UPD_DATE' => 'เวลาที่ปรับปรุงข้อมูล',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDIVISION()
    {
        return $this->hasOne(EfDivision::className(), ['DIVISION_ID' => 'DIVISION_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPROJHDLR()
    {
        return $this->hasOne(EfProjHdlr::className(), ['PROJ_HDLR_ID' => 'PROJ_HDLR_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPROJECTTYPE()
    {
        return $this->hasOne(EfProjectType::className(), ['PROJECT_TYPE_ID' => 'PROJECT_TYPE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUNIT()
    {
        return $this->hasOne(EfUnit::className(), ['UNIT_ID' => 'UNIT_ID']);
    }
}