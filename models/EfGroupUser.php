<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "ef_group_user".
 *
 * @property integer $GROUP_USER_ID
 * @property integer $GROUP_ID
 * @property integer $USER_ID
 * @property integer $CREATE_BY
 * @property string $CREATE_DATE
 * @property integer $LAST_UPD_BY
 * @property string $LAST_UPD_DATE
 *
 * @property EfGroup $gROUP
 * @property User $uSER
 */
class EfGroupUser extends \yii\db\ActiveRecord
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
        return 'ef_group_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['GROUP_USER_ID', 'GROUP_ID', 'USER_ID', 'CREATE_BY', 'LAST_UPD_BY'], 'required'],
            [['GROUP_USER_ID', 'GROUP_ID', 'USER_ID', 'CREATE_BY', 'LAST_UPD_BY'], 'integer'],
            [['CREATE_DATE', 'LAST_UPD_DATE'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'GROUP_USER_ID' => 'Group  User  ID',
            'GROUP_ID' => 'Group  ID',
            'USER_ID' => 'User  ID',
            'CREATE_BY' => 'Create  By',
            'CREATE_DATE' => 'Create  Date',
            'LAST_UPD_BY' => 'Last  Upd  By',
            'LAST_UPD_DATE' => 'Last  Upd  Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGROUP()
    {
        return $this->hasOne(EfGroup::className(), ['GROUP_ID' => 'GROUP_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUSER()
    {
        return $this->hasOne(User::className(), ['id' => 'USER_ID']);
    }
}
