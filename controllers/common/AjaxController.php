<?php

namespace app\controllers\common;

use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use app\models\EfThaiProvince;
use app\models\EfThaiAmphur;
use app\models\EfThaiDistrict;

class AjaxController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['get-amphur-list', 'get-district-list'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    /**
    * This function is used to return the data to the DrepDrop widget
    * See more information on http://demos.krajee.com/widget-details/depdrop
    */
    public function actionGetAmphurList() {
        $amphoeList = [];
        $provinceCode = isset(Yii::$app->request->post('depdrop_all_params')['efprojhdlr-province_code'])?
                            Yii::$app->request->post('depdrop_all_params')['efprojhdlr-province_code']:
                            null;

        if ($provinceCode != null) {
            $efThaiProvince = EfThaiProvince::find()->where(['PROVINCE_CODE' => $provinceCode])->one();
            $efThaiAmphur = EfThaiAmphur::find()->where(['PROVINCE_ID' => $efThaiProvince->PROVINCE_ID])->all();
            $amphoeList = ArrayHelper::toArray($efThaiAmphur, [
                            'app\models\EfThaiAmphur' => [
                                'id' => 'AMPHUR_CODE',
                                'name' => 'AMPHUR_NAME'
                            ],
                        ]);
        }

        echo Json::encode(['output' => $amphoeList, 'selected' => '']);
    }

    /**
    * This function is used to return the data to the DrepDrop widget
    * See more information on http://demos.krajee.com/widget-details/depdrop
    */
    public function actionGetDistrictList() {
        $amphoeList = [];
        $amphoeCode = isset(Yii::$app->request->post('depdrop_all_params')['efprojhdlr-amphoe_code'])?
                            Yii::$app->request->post('depdrop_all_params')['efprojhdlr-amphoe_code']:
                            null;

        if ($amphoeCode != null) {
            $efThaiAmphur = EfThaiAmphur::find()->where(['AMPHUR_CODE' => $amphoeCode])->one();
            $efThaiDistrict = EfThaiDistrict::find()->where(['AMPHUR_ID' => $efThaiAmphur->AMPHUR_ID])->all();
            $amphoeList = ArrayHelper::toArray($efThaiDistrict, [
                            'app\models\EfThaiDistrict' => [
                                'id' => 'DISTRICT_CODE',
                                'name' => 'DISTRICT_NAME'
                            ],
                        ]);
        }

        echo Json::encode(['output' => $amphoeList, 'selected' => '']);
    }
}
