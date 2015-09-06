<?php

namespace app\controllers;

use Yii;
use app\models\EfGroupUser;
use app\models\EfGroupUserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GroupUserController implements the CRUD actions for EfGroupUser model.
 */
class GroupUserController extends Controller
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
     * Lists all EfGroupUser models.
     * @return mixed
     */
    public function actionIndex($group_id)
    {
        $searchModel = new EfGroupUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EfGroupUser model.
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
     * Creates a new EfGroupUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EfGroupUser();

        if ($model->load(Yii::$app->request->post()) && $this->beforeCreate($model) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->GROUP_USER_ID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing EfGroupUser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $this->beforeUpdate($model) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->GROUP_USER_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    private function beforeCreate(&$model){
    	$model->CREATE_BY=\Yii::$app->user->identity->id;
    	$model->LAST_UPD_BY=\Yii::$app->user->identity->id;
    	return true;
    }
    private function beforeUpdate(&$model){
    	$model->LAST_UPD_BY=\Yii::$app->user->identity->id;
    	return true;
    }

    /**
     * Deletes an existing EfGroupUser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the EfGroupUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EfGroupUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EfGroupUser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
