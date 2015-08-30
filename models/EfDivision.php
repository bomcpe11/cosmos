<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ef_division".
 *
 * @property integer $DIVISION_ID
 * @property string $DIVISION_NAME
 * @property integer $UNIT_ID
 * @property string $DIVSION_STATUS
 * @property integer $CREATE_BY
 * @property string $CREATE_DATE
 * @property integer $LAST_UPD_BY
 * @property string $LAST_UPD_DATE
 *
 * @property EfUnit $uNIT
 * @property EfProject[] $efProjects
 */
class EfDivision extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ef_division';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DIVISION_ID', 'DIVISION_NAME', 'UNIT_ID', 'CREATE_BY', 'CREATE_DATE', 'LAST_UPD_BY', 'LAST_UPD_DATE'], 'required'],
            [['DIVISION_ID', 'UNIT_ID', 'CREATE_BY', 'LAST_UPD_BY'], 'integer'],
            [['CREATE_DATE', 'LAST_UPD_DATE'], 'safe'],
            [['DIVISION_NAME'], 'string', 'max' => 255],
            [['DIVSION_STATUS'], 'string', 'max' => 2]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'DIVISION_ID' => 'เลขที่อ้างอิง ตารางข้อมูล กลุ่มงาน/ฝ่าย',
            'DIVISION_NAME' => 'ชื่อ่กลุ่มงาน/ฝ่าย',
            'UNIT_ID' => 'เลขที่อ้างอิง ตารางข้อมูลสำนัก/กอง ที่ สังกัด',
            'DIVSION_STATUS' => 'Divsion  Status',
            'CREATE_BY' => 'รหัสผู้บันทึกข้อมูล',
            'CREATE_DATE' => 'เวลาที่บันทึกข้อมูล',
            'LAST_UPD_BY' => 'รหัสผู้ปรับปรุงข้อมูล',
            'LAST_UPD_DATE' => 'เวลาที่ปรับปรุงข้อมูล',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUNIT()
    {
        return $this->hasOne(EfUnit::className(), ['UNIT_ID' => 'UNIT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEfProjects()
    {
        return $this->hasMany(EfProject::className(), ['DIVISION_ID' => 'DIVISION_ID']);
    }
}
