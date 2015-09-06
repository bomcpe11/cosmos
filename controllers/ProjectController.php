<?php

namespace app\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use app\models\EfProject;
use app\models\EfProjectDoc;
use app\models\EfProjectImage;
use app\models\EfProjectSearch;
use app\models\DocumentUploadForm;

/**
 * ProjectController implements the CRUD actions for EfProject model.
 */
class ProjectController extends base\AppController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all EfProject models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EfProjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EfProject model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new EfProject model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EfProject();

        if ($model->load(Yii::$app->request->post()) && $this->setCreateParams($model) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->PROJECT_ID]);
        } else {
        	
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    
    protected function setCreateParams(&$model){
    	$model->PROJECT_ID = $model->getId();
    	$model->CREATE_BY=\Yii::$app->user->identity->id;
    	$model->LAST_UPD_BY=\Yii::$app->user->identity->id;
    	return true;
    }

    /**
     * Updates an existing EfProject model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post()) && $this->setUpdateParams($model) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->PROJECT_ID]);
        } else {
            $documentUploadForm = new DocumentUploadForm();
            $documentUploadFormConfigs = [];

            $documentUploadFormConfigs['initialPreview'] = [];
            $documentUploadFormConfigs['initialPreviewConfig'] = [];

            $projectDoc = EfProjectDoc::find()->where(['PROJECT_ID' => $id])->all();
            foreach ($projectDoc as $key => $value) {
                array_push($documentUploadFormConfigs['initialPreview'], $this->getDocumentPreviewTamplate($value));
                array_push($documentUploadFormConfigs['initialPreviewConfig'], $this->getDocumentPreviewConfig($value));
            }

            return $this->render('update', [
                'model' => $model,
                'documentUploadForm' => $documentUploadForm,
                'documentUploadFormConfigs' => $documentUploadFormConfigs
            ]);
        }
    }
    
    protected function setUpdateParams(&$model){
    	$model->LAST_UPD_BY=\Yii::$app->user->identity->id;
    	return true;
    }

    /**
     * Deletes an existing EfProject model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    // Ajax function
    public function actionDocumentUpload()
    {
        $result = [];

        $user = Yii::$app->user->identity;
        $model = new DocumentUploadForm();
        $model->file = UploadedFile::getInstance($model, 'file');
        
        if (Yii::$app->request->isPost && $model->file != null) {
            
            $absolutePath = Yii::getAlias('@webroot').'/doc/';
            $urlPath = Yii::$app->request->BaseUrl.'/doc/';

            $fileName = $model->upload($absolutePath);

            $projectDoc = new EfProjectDoc();
            $projectDoc->PROJECT_ID = Yii::$app->request->post('project_id');
            $projectDoc->DOC_PATH = $urlPath;
            $projectDoc->ABSOLUTE_DOC_PATH = $absolutePath;
            $projectDoc->FILE_NAME = $fileName;
            $projectDoc->DOC_DESC = '';
            $projectDoc->CREATE_BY = $user->email;
            $projectDoc->LAST_UPD_BY = $user->email;

            if ($projectDoc->save()) {
                $result = [
                            'initialPreview' => [
                                $this->getDocumentPreviewTamplate($projectDoc)
                            ],
                           'initialPreviewConfig' => [
                                $this->getDocumentPreviewConfig($projectDoc)
                            ],
                        ];
            } else {
                Yii::trace(print_r($projectDoc->errors, true), 'debug');
                $result = ['error' => 'Uploaded fail.(project_doc)'];
            }
        } else {
            $result = ['error' => 'กรุณาเลือกไฟล์'];
        }

        echo Json::encode($result);
    }

    public function actionDeleteDocumentUpload()
    {
        $result = [];
        $user = Yii::$app->user->identity;
        $postData = Yii::$app->request->post();

        $projectDoc = EfProjectDoc::findOne($postData['key']);
        if (!empty($projectDoc)) {
            if (unlink($projectDoc->ABSOLUTE_DOC_PATH.$projectDoc->FILE_NAME)) {
                $projectDoc->delete();
            } else {
                Yii::trace(print_r(error_get_last()), 'debug');
                $result = ['error' => 'ลบไฟล์ผิดพลาด'];
            }
        } else {
            $result = ['error' => 'ไม่พบข้อมูล'];
        }

        echo Json::encode($result);
    }

    private function getDocumentPreviewTamplate($projectDoc)
    {
        return '<a href="'.$projectDoc->DOC_PATH.$projectDoc->FILE_NAME.'" target="_blank">'
                    .'<img style="height:100px" src="'.Url::to('@web/images/word-file-icon.png').'">'
                .'</a>';
    }

    private function getDocumentPreviewConfig($projectDoc)
    {
        return [
                    'caption' => $projectDoc->FILE_NAME, 
                    'width' => "120px", 
                    'url' => Url::to(['delete-document-upload']), 
                    'key' => $projectDoc->PROJECT_DOC_ID,
                    'extra' => []
                ];            
    }
    
    /**
     * Finds the EfProject model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EfProject the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EfProject::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
