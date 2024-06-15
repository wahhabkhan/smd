<?php

namespace backend\controllers;

use common\models\Feedback;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class FeedbackController extends Controller
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
            'query' => Feedback::find(),
            
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

    public function actionViewFeedback()
    {
        $models = Feedback::find()->all();

        $dataProvider = new ActiveDataProvider([
            'query' => Feedback::find(),
            'pagination' => [
                'pageSize' => 5, 
            ],
        ]);
         
        return $this->render( 'view-feedback', [
            'models' => $models,
            'dataProvider' => $dataProvider,
         
        ] );
    }

    public function actionView( $feedback_id )
    {
           // Fetch the contact record to ensure it exists
           $model = Feedback::findOne( $feedback_id );
   
           return $this->render( 'view', [
               'model' => $model,
           ] );
       }

    public function actionAddFeedback()
    {
        $model = new Feedback();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view-feedback', 'feedback_id' => $model->feedback_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('add-feedback', [
            'model' => $model,
        ]);
    }


    public function actionUpdate($feedback_id)
    {
        $model = $this->findModel($feedback_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view-feedback', 'feedback_id' => $model->feedback_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    public function actionDelete($feedback_id)
    {
        $this->findModel($feedback_id)->delete();

        return $this->redirect(['view-feedback']);
    }

    protected function findModel($feedback_id)
    {
        if (($model = Feedback::findOne(['feedback_id' => $feedback_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
