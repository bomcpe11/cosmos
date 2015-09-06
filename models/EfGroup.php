<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "ef_group".
 *
 * @property integer $GROUP_ID
 * @property string $GROUP_NAME
 * @property string $STATUS
 * @property integer $CREATE_BY
 * @property string $CREATE_DATE
 * @property integer $LAST_UPD_BY
 * @property string $LAST_UPD_DATE
 *
 * @property EfGroupRole[] $efGroupRoles
 * @property EfGroupUser[] $efGroupUsers
 */
class EfGroup extends \yii\db\ActiveRecord
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
        return 'ef_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['GROUP_NAME', 'CREATE_BY', 'LAST_UPD_BY'], 'required'],
            [['GROUP_ID', 'CREATE_BY', 'LAST_UPD_BY'], 'integer'],
            [['CREATE_DATE', 'LAST_UPD_DATE'], 'safe'],
            [['GROUP_NAME'], 'string', 'max' => 255],
            [['STATUS'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'GROUP_ID' => 'Group  ID',
            'GROUP_NAME' => 'Group  Name',
            'STATUS' => 'Status',
            'CREATE_BY' => 'Create  By',
            'CREATE_DATE' => 'Create  Date',
            'LAST_UPD_BY' => 'Last  Upd  By',
            'LAST_UPD_DATE' => 'Last  Upd  Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEfGroupRoles()
    {
        return $this->hasMany(EfGroupRole::className(), ['GROUP_ID' => 'GROUP_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEfGroupUsers()
    {
        return $this->hasMany(EfGroupUser::className(), ['GROUP_ID' => 'GROUP_ID']);
    }
}
