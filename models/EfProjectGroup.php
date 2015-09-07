<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ef_project_group".
 *
 * @property integer $PROJECT_GROUP_ID
 * @property string $GROUP_NAME
 * @property string $PROJECT_GROUP_STATUS
 * @property integer $CREATE_BY
 * @property string $CREATE_DATE
 * @property integer $LAST_UPD_BY
 * @property string $LAST_UPD_DATE
 */
class EfProjectGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ef_project_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PROJECT_GROUP_ID', 'GROUP_NAME', 'CREATE_BY', 'CREATE_DATE', 'LAST_UPD_BY', 'LAST_UPD_DATE'], 'required'],
            [['PROJECT_GROUP_ID', 'CREATE_BY', 'LAST_UPD_BY'], 'integer'],
            [['CREATE_DATE', 'LAST_UPD_DATE'], 'safe'],
            [['GROUP_NAME'], 'string', 'max' => 255],
            [['PROJECT_GROUP_STATUS'], 'string', 'max' => 2]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PROJECT_GROUP_ID' => Yii::t('app', 'Project  Group  ID'),
            'GROUP_NAME' => Yii::t('app', 'Group  Name'),
            'PROJECT_GROUP_STATUS' => Yii::t('app', 'Project  Group  Status'),
            'CREATE_BY' => Yii::t('app', 'Create  By'),
            'CREATE_DATE' => Yii::t('app', 'Create  Date'),
            'LAST_UPD_BY' => Yii::t('app', 'Last  Upd  By'),
            'LAST_UPD_DATE' => Yii::t('app', 'Last  Upd  Date'),
        ];
    }
}
