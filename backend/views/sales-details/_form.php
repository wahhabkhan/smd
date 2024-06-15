<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Product;
use common\models\SalesAchieved;
use common\models\SalesRepresentatives;

/** @var yii\web\View $this */
/** @var common\models\SalesDetails $model */
/** @var yii\widgets\ActiveForm $form */

//$achievedSales = SalesAchieved::find()->select('sales_id')->distinct()->column();

//$achievedSales = SalesAchieved::find()->select('rep_id')->distinct()->column();

// Filter the Sales Representatives to only include those in Sales Achieved
// $repList = SalesRepresentatives::find()
//     ->select(['rep_id', 'users.name AS rep_name']) // Include the user name
//     ->leftJoin('users', 'users.id = sales_representatives.id') // Assuming the foreign key relationship is 'id'
//     ->where(['rep_id' => $achievedSales])
//     ->asArray()
//     ->all();

//$repList = ArrayHelper::map($repList, 'rep_id', 'rep_name'); // Map rep_id to user_name

$products = Product::find()->all();
$productList = ArrayHelper::map($products, 'product_id', 'product_name');

//$achievedSales = SalesAchieved::find()->select('sales_id')->distinct()->column();
//$salesList = ArrayHelper::map($achievedSales, 'sales_id', 'sales_id');
$salesList = SalesAchieved::find()->all();

?>



<div style="margin-left: 180px" class="sales-details-form w-75">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'quantity_sold')->textInput(['maxlength' => true]) ?>

    <?=$form->field($model, 'product_id')->dropDownList(
        $productList,
        ['prompt' => 'Select Product']
        )?>

<?= $form->field($model, 'sales_id')->dropDownList(
        ArrayHelper::map($salesList, 'sales_id', function($model) {
            return $model->sales_id . ' - ' . $model->month_year . ' - ' . $model->rep_id; // Display both sales_id and month_year
        }),
        ['prompt' => 'Select Sales ID']
    ) ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
