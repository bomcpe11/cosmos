<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ef_thai_geography".
 *
 * @property integer $GEO_ID
 * @property string $GEO_NAME
 */
class EfThaiGeography extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ef_thai_geography';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['GEO_NAME'], 'required'],
            [['GEO_NAME'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'GEO_ID' => 'Geo  ID',
            'GEO_NAME' => 'Geo  Name',
        ];
    }
}
