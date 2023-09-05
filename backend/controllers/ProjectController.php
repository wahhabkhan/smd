<?php

namespace backend\controllers;

use common\models\Project;
use common\models\Users;
use yii\web\Controller;
use Yii;
use yii\web\ForbiddenHttpException;

class ProjectController extends Controller
 {

    public function actionViewProject()
 {
        // Fetch all Project
        $models = Project::find()->all();

        return $this->render( 'view-project', [
            'models' => $models,
            //    'showProjectColumns' => $showProjectColumns, // Pass the variable to the view
        ] );

    }

    public function actionViewProjectDetails( $project_id )
 {
        // Fetch the contact record to ensure it exists
        $model = Project::findOne( $project_id );

        return $this->render( 'view-project-details', [
            'model' => $model,
        ] );
    }

    public function actionAddProject()
    {
        if (Yii::$app->user->can('create')) {
            $model = new Project();
    
            if ($model->load($this->request->post())) {
                // Combine start_date and end_date into a formatted duration string
                $model->duration = $model->start_date . ' to ' . $model->end_date;
    
                if ($model->save()) {
                    return $this->redirect(['view-project', 'project_id' => $model->project_id]);
                }
            }
    
            return $this->render('add-project', [
                'model' => $model,
            ]);
        } else {
            throw new ForbiddenHttpException;
        }
    }
    

    public function actionUpdate( $project_id )
 {
        if ( Yii::$app->user->can( 'update' ) ) {
            $model = $this->findModel( $project_id );

            if ( $this->request->isPost && $model->load( $this->request->post() ) && $model->save() ) {
                return $this->redirect( [ 'view-project', 'project_id' => $model->project_id ] );
            }

            return $this->render( 'update', [
                'model' => $model,
            ] );
        } else {
            throw new ForbiddenHttpException;
        }
    }

    public function actionDelete( $project_id )
 {
        if ( Yii::$app->user->can( 'delete' ) ) {
            $this->findModel( $project_id )->delete();

            return $this->redirect( [ '/site/index' ] );
        } else {
            throw new ForbiddenHttpException;
        }
    }

    protected function findModel( $project_id )
 {
        if ( ( $model = Project::findOne( [ 'project_id' => $project_id ] ) ) !== null ) {
            return $model;
        }

        throw new NotFoundHttpException( 'The requested page does not exist.' );
    }
}