<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ef_project_type".
 *
 * @property integer $PROJECT_TYPE_ID
 * @property integer $PROJECT_GROUP_ID
 * @property string $PROJECT_TYPE_NAME
 * @property string $PROJECT_TYPE_STATUS
 * @property integer $CREATE_BY
 * @property string $CREATE_DATE
 * @property integer $LAST_UPD_BY
 * @property string $LAST_UPD_DATE
 *
 * @property EfProject[] $efProjects
 */
class EfProjectType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ef_project_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PROJECT_TYPE_ID', 'PROJECT_GROUP_ID', 'PROJECT_TYPE_NAME', 'CREATE_BY', 'CREATE_DATE', 'LAST_UPD_BY', 'LAST_UPD_DATE'], 'required'],
            [['PROJECT_TYPE_ID', 'PROJECT_GROUP_ID', 'CREATE_BY', 'LAST_UPD_BY'], 'integer'],
            [['CREATE_DATE', 'LAST_UPD_DATE'], 'safe'],
            [['PROJECT_TYPE_NAME'], 'string', 'max' => 255],
            [['PROJECT_TYPE_STATUS'], 'string', 'max' => 2]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PROJECT_TYPE_ID' => 'เลขที่อ้างอิง ตารางข้อมูลประเภทโครงการ',
            'PROJECT_GROUP_ID' => 'เลขที่อ้างอิง ตารางข้อมูลกลุ่มโครงการ',
            'PROJECT_TYPE_NAME' => 'ชื่อประเภทโครงการ',
            'PROJECT_TYPE_STATUS' => 'Project  Type  Status',
            'CREATE_BY' => 'รหัสผู้บันทึกข้อมูล',
            'CREATE_DATE' => 'เวลาที่บันทึกข้อมูล',
            'LAST_UPD_BY' => 'รหัสผู้ปรับปรุงข้อมูล',
            'LAST_UPD_DATE' => 'เวลาที่ปรับปรุงข้อมูล',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEfProjects()
    {
        return $this->hasMany(EfProject::className(), ['PROJECT_TYPE_ID' => 'PROJECT_TYPE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEfProjectGroup()
    {
        return $this->hasOne(EfProjectGroup::className(), ['PROJECT_GROUP_ID' => 'PROJECT_GROUP_ID']);
    }
}
