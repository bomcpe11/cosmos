<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ef_budget_type".
 *
 * @property integer $BUDGET_TYPE_ID
 * @property string $BUDGET_TYPE_NAME
 * @property string $BUDGET_TYPE_STATUS
 * @property integer $CREATE_BY
 * @property string $CREATE_DATE
 * @property integer $LAST_UPD_BY
 * @property string $LAST_UPD_DATE
 */
class EfBudgetType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ef_budget_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['BUDGET_TYPE_ID', 'BUDGET_TYPE_NAME', 'CREATE_BY', 'CREATE_DATE', 'LAST_UPD_BY', 'LAST_UPD_DATE'], 'required'],
            [['BUDGET_TYPE_ID', 'CREATE_BY', 'LAST_UPD_BY'], 'integer'],
            [['CREATE_DATE', 'LAST_UPD_DATE'], 'safe'],
            [['BUDGET_TYPE_NAME'], 'string', 'max' => 255],
            [['BUDGET_TYPE_STATUS'], 'string', 'max' => 2]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'BUDGET_TYPE_ID' => 'เลขที่อ้างอิง ตารางข้อมูลประเภทงบประมาณ',
            'BUDGET_TYPE_NAME' => 'ชื่อประเภทงบประมาณ',
            'BUDGET_TYPE_STATUS' => 'สถานะประเภทงบประมาณ',
            'CREATE_BY' => 'รหัสผู้บันทึกข้อมูล',
            'CREATE_DATE' => 'เวลาที่บันทึกข้อมูล',
            'LAST_UPD_BY' => 'รหัสผู้ปรับปรุงข้อมูล',
            'LAST_UPD_DATE' => 'เวลาที่ปรับปรุงข้อมูล',
        ];
    }
}
