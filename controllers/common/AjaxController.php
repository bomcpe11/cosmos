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
use app\models\EfDivision;
use app\models\EfProjectType;

class AjaxController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                                        'get-amphur-list', 
                                		'get-district-list', 
                                		'get-efdivision-list',
                                        'get-project-group-list'
                                    ],
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
     * This function is used to return the data to the DepDrop widget
     * See more information on http://demos.krajee.com/widget-details/depdrop
     */
    public function actionGetEfdivisionList() {
    	$divisionList = [];
    	$unitId = isset(Yii::$app->request->post('depdrop_all_params')['efproject-unit_id'])?
    			Yii::$app->request->post('depdrop_all_params')['efproject-unit_id']:null;
    
    	if ($unitId != null) {
    		$efDivision = EfDivision::find()->where(['UNIT_ID' => $unitId])->all();
    		$divisionList = ArrayHelper::toArray($efDivision, [
    				'app\models\EfDivision' => [
    						'id' => 'DIVISION_ID',
    						'name' => 'DIVISION_NAME'
    				],
    		]);
    	}
    
    	echo Json::encode(['output' => $divisionList, 'selected' => '']);
    }

   
    /**
     * This function is used to return the data to the DepDrop widget
     * See more information on http://demos.krajee.com/widget-details/depdrop
     */
    public function actionGetProjectGroupList()
    {
        $projectGroupList = [];
        $postData = Yii::$app->request->post('depdrop_all_params');

        if (isset($postData['efproject-project_group_id'])) {
            $efProjectType = EfProjectType::find()
                                    ->where(['PROJECT_GROUP_ID' => $postData['efproject-project_group_id']])
                                    ->all();

            $projectGroupList = ArrayHelper::toArray($efProjectType, [
                                    'app\models\EfProjectType' => [
                                        'id' => 'PROJECT_TYPE_ID',
                                        'name' => 'PROJECT_TYPE_NAME'
                                    ],
                                ]);
        }

        echo Json::encode(['output' => $projectGroupList, 'selected' => '']);
    }

    /**
    * This function is used to return the data to the DepDrop widget
    * See more information on http://demos.krajee.com/widget-details/depdrop
    */
    public function actionGetAmphurList() {
        $amphoeList = [];
        if (isset($_POST['depdrop_parents'])) {
        	$id = end($_POST['depdrop_parents']);
            $efThaiAmphur = EfThaiAmphur::find()->where(['PROVINCE_ID' => $id])->all();
            $amphoeList = ArrayHelper::toArray($efThaiAmphur, [
                            'app\models\EfThaiAmphur' => [
                                'id' => 'AMPHUR_ID',
                                'name' => 'AMPHUR_NAME'
                            ],
                        ]);
        }

        echo Json::encode(['output' => $amphoeList, 'selected' => '']);
    }

    /**
    * This function is used to return the data to the DepDrop widget
    * See more information on http://demos.krajee.com/widget-details/depdrop
    */
    public function actionGetDistrictList() {
        $amphoeList = [];
        if (isset($_POST['depdrop_parents'])) {
        	$id = end($_POST['depdrop_parents']);
            $efThaiDistrict = EfThaiDistrict::find()->where(['AMPHUR_ID' => $id])->all();
            $amphoeList = ArrayHelper::toArray($efThaiDistrict, [
                            'app\models\EfThaiDistrict' => [
                                'id' => 'DISTRICT_ID',
                                'name' => 'DISTRICT_NAME'
                            ],
                        ]);
        }

        echo Json::encode(['output' => $amphoeList, 'selected' => '']);
    }
}
