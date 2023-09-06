<?php
use yii\bootstrap4\Alert;
use yii\helpers\Html;

foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
    echo Alert::widget([
        'options' => ['class' => 'alert-dismissible alert-' . $key],
        'body' => Html::encode($message),
    ]);
}
?>
