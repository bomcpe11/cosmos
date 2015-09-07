<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ef_unit".
 *
 * @property integer $UNIT_ID
 * @property string $UNIT_NAME
 * @property string $UNIT_STATUS
 * @property integer $CREATE_BY
 * @property string $CREATE_DATE
 * @property integer $LAST_UPD_BY
 * @property string $LAST_UPD_DATE
 *
 * @property EfDivision[] $efDivisions
 * @property EfProject[] $efProjects
 */
class EfUnit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ef_unit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['UNIT_ID', 'UNIT_NAME', 'CREATE_BY', 'CREATE_DATE', 'LAST_UPD_BY', 'LAST_UPD_DATE'], 'required'],
            [['UNIT_ID', 'CREATE_BY', 'LAST_UPD_BY'], 'integer'],
            [['CREATE_DATE', 'LAST_UPD_DATE'], 'safe'],
            [['UNIT_NAME'], 'string', 'max' => 255],
            [['UNIT_STATUS'], 'string', 'max' => 2]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'UNIT_ID' => 'เลขที่อ้างอิง ตารางข้อมูล สำนัก/กอง',
            'UNIT_NAME' => 'Unit  Name',
            'UNIT_STATUS' => 'Unit  Status',
            'CREATE_BY' => 'รหัสผู้บันทึกข้อมูล',
            'CREATE_DATE' => 'เวลาที่บันทึกข้อมูล',
            'LAST_UPD_BY' => 'รหัสผู้ปรับปรุงข้อมูล',
            'LAST_UPD_DATE' => 'เวลาที่ปรับปรุงข้อมูล',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEfDivisions()
    {
        return $this->hasMany(EfDivision::className(), ['UNIT_ID' => 'UNIT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEfProjects()
    {
        return $this->hasMany(EfProject::className(), ['UNIT_ID' => 'UNIT_ID']);
    }
}
