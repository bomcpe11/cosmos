<?php

namespace app\controllers;

use Yii;
use app\models\EfMenuSub;
use app\models\EfMenuSubSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MenuSubController implements the CRUD actions for EfMenuSub model.
 */
class MenuSubController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['get', 'post'],
                ],
            ],
        ];
    }

    /**
     * Lists all EfMenuSub models.
     * @return mixed
     */
    public function actionIndex($menu_main_id)
    {
        $searchModel = new EfMenuSubSearch();
        $searchModel->MENU_MAIN_ID = intval($menu_main_id);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EfMenuSub model.
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
     * Creates a new EfMenuSub model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($menu_main_id)
    {
        $model = new EfMenuSub();
        
        $model->MENU_MAIN_ID = intval($menu_main_id);

        if ($model->load(Yii::$app->request->post()) && $this->beforeCreate($model) && $model->save()) {
            return;
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing EfMenuSub model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $this->beforeUpdate($model) && $model->save()) {
            return;
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
     * Deletes an existing EfMenuSub model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id, $menu_main_id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index', 'menu_main_id'=>$menu_main_id]);
    }

    /**
     * Finds the EfMenuSub model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EfMenuSub the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EfMenuSub::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
