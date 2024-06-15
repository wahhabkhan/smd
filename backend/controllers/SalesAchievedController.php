<?php

namespace backend\controllers;

use common\models\SalesAchieved;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class SalesAchievedController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => SalesAchieved::find(),
            
            'pagination' => [
                'pageSize' => 5
            ],
            'sort' => [
                'defaultOrder' => [
                    'rep_id' => SORT_ASC,
                ]
            ],          
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionViewSalesAchieved()
    {
        $models = SalesAchieved::find()->all();

        $dataProvider = new ActiveDataProvider([
            'query' => SalesAchieved::find(),
            'pagination' => [
                'pageSize' => 5, 
            ],
        ]);
         
        return $this->render( 'view-sales-achieved', [
            'models' => $models,
            'dataProvider' => $dataProvider,
         
        ] );
    }

    public function actionView( $sales_id )
    {
           // Fetch the contact record to ensure it exists
           $model = SalesAchieved::findOne( $sales_id );
   
           return $this->render( 'view', [
               'model' => $model,
           ] );
       }

    public function actionAddSalesAchieved()
    {
        $model = new SalesAchieved();

       

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view-sales-achieved', 'sales_id' => $model->sales_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('add-sales-achieved', [
            'model' => $model,
        ]);
    }

// Define the function in your controller
public function generateMonthYearOptions()
{
    $options = [];
    
    // Get the current month and year
    $currentMonth = date('n'); // Numeric representation of the current month (1 - 12)
    $currentYear = date('Y'); // 4-digit representation of the current year

    // Add the current month and year to the options
    $options[date('M Y')] = date('M Y', strtotime("{$currentYear}-{$currentMonth}-01"));

    // Generate options for the previous 5 years
    for ($i = 1; $i <= 5; $i++) {
        $previousYear = $currentYear - $i;
        for ($month = 12; $month >= 1; $month--) {
            $options[date('M Y', strtotime("{$previousYear}-{$month}-01"))] = date('M Y', strtotime("{$previousYear}-{$month}-01"));
        }
    }

    return $options;
}


    public function actionUpdate($sales_id)
    {
        $model = $this->findModel($sales_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view-sales-achieved', 'sales_id' => $model->sales_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    public function actionDelete($sales_id)
    {
        $this->findModel($sales_id)->delete();

        return $this->redirect(['view-sales-achieved']);
    }

    protected function findModel($sales_id)
    {
        if (($model = SalesAchieved::findOne(['sales_id' => $sales_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
