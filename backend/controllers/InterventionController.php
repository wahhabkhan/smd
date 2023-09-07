<?php

namespace backend\controllers;

use common\models\Intervention;
use yii\web\Controller;
use common\models\History;
use Yii;
use yii\web\ForbiddenHttpException;

class InterventionController extends Controller
 {
    public function actionViewIntervention()
 {
        // Fetch all Intervention
        $models = Intervention::find()->all();

        // Define the variable to control the display of additional columns
        // $showInterventionColumns = true;
        // Change the value to true or false based on your requirements

        return $this->render( 'view-intervention', [
            'models' => $models,
            //    'showInterventionColumns' => $showInterventionColumns, // Pass the variable to the view
        ] );
    }

    public function actionViewInterventionDetails( $intervention_id )
 {
        // Fetch the contact record to ensure it exists
        $model = Intervention::findOne( $intervention_id );

        return $this->render( 'view-intervention-details', [
            'model' => $model,
        ] );
    }

    public function actionAddIntervention()
 {
        if ( Yii::$app->user->can( 'create' ) ) {
            $model = new Intervention();

            if ( $this->request->isPost ) {
                if ( $model->load( $this->request->post() ) && $model->save() ) {
                    return $this->redirect( [ 'view-intervention', 'intervention_id' => $model->intervention_id ] );
                }
            } else {
                $model->loadDefaultValues();
            }

            return $this->render( 'add-intervention', [
                'model' => $model,
            ] );
        } else {
            throw new ForbiddenHttpException;
        }

    }

    public function actionUpdate( $intervention_id )
 {
        if ( Yii::$app->user->can( 'update' ) ) {
            $model = $this->findModel( $intervention_id );

            if ( $this->request->isPost && $model->load( $this->request->post() ) && $model->save() ) {
                return $this->redirect( [ 'view-intervention', 'intervention_id' => $model->intervention_id ] );
            }

            return $this->render( 'update', [
                'model' => $model,
            ] );
        } else {
            throw new ForbiddenHttpException;
        }
    }

    public function actionDelete( $intervention_id )
 {
        if ( Yii::$app->user->can( 'delete' ) ) {
            // Check if there are associated giz_interventions_history records
            $hasInterventionsHistory = History::find()->where( [ 'intervention_id' => $intervention_id ] )->exists();

            if ( $hasInterventionsHistory ) {
                Yii::$app->session->setFlash( 'error', '--------------------------------------Cannot delete the `Intervention` because there are associated records in `Interventions History`-------------------------' );

            } else {
                $this->findModel( $intervention_id )->delete();
            }

            return $this->redirect( [ 'view-intervention' ] );

        } else {
            throw new ForbiddenHttpException;
        }
    }

    protected function findModel( $intervention_id )
 {
        if ( ( $model = Intervention::findOne( [ 'intervention_id' => $intervention_id ] ) ) !== null ) {
            return $model;
        }

        throw new NotFoundHttpException( 'The requested page does not exist.' );
    }
}
