<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DocumentoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="documento-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'iddocumento') ?>

    <?= $form->field($model, 'ruta') ?>

    <?= $form->field($model, 'fechasis') ?>

    <?= $form->field($model, 'tercero_idtercero') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'apellido') ?>

    <?= $form->field($model, 'tipodoc_idtipodoc') ?>

    <?php  echo $form->field($model, 'referencia') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
