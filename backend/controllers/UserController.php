<?php

namespace backend\controllers;
use Yii;
use common\models\Users;
use yii\web\Controller;

class UserController extends Controller
{
    public function actionViewUser()
    {
        $models = Users::find()->all();
    
        return $this->render('view-user', [
            'models' => $models,

        ]);
    }

    public function actionViewUserDetails($id)
    {
        // Fetch the contact record to ensure it exists
        $model = Users::findOne($id);
    
        return $this->render('view-user-details', [
            'model' => $model,
        ]);
    }  
    
    public function actionAddUser()
    {
        $model = new Users();
    
        if ($model->load(Yii::$app->request->post())) {
            $model->password_hash = Yii::$app->security->generatePasswordHash($model->password_hash);
    
            if ($model->save()) {
                return $this->redirect(['view-user', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }
    
        return $this->render('add-user', [
            'model' => $model,
        ]);
    }
    

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view-user', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['view-user']);
    }

    protected function findModel($id)
    {
        if (($model = Users::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }
}
