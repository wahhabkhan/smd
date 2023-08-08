<?php

namespace backend\controllers;

use common\models\LoginForm;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use common\models\Stakeholder;

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
        // Replace this example data with actual data fetched from the database
        $stakeholderData = [
            ['stakeholder_category' => 'multiplier'],
            ['stakeholder_category' => 'brand'],
            ['stakeholder_category' => 'factory'],
            ['stakeholder_category' => 'association'],
            // Add more stakeholders with their corresponding categories here.
        ];
    
        return $this->render('index', ['stakeholderData' => $stakeholderData]);
    }


public function actionFetchInterventionData()
{
    $selectedLocation = Yii::$app->request->get('location');

    // Fetch GIZ Interventions History data
    $interventionsHistory = Yii::$app->db->createCommand("SELECT * FROM giz_interventions_history WHERE organizational_location = :location")
        ->bindValue(':location', $selectedLocation)
        ->queryAll();

    // Fetch GIZ Intervention data
    $gizIntervention = Yii::$app->db->createCommand("SELECT * FROM giz_intervention WHERE organizational_location = :location")
        ->bindValue(':location', $selectedLocation)
        ->queryAll();

    // Return the data in JSON format
    return Yii::$app->response->format = Response::FORMAT_JSON;
    return [
        'interventionsHistory' => $interventionsHistory,
        'gizIntervention' => $gizIntervention,
    ];
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

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

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
