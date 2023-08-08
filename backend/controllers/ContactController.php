<?php

namespace backend\controllers;
use common\models\Stakeholder;
use common\models\Contact;
use yii\web\Controller;

class ContactController extends Controller
{
    public function actionViewContact($stakeholder_id)
    {
        // Fetch the stakeholder record to ensure it exists and belongs to the current user (you may need to adjust this based on your logic)
        $stakeholder = Stakeholder::findOne(['stakeholder_id' => $stakeholder_id]);

        // Fetch the contacts related to the specified stakeholder_id
        $contacts = Contact::find()->where(['stakeholder_id' => $stakeholder_id])->all();

        return $this->render('view-contact', [
            'models' => $contacts,
        ]);
    }
    
    public function actionViewContactDetails($id_contacts)
{
    // Fetch the contact record to ensure it exists
    $model = Contact::findOne($id_contacts);

    return $this->render('view-contact-details', [
        'model' => $model,
    ]);
}

// public function actionIndex($id_contacts)
// {
//     $model = Contact::findOne($id_contacts);
//     return $this->render('view-contact', [
//         'models' => $contacts,
//     ]);
// }

    public function actionAddContact()
    {
        $model = new Contact();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view-contact', 'id_contacts' => $model->id_contacts]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('add-contact', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id_contacts)
    {
        $model = $this->findModel($id_contacts);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view-contact', 'id_contacts' => $model->id_contacts]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id_contacts)
    {
        $this->findModel($id_contacts)->delete();

        return $this->redirect(['view-contact']);
    }

    protected function findModel($id_contacts)
    {
        if (($model = Contact::findOne(['id_contacts' => $id_contacts])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
