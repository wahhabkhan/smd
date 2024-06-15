<?php

use common\models\SalesTargets;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Sales Targets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div style="margin-left:180px" class="sales-targets-index">

    <h3 class="text-success"><?= Html::encode($this->title) ?></h3>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'target_id',
                'headerOptions' => ['class' => 'text-success'], 
            ],
            [
                'attribute' => 'month_year',
                'headerOptions' => ['class' => 'text-success'], 
            ],
            [
                'attribute' => 'sales_target_amount',
                'headerOptions' => ['class' => 'bg-white text-success'], 
            ],
            [
                'attribute' => 'rep_id',
                'headerOptions' => ['class' => 'text-success'], 
            ],
//             [
//     'attribute' => 'rep.user.name', 
//     'label' => 'User', 
//     'headerOptions' => ['class' => 'text-success'],
// ],

            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, SalesTargets $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'target_id' => $model->target_id]);
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
