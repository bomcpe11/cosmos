<?php

namespace app\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use app\models\EfProject;
use app\models\EfProjectDoc;
use app\models\EfProjectImage;
use app\models\EfProjectSearch;
use app\models\DocumentUploadForm;
use app\models\ImageUploadForm;

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
        $model = $this->findModel($id);
        $documentUploadForm = new DocumentUploadForm();
        $imageUploadForm = new ImageUploadForm();
        
        return $this->render('view', [
            'model' => $model,
            'mode' => 'view',
            'documentUploadForm' => $documentUploadForm,
            'documentUploadFormConfigs' => $this->getDocumentUploadFormConfigs($model->PROJECT_ID, $documentUploadForm),
            'imageUploadForm' => $imageUploadForm,
            'imageUploadFormConfigs' => $this->getImageUploadFormConfigs($model->PROJECT_ID)
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
            $documentUploadForm = new DocumentUploadForm();
        	$imageUploadForm = new ImageUploadForm();

            return $this->render('create', [
                'model' => $model,
                'mode' => 'create',
                'documentUploadForm' => $documentUploadForm,
                'imageUploadForm' => $imageUploadForm,
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
            $imageUploadForm = new ImageUploadForm();

            return $this->render('update', [
                'model' => $model,
                'mode' => 'update',
                'documentUploadForm' => $documentUploadForm,
                'documentUploadFormConfigs' => $this->getDocumentUploadFormConfigs($model->PROJECT_ID, $documentUploadForm),
                'imageUploadForm' => $imageUploadForm,
                'imageUploadFormConfigs' => $this->getImageUploadFormConfigs($model->PROJECT_ID)
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
    public function actionDelete()
    {
        $id = Yii::$app->request->post('id');

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /* *** Ajax function *** */
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
            $projectDoc->CREATE_BY = $user->id;
            $projectDoc->LAST_UPD_BY = $user->id;

            if ($projectDoc->save()) {
                $result = [
                            'initialPreview' => [
                                $this->getDocumentPreviewTamplate($model, $projectDoc)
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

    public function actionImageUpload()
    {
        $result = [];

        $user = Yii::$app->user->identity;
        $imageUploadForm = new ImageUploadForm();
        $imageUploadForm->file = UploadedFile::getInstance($imageUploadForm, 'file');
        
        if (Yii::$app->request->isPost && $imageUploadForm->file != null) {
            $imageUploadForm->upload();

            $projectImage = new EfProjectImage();
            $projectImage->PROJECT_ID = Yii::$app->request->post('project_id');
            $projectImage->ABSOLUTE_IMAGE_PATH = $imageUploadForm->absolutePath;
            $projectImage->IMAGE_PATH = $imageUploadForm->urlPath;
            $projectImage->FILE_NAME = $imageUploadForm->fileName;
            $projectImage->THUMBNAIL_IMAGE_PATH = 'duumy';
            $projectImage->IMAGE_DESC = '';
            $projectImage->CREATE_BY = $user->id;
            $projectImage->LAST_UPD_BY = $user->id;

            if ($projectImage->save()) {
                $result = [
                            'initialPreview' => [
                                $this->getImagePreviewTamplate($projectImage)
                            ],
                           'initialPreviewConfig' => [
                                $this->getImagePreviewConfig($projectImage)
                            ],
                        ];
            } else {
                Yii::trace(print_r($projectImage->errors, true), 'debug');
                $result = ['error' => 'Saved fail'];
            }
        } else {
            $result = ['error' => 'กรุณาเลือกไฟล์'];
        }

        echo Json::encode($result);
    }

    public function actionDeleteImageUpload()
    {
        $result = [];
        $user = Yii::$app->user->identity;
        $postData = Yii::$app->request->post();

        $projectImage = EfProjectImage::findOne($postData['key']);
        if (!empty($projectImage)) {
            if (unlink($projectImage->ABSOLUTE_IMAGE_PATH.$projectImage->FILE_NAME)) {
                $projectImage->delete();
            } else {
                Yii::trace(print_r(error_get_last()), 'debug');
                $result = ['error' => 'ลบไฟล์ผิดพลาด'];
            }
        } else {
            $result = ['error' => 'ไม่พบข้อมูล'];
        }

        echo Json::encode($result);
    }
    /* ************************************************* */


    /* *** private function *** */
    private function getDocumentUploadFormConfigs($projectId, $documentUploadForm)
    {
        $documentUploadFormConfigs = [];
        $documentUploadFormConfigs['initialPreview'] = [];
        $documentUploadFormConfigs['initialPreviewConfig'] = [];

        $projectDoc = EfProjectDoc::find()->where(['PROJECT_ID' => $projectId])->all();
        foreach ($projectDoc as $key => $value) {
            array_push($documentUploadFormConfigs['initialPreview'], $this->getDocumentPreviewTamplate($documentUploadForm, $value));
            array_push($documentUploadFormConfigs['initialPreviewConfig'], $this->getDocumentPreviewConfig($value));
        }

        return $documentUploadFormConfigs;
    }


    private function getDocumentPreviewTamplate($documentUploadForm, $projectDoc)
    {
        $splitFileName = explode('.', $projectDoc->FILE_NAME);
        return '<div class="file-preview-other-frame">'
                    .'<a href="'.$projectDoc->DOC_PATH.$projectDoc->FILE_NAME.'" target="_blank">'
                        .'<span class="file-icon-4x">'.$documentUploadForm->getIcon($splitFileName[count($splitFileName) - 1]).'</span>'
                    .'</a>'
                .'</div>';
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

    private function getImageUploadFormConfigs($projectId)
    {
        $imageUploadFormConfigs = [];
        $imageUploadFormConfigs['initialPreview'] = [];
        $imageUploadFormConfigs['initialPreviewConfig'] = [];

        $projectImage = EfProjectImage::find()->where(['PROJECT_ID' => $projectId])->all();
        foreach ($projectImage as $key => $value) {
            array_push($imageUploadFormConfigs['initialPreview'], $this->getImagePreviewTamplate($value));
            array_push($imageUploadFormConfigs['initialPreviewConfig'], $this->getImagePreviewConfig($value));
        }

        return $imageUploadFormConfigs;
    }

    private function getImagePreviewTamplate($projectImage)
    {
        // string a ( $text, $url = null, $options = [] )
        return Html::a(Html::img($projectImage->IMAGE_PATH.$projectImage->FILE_NAME,
                        [
                            'title' => $projectImage->FILE_NAME,
                            'alt' => $projectImage->FILE_NAME,
                            'style' => [
                                'height' => '100px'
                            ]
                        ]),
                    $projectImage->IMAGE_PATH.$projectImage->FILE_NAME,
                    [
                        'target' => '_blank'
                    ]);
    }

    private function getImagePreviewConfig($projectImage)
    {
        return [
                    'caption' => $projectImage->FILE_NAME, 
                    'width' => "120px", 
                    'url' => Url::to(['delete-image-upload']), 
                    'key' => $projectImage->PROJECT_IMAGE_ID,
                    'extra' => []
                ];            
    }
    /* ************************************************* */
    
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
