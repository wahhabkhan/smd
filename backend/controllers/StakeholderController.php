<?php

namespace backend\controllers;

use common\models\Stakeholder;
use yii\web\Controller;
use Yii;
use yii\web\ForbiddenHttpException;

class StakeholderController extends Controller
 {
    public function actionViewStakeholder()
 {
        $models = Stakeholder::find()->all();
        // Assume $stakeholder is an array of stakeholder categories as you provided earlier
        $stakeholder = [
            'government' => 'Government',
            'multiplier' => 'Multiplier',
            'factory' => 'Factory',
            'association' => 'Association',
            'brand' => 'Brand',
        ];

        // Fetch stakeholders data from the database and other necessary data
        // ...

        return $this->render( 'view-stakeholder', [
            'stakeholder' => $stakeholder,
            'models' => $models, // Pass other necessary data to the view
            // ...
        ] );
    }

    public function actionViewStakeholderDetails( $stakeholder_id )
 {
        // Fetch the contact record to ensure it exists
        $model = Stakeholder::findOne( $stakeholder_id );

        return $this->render( 'view-stakeholder-details', [
            'model' => $model,
        ] );
    }

    public function actionAddStakeholder()
 {
        if ( Yii::$app->user->can( 'create' ) ) {
            $model = new Stakeholder();

            if ( $this->request->isPost ) {
                if ( $model->load( $this->request->post() ) && $model->save() ) {
                    return $this->redirect( [ 'view-stakeholder', 'stakeholder_id' => $model->stakeholder_id ] );
                }
            } else {
                $model->loadDefaultValues();
            }

            return $this->render( 'add-stakeholder', [
                'model' => $model,
            ] );
        } else {
            throw new ForbiddenHttpException;
        }
    }

    public function actionUpdate( $stakeholder_id )
 {
        if ( Yii::$app->user->can( 'update' ) ) {
            $model = $this->findModel( $stakeholder_id );

            if ( $this->request->isPost && $model->load( $this->request->post() ) && $model->save() ) {
                return $this->redirect( [ 'view-stakeholder', 'stakeholder_id' => $model->stakeholder_id ] );
            }

            return $this->render( 'update', [
                'model' => $model,
            ] );
        } else {
            throw new ForbiddenHttpException;
        }
    }

    public function actionDelete( $stakeholder_id )
 {
        if ( Yii::$app->user->can( 'delete' ) ) {
            $this->findModel( $stakeholder_id )->delete();

            return $this->redirect( [ 'view-stakeholder' ] );
        } else {
            throw new ForbiddenHttpException;
        }
    }

    protected function findModel( $stakeholder_id )
 {
        if ( ( $model = Stakeholder::findOne( [ 'stakeholder_id' => $stakeholder_id ] ) ) !== null ) {
            return $model;
        }

        throw new NotFoundHttpException( 'The requested page does not exist.' );
    }
}
