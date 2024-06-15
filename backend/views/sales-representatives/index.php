<?php

use common\models\SalesRepresentatives;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Sales Representatives';
$this->params['breadcrumbs'][] = $this->title;
?>
<div style="margin-left:180px" class="sales-representatives-index">

    <h3 class="text-success"><?= Html::encode($this->title) ?></h3>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'rep_id',
                'headerOptions' => ['class' => 'text-success'], 
            ],
            [
                'attribute' => 'contact_number',
                'headerOptions' => ['class' => 'text-success'], 
            ],
            [
                'attribute' => 'region',
                'headerOptions' => ['class' => 'text-success'], 
            ],
            [
                'attribute' => 'user.name', 
                'label' => 'User', 
                'headerOptions' => ['class' => 'text-primary'],
            ],
            
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, SalesRepresentatives $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'rep_id' => $model->rep_id]);
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
