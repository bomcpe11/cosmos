<?php

namespace app\controllers;

use Yii;
use app\models\EfGroupRole;
use app\models\EfGroupRoleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GroupRoleController implements the CRUD actions for EfGroupRole model.
 */
class GroupRoleController extends Controller
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
     * Lists all EfGroupRole models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EfGroupRoleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EfGroupRole model.
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
     * Creates a new EfGroupRole model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EfGroupRole();

        if ($model->load(Yii::$app->request->post()) && $this->beforeCreate($model) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->GROUP_ROLE_ID]);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing EfGroupRole model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $this->beforeUpdate($model) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->GROUP_ROLE_ID]);
        } else {
            return $this->renderAjax('update', [
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
     * Deletes an existing EfGroupRole model.
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
     * Finds the EfGroupRole model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EfGroupRole the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EfGroupRole::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
