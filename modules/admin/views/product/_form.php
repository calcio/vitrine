<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-7">
            <?= $form->field($model, 'category_id')->dropdownList(
                $listCategories,
                ['prompt' => Yii::t('app', 'Select an item')]);
            ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
        </div>
        
        <div class="col-xs-1">&nbsp;</div>

        <div class="col-md-3">
            <?= $form->field($model, 'cover')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'highligt')->radioList($model->getStatusHighlighted())->label('Highlighted?') ?>
            <hr />
            <?= $form->field($model, 'status')->radioList($model->getStatusItems()) ?>            
        </div>
    </div>    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
