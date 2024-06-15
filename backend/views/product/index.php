<?php

use common\models\Product;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Product';
$this->params['breadcrumbs'][] = $this->title;
?>
<div style="margin-left:180px" class="product-index">

    <h3 class="text-success"><?= Html::encode($this->title) ?></h3>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'product_id',
                'headerOptions' => ['class' => 'text-success'], 
            ],
            [
                'attribute' => 'product_name',
                'headerOptions' => ['class' => 'text-success'], 
            ],
            [
                'attribute' => 'price',
                'headerOptions' => ['class' => 'text-success'], 
            ],
            
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Product $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'product_id' => $model->product_id]);
                 },
                 'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('<span class="btn btn-success">View</span>', $url); 
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('<span class="btn btn-success">Update</span>', $url); 
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('<span class="btn btn-success">Delete</span>', $url, [
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]); 
                    },
                ],
            ],
            
        ],
    ]); ?>


</div>
