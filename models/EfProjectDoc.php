<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "ef_project_doc".
 *
 * @property integer $PROJECT_DOC_ID
 * @property integer $PROJECT_ID
 * @property string $DOC_PATH
 * @property string $DOC_DESC
 * @property integer $CREATE_BY
 * @property string $CREATE_DATE
 * @property integer $LAST_UPD_BY
 * @property string $LAST_UPD_DATE
 *
 * @property EfProject $pROJECT
 */
class EfProjectDoc extends ActiveRecord
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
        return 'ef_project_doc';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PROJECT_DOC_ID', 'PROJECT_ID', 'DOC_PATH', 'CREATE_BY', 'CREATE_DATE', 'LAST_UPD_BY', 'LAST_UPD_DATE'], 'required'],
            [['PROJECT_DOC_ID', 'PROJECT_ID', 'CREATE_BY', 'LAST_UPD_BY'], 'integer'],
            [['CREATE_DATE', 'LAST_UPD_DATE'], 'safe'],
            [['DOC_PATH', 'DOC_DESC'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PROJECT_DOC_ID' => Yii::t('app', 'Project  Doc  ID'),
            'PROJECT_ID' => Yii::t('app', 'Project  ID'),
            'DOC_PATH' => Yii::t('app', 'Doc  Path'),
            'DOC_DESC' => Yii::t('app', 'Doc  Desc'),
            'CREATE_BY' => Yii::t('app', 'Create  By'),
            'CREATE_DATE' => Yii::t('app', 'Create  Date'),
            'LAST_UPD_BY' => Yii::t('app', 'Last  Upd  By'),
            'LAST_UPD_DATE' => Yii::t('app', 'Last  Upd  Date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(EfProject::className(), ['PROJECT_ID' => 'PROJECT_ID']);
    }
}
