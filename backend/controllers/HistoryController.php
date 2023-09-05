<?php

namespace backend\controllers;

use common\models\History;
use common\models\Stakeholder;
use yii\web\Controller;
use Yii;
use yii\web\ForbiddenHttpException;
use yii\helpers\ArrayHelper;

class HistoryController extends Controller
 {
    public function actionViewHistory()
 {
        // Fetch all History
        $models = History::find()->all();

        // Define the variable to control the display of additional columns
        // $showHistoryColumns = true;
        // Change the value to true or false based on your requirements

        return $this->render( 'view-history', [
            'models' => $models,
            //    'showHistoryColumns' => $showHistoryColumns, // Pass the variable to the view
        ] );
    }

    public function actionViewHistoryDetails($intervention_history_id)
    {
        $model = History::findOne($intervention_history_id);
        
        if (!$model) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        
        return $this->render('view-history-details', [
            'model' => $model,
        ]);
    }
    

    public function actionAddHistory()
    {
        if (Yii::$app->user->can('create')) {
            $model = new History();
    
            $stakeholders = Stakeholder::find()->all();
            $stakeholderList = ArrayHelper::map($stakeholders, 'stakeholder_id', 'organization_name');
    
            if ($this->request->isPost) {
                $Stakeholders = $this->request->post('History')['Stakeholders'];
    
                foreach ($Stakeholders as $stakeholderId) {
                    $newModel = new History();
                    $newModel->load($this->request->post());
                    $newModel->stakeholder_id = $stakeholderId;
                
                    if (!$newModel->save()) {
                        
                    }
                }
    
                return $this->redirect(['view-history', 'intervention_history_id' => $model->intervention_history_id]);
            }
    
            return $this->render('add-history', [
                'model' => $model,
                'stakeholderList' => $stakeholderList,
            ]);
        } else {
            throw new ForbiddenHttpException;
        }
    }
    
    

    public function actionUpdate( $intervention_history_id )
 {
        if ( Yii::$app->user->can( 'update' ) ) {
            $model = $this->findModel( $intervention_history_id );

            if ( $this->request->isPost && $model->load( $this->request->post() ) && $model->save() ) {
                return $this->redirect( [ 'view-history', 'intervention_history_id' => $model->intervention_history_id ] );
            }

            return $this->render( 'update', [
                'model' => $model,
//                'stakeholderList' => $stakeholderList,
            ] );
        } else {
            throw new ForbiddenHttpException;
        }
    }

    public function actionDelete( $intervention_history_id )
 {
        if ( Yii::$app->user->can( 'delete' ) ) {
            $this->findModel( $intervention_history_id )->delete();

            return $this->redirect( [ 'view-history' ] );
        } else {
            throw new ForbiddenHttpException;
        }
    }

    protected function findModel( $intervention_history_id )
 {
        if ( ( $model = History::findOne( [ 'intervention_history_id' => $intervention_history_id ] ) ) !== null ) {
            return $model;
        }

        throw new NotFoundHttpException( 'The requested page does not exist.' );
    }
}
