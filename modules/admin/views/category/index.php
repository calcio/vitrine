<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Category'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php 
    Pjax::begin([
        'enablePushState' => false,
    ]);
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'headerOptions' => [
                    'class' => 'col-sm-1 text-center'
                ],
                'contentOptions' => [
                    'class' => 'text-center'
                ],
            ],

            [
                'label' => 'ID',
                'attribute' => 'id',
                'value' => 'id',
                'headerOptions' => [
                    'class' => 'col-sm-1 text-center'
                ],
                'contentOptions' => [
                    'class' => 'text-right'
                ],
            ],
            [
                'attribute' => 'name',
                'headerOptions' => [
                    'class' => 'col-sm-3'
                ],
            ],
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
                'attribute' => 'created_at',
                'filter' => '<div class="drp-container input-group">'. 
                DatePicker::widget([
                    'model'=>$searchModel,
                    'attribute'=>'created_at',
                    'language' => 'pt-BR',
                    'dateFormat' => 'dd/MM/yyyy',
                    'options' => [
                        'class' => 'form-control'
                    ],
                ]) . '<span class="input-group-addon">
                    <i class="glyphicon glyphicon-calendar"></i></span>
                </div>',
                'format' => [
                    'date', 'short'
                ],
                'headerOptions' => [
                    'class' => 'col-sm-2 text-center'
                ],
                'contentOptions' => [
                    'class' => 'text-center'
                ],
            ],
            [
                'attribute' => 'updated_at',
                'filter' => '<div class="drp-container input-group">'. 
                DatePicker::widget([
                    'model'=>$searchModel,
                    'attribute'=>'updated_at',
                    'language' => 'pt-BR', 
                    'dateFormat' => 'dd/MM/yyyy',
                    'options' => [
                        'class' => 'form-control'
                    ],
                ]) . '<span class="input-group-addon">
                    <i class="glyphicon glyphicon-calendar"></i></span>
                </div>',
                'format' => [
                    'date', 'short'
                ],
                'headerOptions' => [
                    'class' => 'col-sm-2 text-center'
                ],
                'contentOptions' => [
                    'class' => 'text-center'
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
