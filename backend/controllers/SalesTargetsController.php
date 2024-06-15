<?php

namespace backend\controllers;

use common\models\SalesTargets;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class SalesTargetsController extends Controller
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
            'query' => SalesTargets::find(),
            
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

    public function actionViewSalesTargets()
    {
        $models = SalesTargets::find()->all();

        $dataProvider = new ActiveDataProvider([
            'query' => SalesTargets::find(),
            'pagination' => [
                'pageSize' => 5, 
            ],
        ]);
         
        return $this->render( 'view-sales-targets', [
            'models' => $models,
            'dataProvider' => $dataProvider,
         
        ] );
    }

    public function actionView( $target_id )
    {
           // Fetch the contact record to ensure it exists
           $model = SalesTargets::findOne( $target_id );
   
           return $this->render( 'view', [
               'model' => $model,
           ] );
       }

    public function actionAddSalesTargets()
    {
        $model = new SalesTargets();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view-sales-targets', 'target_id' => $model->target_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('add-sales-targets', [
            'model' => $model,
        ]);
    }


public function generateMonthYearOptions()
{
    $options = [];
    
   
    $currentMonth = date('n'); 
    $currentYear = date('Y'); 

    $options[date('M Y')] = date('M Y', strtotime("{$currentYear}-{$currentMonth}-01"));

    for ($i = 1; $i <= 5; $i++) {
        $previousYear = $currentYear - $i;
        for ($month = 12; $month >= 1; $month--) {
            $options[date('M Y', strtotime("{$previousYear}-{$month}-01"))] = date('M Y', strtotime("{$previousYear}-{$month}-01"));
        }
    }

    return $options;
}


    public function actionUpdate($target_id)
    {
        $model = $this->findModel($target_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view-sales-targets', 'target_id' => $model->target_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    public function actionDelete($target_id)
    {
        $this->findModel($target_id)->delete();

        return $this->redirect(['view-sales-targets']);
    }

    protected function findModel($target_id)
    {
        if (($model = SalesTargets::findOne(['target_id' => $target_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
