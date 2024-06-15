<?php

namespace backend\controllers;

use common\models\SalesRepresentatives;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class SalesRepresentativesController extends Controller
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
            'query' => SalesRepresentatives::find(),
            
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

    public function actionViewSalesRepresentatives()
    {
        $models = SalesRepresentatives::find()->all();

        $dataProvider = new ActiveDataProvider([
            'query' => SalesRepresentatives::find(),
            'pagination' => [
                'pageSize' => 5, 
            ],
        ]);
         
        return $this->render( 'view-sales-representatives', [
            'models' => $models,
            'dataProvider' => $dataProvider,
         
        ] );
    }

    public function actionView( $rep_id )
    {
           // Fetch the contact record to ensure it exists
           $model = SalesRepresentatives::findOne( $rep_id );
   
           return $this->render( 'view', [
               'model' => $model,
           ] );
       }

    public function actionAddSalesRepresentatives()
    {
        $model = new SalesRepresentatives();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view-sales-representatives', 'rep_id' => $model->rep_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('add-sales-representatives', [
            'model' => $model,
        ]);
    }


    public function actionUpdate($rep_id)
    {
        $model = $this->findModel($rep_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view-sales-representatives', 'rep_id' => $model->rep_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    public function actionDelete($rep_id)
    {
        $this->findModel($rep_id)->delete();

        return $this->redirect(['view-sales-representatives']);
    }

    protected function findModel($rep_id)
    {
        if (($model = SalesRepresentatives::findOne(['rep_id' => $rep_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
