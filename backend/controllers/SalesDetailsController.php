<?php

namespace backend\controllers;

use common\models\SalesDetails;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\SalesAchieved;
use Yii;
use yii\helpers\ArrayHelper;



class SalesDetailsController extends Controller
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
            'query' => SalesDetails::find(),
            
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

    public function actionViewSalesDetails()
    {
        $models = SalesDetails::find()->all();
    
        // Fetch additional information for each sales_id
        $salesInfo = SalesAchieved::find()
            ->select(['sales_id', 'month_year', 'rep_id'])
            ->distinct()
            ->where(['in', 'sales_id', ArrayHelper::getColumn($models, 'sales_id')])
            ->asArray()
            ->all();
    
        // Create an associative array using sales_id as the key
        $salesInfoMap = [];
        foreach ($salesInfo as $info) {
            $salesInfoMap[$info['sales_id']] = [
                'month_year' => $info['month_year'],
                'rep_id' => $info['rep_id'],
            ];
        }
    
        return $this->render('view-sales-details', [
            'models' => $models,
            'salesInfoMap' => $salesInfoMap,
        ]);
    }
    

    public function actionView( $detail_id )
    {
           // Fetch the contact record to ensure it exists
           $model = SalesDetails::findOne( $detail_id );
   
           return $this->render( 'view', [
               'model' => $model,
           ] );
       }

    public function actionAddSalesDetails()
    {
        $model = new SalesDetails();

     //   $achievedSales = SalesAchieved::find()->select('sales_id')->distinct()->column();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view-sales-details', 'detail_id' => $model->detail_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('add-sales-details', [
            'model' => $model,
          //  'achievedSales' => $achievedSales,
        ]);
    }


    public function actionUpdate($detail_id)
    {
        $model = $this->findModel($detail_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view-sales-details', 'detail_id' => $model->detail_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    public function actionDelete($detail_id)
    {
        $this->findModel($detail_id)->delete();

        return $this->redirect(['view-sales-details']);
    }

    protected function findModel($detail_id)
    {
        if (($model = SalesDetails::findOne(['detail_id' => $detail_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
