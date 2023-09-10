<?php

namespace backend\controllers;

use common\models\LoginForm;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use common\models\Stakeholder;
use common\models\History;
use common\models\Users;
use common\models\Intervention;


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ], 
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

    }
    
    

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
    
        $this->layout = 'blank';
    
        $model = new Users(); 
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user = Users::findByUsername($model->username);
            if ($user && $user->validatePassword($model->password_hash)) {
                Yii::$app->user->login($user);
                return $this->goBack();
            }
            else {
                
              //  $model->addError('username', 'Incorrect username or password.');
                $model->addError('password_hash', 'Incorrect username or password.');
            }
        }
    
        $model->password_hash = ''; 
    
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    
    
    

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
