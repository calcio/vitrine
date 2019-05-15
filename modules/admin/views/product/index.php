<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Product'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                    'attribute' => 'id',
                    'headerOptions' => [
                        'class' => 'col-sm-1 text-center'
                    ],
                    'contentOptions' => [
                        'class' => 'text-center'
                    ],
                ],
                [
                    'attribute' => 'category_id',
                    'headerOptions' => [
                        'class' => 'col-sm-2 text-center'
                    ],
                    'value' => 'category.name',
                    'filter' => $listCategories
                ],
                'name',
                [
                    'attribute' => 'status',
                    'filter' => [
                        $searchModel::STATUS_ACTIVE => $searchModel::STATUS_ACTIVE_STRING , 
                        $searchModel::STATUS_INACTIVE => $searchModel::STATUS_INACTIVE_STRING
                    ],
                    'headerOptions' => [
                        'class' => 'col-sm-2 text-center'
                    ],
                    'contentOptions' => [
                        'class' => 'text-center'
                    ],
                    'format' => 'statusHighlighted',
                ],
                [
                    'attribute' => 'highligt',
                    'headerOptions' => [
                        'class' => 'col-sm-1 text-center'
                    ],
                    'filter' => [
                        $searchModel::STATUS_ACTIVE => $searchModel::STATUS_HIGHLIGHTED_STRING , 
                        $searchModel::STATUS_INACTIVE => $searchModel::STATUS_UNHIGHLIGHTED_STRING
                    ],
                    'contentOptions' => [
                        'class' => 'text-center'
                    ],
                    'format' => 'highlight'
                ],
                [
                    'attribute' => 'price',
                    'format' => 'currency',
                    'headerOptions' => [
                        'class' => 'col-sm-2 text-center'
                    ],
                    'contentOptions' => [
                        'class' => 'text-right'
                    ],
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => 'Actions',
                    'headerOptions' => [
                        'class' => 'col-sm-1 text-center'
                    ],
                    'contentOptions' => [
                        'class' => 'text-center'
                    ],
                    'buttons' => [
                        'delete' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-trash text-danger"></span>', $url, [
                                'name' => 'Delete',
                                'data-confirm' => sprintf(
                                    'Do you wish delete categoty %s?',
                                    $model->name
                                ),
                                'data-method' => 'POST'
                            ]);
                        },
                    ]
                ],
            ],
        ]); ?>
    <?php Pjax::end(); ?>
</div>
