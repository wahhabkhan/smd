<?php

namespace backend\controllers;
use Yii;
use common\models\Users;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

class UserController extends Controller
 {
    public function actionViewUser()
 {
        if ( Yii::$app->user->can( 'userview' ) ) {
            $models = Users::find()->all();

            return $this->render( 'view-user', [
                'models' => $models,

            ] );
        } else {
            throw new ForbiddenHttpException;
        }
    }

    public function actionViewUserDetails( $id )
 {
        // Fetch the contact record to ensure it exists
        $model = Users::findOne( $id );

        return $this->render( 'view-user-details', [
            'model' => $model,
        ] );
    }

    public function actionAddUser()
 {
        if ( Yii::$app->user->can( 'create' ) ) {
            $model = new Users();

            if ( $model->load( Yii::$app->request->post() ) ) {
                $model->password_hash = Yii::$app->security->generatePasswordHash( $model->password_hash );

                if ( $model->save() ) {
                    return $this->redirect( [ 'view-user', 'id' => $model->id ] );
                }
            } else {
                $model->loadDefaultValues();
            }

            return $this->render( 'add-user', [
                'model' => $model,
            ] );
        } else {
            throw new ForbiddenHttpException;
        }

    }

    public function actionUpdate( $id )
 {
        if ( Yii::$app->user->can( 'update' ) ) {
            $model = $this->findModel( $id );

            if ( $this->request->isPost && $model->load( $this->request->post() ) ) {
                // Check if the user entered a new password
                if ( !empty( $model->password_hash ) ) {
                    // Generate a new password hash and assign it to the model
                    $model->password_hash = Yii::$app->security->generatePasswordHash( $model->password_hash );
                } else {
                    // If the user didn't enter a new password, retain the existing hashed password
                $model->password_hash = $this->findModel($id)->password_hash;
            }
    
            if ($model->save()) {
                return $this->redirect(['view-user', 'id' => $model->id]);
            }
        }
    
        return $this->render('update', [
            'model' => $model,
        ]);
    } else {
        throw new ForbiddenHttpException;
    }
    }
    

    public function actionDelete($id)
    {
        if ( Yii::$app->user->can( 'delete' ) ) {
        $this->findModel($id)->delete();

        return $this->redirect(['view-user']);
    } else {
        throw new ForbiddenHttpException;
    }
    }

    protected function findModel($id)
    {
        if (($model = Users::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.' );
                }

            }
