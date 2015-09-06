<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "ef_group_role".
 *
 * @property integer $GROUP_ROLE_ID
 * @property integer $GROUP_ID
 * @property integer $MENU_SUB_ID
 * @property string $ACCESS_FLAG
 * @property string $ADD_FLAG
 * @property string $EDIT_FLAG
 * @property string $DELETE_FLAG
 * @property integer $CREATE_BY
 * @property string $CREATE_DATE
 * @property integer $LAST_UPD_BY
 * @property string $LAST_UPD_DATE
 *
 * @property EfGroup $gROUP
 * @property EfMenuSub $mENUSUB
 */
class EfGroupRole extends \yii\db\ActiveRecord
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
        return 'ef_group_role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['GROUP_ROLE_ID', 'GROUP_ID', 'MENU_SUB_ID', 'CREATE_BY', 'LAST_UPD_BY'], 'required'],
            [['GROUP_ROLE_ID', 'GROUP_ID', 'MENU_SUB_ID', 'CREATE_BY', 'LAST_UPD_BY'], 'integer'],
            [['CREATE_DATE', 'LAST_UPD_DATE'], 'safe'],
            [['ACCESS_FLAG', 'ADD_FLAG', 'EDIT_FLAG', 'DELETE_FLAG'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'GROUP_ROLE_ID' => 'Group  Role  ID',
            'GROUP_ID' => 'Group  ID',
            'MENU_SUB_ID' => 'Menu  Sub  ID',
            'ACCESS_FLAG' => 'Access  Flag',
            'ADD_FLAG' => 'Add  Flag',
            'EDIT_FLAG' => 'Edit  Flag',
            'DELETE_FLAG' => 'Delete  Flag',
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
    public function getMENUSUB()
    {
        return $this->hasOne(EfMenuSub::className(), ['MENU_SUB_ID' => 'MENU_SUB_ID']);
    }
}
