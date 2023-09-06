<?php

namespace backend\controllers;
use common\models\Stakeholder;
use common\models\Contact;
use yii\web\Controller;
use Yii;
use yii\web\ForbiddenHttpException;

class ContactController extends Controller
 {
    public function actionViewContact( $stakeholder_id )
 {
        // Fetch the stakeholder record to ensure it exists and belongs to the current user ( you may need to adjust this based on your logic )
        $stakeholder = Stakeholder::findOne( [ 'stakeholder_id' => $stakeholder_id ] );

        // Fetch the contacts related to the specified stakeholder_id
        $contacts = Contact::find()->where( [ 'stakeholder_id' => $stakeholder_id ] )->all();

        return $this->render( 'view-contact', [
            'models' => $contacts,
        ] );
    }

    public function actionViewContactDetails( $id_contacts )
 {
        // Fetch the contact record to ensure it exists
        $model = Contact::findOne( $id_contacts );

        return $this->render( 'view-contact-details', [
            'model' => $model,
        ] );
    }

    public function actionAddContact($stakeholder_id = null)
    {
        if (Yii::$app->user->can('create')) {
            $model = new Contact();
    
            // Assign the stakeholder_id to the model, if available
            if ($stakeholder_id !== null) {
                $model->stakeholder_id = $stakeholder_id;
            }
    
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view-contact', 'id_contacts' => $model->id_contacts, 'stakeholder_id' => $model->stakeholder_id]);
            }
             else {
                $model->loadDefaultValues();
            }
    
            return $this->render('add-contact', [
                'model' => $model,
                'stakeholder_id' => $stakeholder_id, // Pass the variable to the view
            ]);
        } else {
            throw new ForbiddenHttpException;
        }
    }
  

    public function actionUpdate($id_contacts)
    {
        // Find the contact record to update
        $model = $this->findModel($id_contacts);
    
        // Get the stakeholder_id from the contact model
        $stakeholder_id = $model->stakeholder_id;
    
        if (Yii::$app->user->can('update')) {
            if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view-contact', 'id_contacts' => $model->id_contacts, 'stakeholder_id' => $stakeholder_id]);
            }
    
            return $this->render('add-contact', [
                'model' => $model,
                'stakeholder_id' => $stakeholder_id, // Pass the variable to the view
            ]);
        } else {
            throw new ForbiddenHttpException;
        }
    }
 
    public function actionDelete($id_contacts)
    {
        if (Yii::$app->user->can('delete')) {
            $model = $this->findModel($id_contacts);
            $stakeholder_id = $model->stakeholder_id; // Get the stakeholder_id before deletion
            $model->delete();
    
            return $this->redirect(['view-contact', 'stakeholder_id' => $stakeholder_id]);
        } else {
            throw new ForbiddenHttpException;
        }
    }
    

    protected function findModel( $id_contacts )
 {
        if ( ( $model = Contact::findOne( [ 'id_contacts' => $id_contacts ] ) ) !== null ) {
            return $model;
        }

        throw new NotFoundHttpException( 'The requested page does not exist.' );
    }
}
