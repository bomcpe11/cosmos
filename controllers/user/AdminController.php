<?php

namespace app\controllers\user;

use Yii;
use amnah\yii2\user\models\User;
use amnah\yii2\user\models\UserKey;
use amnah\yii2\user\models\UserAuth;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\EfProjHdlr;
use app\models\EfThaiProvince;

/**
 * AdminController implements the CRUD actions for User model.
 */
class AdminController extends Controller
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        // check for admin permission (`tbl_role.can_admin`)
        // note: check for Yii::$app->user first because it doesn't exist in console commands (throws exception)
        if (!empty(Yii::$app->user) && !Yii::$app->user->can("admin")) {
            throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }

        parent::init();
    }

    /**
     * @inheritdoc
     */
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
     * List all User models
     *
     * @return mixed
     */
    public function actionIndex()
    {
        /** @var \amnah\yii2\user\models\search\UserSearch $searchModel */
        $searchModel = Yii::$app->getModule("user")->model("UserSearch");
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Display a single User model
     *
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'user' => $this->findModel($id),
        ]);
    }

    /**
     * Create a new User model. If creation is successful, the browser will
     * be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        /** @var \amnah\yii2\user\models\User $user */
        /** @var \amnah\yii2\user\models\Profile $profile */
    	
        // $provinces = EfThaiProvince::find()->select(['PROVINCE_ID', 'PROVINCE_NAME'])->all();
    	$provinces = EfThaiProvince::find()->all();

        $user = Yii::$app->getModule("user")->model("User");
        $user->setScenario("admin");
        $profile = Yii::$app->getModule("user")->model("Profile");
        
        $ef_proj_hdlr = new EfProjHdlr();

        $post = Yii::$app->request->post();
        if ($user->load($post) 
//         		&& $profile->load($post) 
        		&& $ef_proj_hdlr->load($post) 
        		&& $this->setCreateParams($user, $profile, $ef_proj_hdlr) 
        		&& $user->validate() 
        		&& $profile->validate()
        		&& $ef_proj_hdlr->validate()) {
            $user->save(false);
            $profile->setUser($user->id)->save(false);
            $ef_proj_hdlr->setUser($user->id)->save(false);
            return $this->redirect(['view', 'id' => $user->id]);
        }

//         echo 'user.load: '.$user->load($post);
//         echo ', ef_proj_hdlr.load: '.$ef_proj_hdlr->load($post);
        
// //         print_r($user);
//         echo ', user.validate: '.$user->validate();
//         echo ', profile.validate: '.$profile->validate();
//         echo ', ef_proj_hdlr.validate: '.$ef_proj_hdlr->validate();
        
//         exit();

        // render
        return $this->render('create', [
            'user' => $user,
            'profile' => $profile,
        	'ef_proj_hdlr'=>$ef_proj_hdlr,
        	'provinces'=>$provinces
        ]);
    }
    
    protected function setCreateParams(&$user, &$profile, &$ef_proj_hdlr){
    	$user->email = $ef_proj_hdlr->RESP_EMAIL;
    	$profile->full_name = $user->username;
    	$user->role_id = 2;
    	$user->status = 1;
    	$user->ban_time = 0;
    	$user->ban_reason = '';
    	$ef_proj_hdlr->PROJ_HDLR_ID=$ef_proj_hdlr->getId();
    	$ef_proj_hdlr->USER_ID=1;
    	$ef_proj_hdlr->CREATE_BY=\Yii::$app->user->identity->id;
    	$ef_proj_hdlr->LAST_UPD_BY=\Yii::$app->user->identity->id;
    	return true;
    }

    /**
     * Update an existing User model. If update is successful, the browser
     * will be redirected to the 'view' page.
     *
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
    	$provinces = EfThaiProvince::find()->all();
    	
        // set up user and profile
        $user = $this->findModel($id);
        $user->setScenario("admin");
        $profile = $user->profile;

        $ef_proj_hdlr = $this->findEfProjHdlrModel($id);

        // load post data and validate
        $post = Yii::$app->request->post();
        if ($user->load($post)
        		&& $ef_proj_hdlr->load($post) 
        		&& $this->setUpdateParams($user, $profile, $ef_proj_hdlr) 
        		&& $user->validate() 
        		&& $profile->validate()
        		&& $ef_proj_hdlr->validate()) {
            $user->save(false);
            $profile->setUser($user->id)->save(false);
            $ef_proj_hdlr->save(false);
            return $this->redirect(['view', 'id' => $user->id]);
        }

        // render
        return $this->render('update', [
            'user' => $user,
            'profile' => $profile,
        	'ef_proj_hdlr' => $ef_proj_hdlr,
        	'provinces' => $provinces
        ]);
    }
    
    protected function setUpdateParams(&$user, &$profile, &$ef_proj_hdlr){
    	$user->email = $ef_proj_hdlr->RESP_EMAIL;
    	$profile->full_name = $user->username;
    	$user->role_id = 2;
    	$user->status = 1;
    	$user->ban_time = 0;
    	$user->ban_reason = '';
    	$ef_proj_hdlr->LAST_UPD_BY=\Yii::$app->user->identity->id;
    	return true;
    }

    /**
     * Delete an existing User model. If deletion is successful, the browser
     * will be redirected to the 'index' page.
     *
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        // delete profile and userkeys first to handle foreign key constraint
        $user = $this->findModel($id);
        $profile = $user->profile;
        UserKey::deleteAll(['user_id' => $user->id]);
        UserAuth::deleteAll(['user_id' => $user->id]);
        $profile->delete();
        $user->delete();

        return $this->redirect(['index']);
    }

    /**
     * Find the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param string $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        /** @var \amnah\yii2\user\models\User $user */
        $user = Yii::$app->getModule("user")->model("User");
        if (($user = $user::findOne($id)) !== null) {
            return $user;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findEfProjHdlrModel($id)
    {
    	if (($model = EfProjHdlr::find()->where(['USER_ID' => $id])->one()) !== null) {
    		return $model;
    	} else {
    		throw new NotFoundHttpException('The requested page does not exist.');
    	}
    }
}
