<?php

namespace backend\controllers;

use common\models\Product;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class ProductController extends Controller
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
            'query' => Product::find(),
            
            'pagination' => [
                'pageSize' => 5
            ],
            'sort' => [
                'defaultOrder' => [
                    'product_id' => SORT_ASC,
                ]
            ],          
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionViewProduct()
    {
        $models = Product::find()->all();

        $dataProvider = new ActiveDataProvider([
            'query' => Product::find(),
            'pagination' => [
                'pageSize' => 5, 
            ],
        ]);
         
        return $this->render( 'view-product', [
            'models' => $models,
            'dataProvider' => $dataProvider,
         
        ] );
    }

    public function actionView( $product_id )
    {
           // Fetch the contact record to ensure it exists
           $model = Product::findOne( $product_id );
   
           return $this->render( 'view', [
               'model' => $model,
           ] );
       }

    public function actionAddProduct()
    {
        $model = new Product();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view-product', 'product_id' => $model->product_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('add-product', [
            'model' => $model,
        ]);
    }


    public function actionUpdate($product_id)
    {
        $model = $this->findModel($product_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view-product', 'product_id' => $model->product_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    public function actionDelete($product_id)
    {
        $this->findModel($product_id)->delete();

        return $this->redirect(['view-product']);
    }

    protected function findModel($product_id)
    {
        if (($model = Product::findOne(['product_id' => $product_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
