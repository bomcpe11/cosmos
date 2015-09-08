<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "ef_menu_main".
 *
 * @property integer $MENU_MAIN_ID
 * @property string $MENU_MAIN_NAME
 * @property string $DESCRIPTION
 * @property string $MENU_CLASS
 * @property string $MENU_LINK
 * @property integer $SEQ
 * @property string $STATUS
 * @property integer $CREATE_BY
 * @property string $CREATE_DATE
 * @property integer $LAST_UPD_BY
 * @property string $LAST_UPD_DATE
 *
 * @property EfMenuSub[] $efMenuSubs
 */
class EfMenuMain extends \yii\db\ActiveRecord
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
        return 'ef_menu_main';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MENU_MAIN_NAME', 'CREATE_BY', 'LAST_UPD_BY'], 'required'],
            [['MENU_MAIN_ID', 'SEQ', 'CREATE_BY', 'LAST_UPD_BY'], 'integer'],
            [['CREATE_DATE', 'LAST_UPD_DATE'], 'safe'],
            [['MENU_MAIN_NAME', 'MENU_CLASS', 'MENU_LINK', 'DESCRIPTION'], 'string', 'max' => 255],
            [['STATUS'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'MENU_MAIN_ID' => 'Menu  Main  ID',
            'MENU_MAIN_NAME' => 'Menu  Main  Name',
            'DESCRIPTION' => 'Description',
            'SEQ' => 'Seq',
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
    public function getEfMenuSubs()
    {
        return $this->hasMany(EfMenuSub::className(), ['MENU_MAIN_ID' => 'MENU_MAIN_ID']);
    }
}
