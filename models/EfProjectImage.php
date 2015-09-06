<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "ef_project_image".
 *
 * @property integer $PROJECT_IMAGE_ID
 * @property integer $PROJECT_ID
 * @property string $ABSOLUTE_IMAGE_PATH
 * @property string $IMAGE_PATH
 * @property string $FILE_NAME
 * @property string $THUMBNAIL_IMAGE_PATH
 * @property string $IMAGE_DESC
 * @property integer $CREATE_BY
 * @property string $CREATE_DATE
 * @property integer $LAST_UPD_BY
 * @property string $LAST_UPD_DATE
 *
 * @property EfProject $pROJECT
 */
class EfProjectImage extends ActiveRecord
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
        return 'ef_project_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PROJECT_ID', 'IMAGE_PATH', 'THUMBNAIL_IMAGE_PATH', 'CREATE_BY', 'LAST_UPD_BY'], 'required'],
            [['PROJECT_IMAGE_ID', 'PROJECT_ID', 'CREATE_BY', 'LAST_UPD_BY'], 'integer'],
            [['CREATE_DATE', 'LAST_UPD_DATE'], 'safe'],
            [['ABSOLUTE_IMAGE_PATH', 'IMAGE_PATH', 'FILE_NAME', 'THUMBNAIL_IMAGE_PATH', 'IMAGE_DESC'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PROJECT_IMAGE_ID' => Yii::t('app', 'Project  Image  ID'),
            'PROJECT_ID' => Yii::t('app', 'Project  ID'),
            'ABSOLUTE_IMAGE_PATH' => Yii::t('app', 'Absolute Image Path'),
            'IMAGE_PATH' => Yii::t('app', 'Image  Path'),
            'FILE_NAME' => Yii::t('app', 'File Name'),
            'THUMBNAIL_IMAGE_PATH' => Yii::t('app', 'Thumbnail  Image  Path'),
            'IMAGE_DESC' => Yii::t('app', 'Image  Desc'),
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
