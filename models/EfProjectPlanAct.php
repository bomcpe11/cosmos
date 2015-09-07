<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "ef_project_plan_act".
 *
 * @property integer $PROJECT_PLAN_ACT_ID
 * @property string $PLAN_ACT_NAME
 * @property string $SEQ
 * @property string $BUDGET_PLAN
 * @property integer $LEVEL
 * @property integer $PARENT_ID
 * @property integer $PROJECT_ID
 * @property string $STATUS
 * @property integer $CREATE_BY
 * @property string $CREATE_DATE
 * @property integer $LAST_UPD_BY
 * @property string $LAST_UPD_DATE
 *
 * @property EfProject $pROJECT
 */
class EfProjectPlanAct extends ActiveRecord
{
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['CREATE_DATE', 'LAST_UPD_DATE'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'LAST_UPD_DATE',
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ef_project_plan_act';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PROJECT_PLAN_ACT_ID', 'PLAN_ACT_NAME', 'LEVEL', 'PARENT_ID', 'CREATE_BY', 'LAST_UPD_BY'], 'required'],
            [['PROJECT_PLAN_ACT_ID', 'LEVEL', 'PARENT_ID', 'PROJECT_ID', 'CREATE_BY', 'LAST_UPD_BY'], 'integer'],
            [['BUDGET_PLAN'], 'number'],
            [['CREATE_DATE', 'LAST_UPD_DATE'], 'safe'],
            [['PLAN_ACT_NAME'], 'string', 'max' => 255],
            [['SEQ'], 'string', 'max' => 5],
            [['STATUS'], 'string', 'max' => 2]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PROJECT_PLAN_ACT_ID' => Yii::t('app', 'Project  Plan  Act  ID'),
            'PLAN_ACT_NAME' => Yii::t('app', 'ชื่อแผนงาน/กิจกรรมหลัก/กิจกรรมรอง'),
            'SEQ' => Yii::t('app', 'ลำดับการแสดงผล'),
            'BUDGET_PLAN' => Yii::t('app', 'แผนการใช้จ่าย'),
            'LEVEL' => Yii::t('app', 'Level'),
            'PARENT_ID' => Yii::t('app', 'ภายใต้แผนงาน'),
            'PROJECT_ID' => Yii::t('app', 'แผงงาน'),
            'STATUS' => Yii::t('app', 'สถานะ'),
            'CREATE_BY' => Yii::t('app', 'Create  By'),
            'CREATE_DATE' => Yii::t('app', 'Create  Date'),
            'LAST_UPD_BY' => Yii::t('app', 'Last  Upd  By'),
            'LAST_UPD_DATE' => Yii::t('app', 'Last  Upd  Date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPROJECT()
    {
        return $this->hasOne(EfProject::className(), ['PROJECT_ID' => 'PROJECT_ID']);
    }
}
