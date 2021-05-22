<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
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
            'username',
            // 'authKey',
            // 'passwordHash',
            // 'passwordResetToken',
            // 'email:email',
            [
                'attribute' => 'status',
                'filter' => [
                    $searchModel::STATUS_ACTIVE => $searchModel::STATUS_ACTIVE_STRING ,
                    $searchModel::STATUS_DELETED => $searchModel::STATUS_DELETED_STRING
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
                    'dateFormat' => 'dd/MM/YYYY',
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
                'headerOptions' => ['class' => 'col-sm-1 text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'template' => '{view} {update} {delete} {reset-password}',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash text-danger"></span>', $url, [
                            'name' => 'Delete',
                            'data-confirm' => sprintf(
                                'Do you wish delete categoty %s?',
                                $model->username
                            ),
                            'data-method' => 'POST'
                        ]);
                    },
                    'reset-password' => function ($url, $model) {
                        return '&nbsp;&nbsp;'. Html::a('<span class="glyphicon glyphicon-lock text-success"></span>', $url, [
                            'title' => 'Change password',
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
