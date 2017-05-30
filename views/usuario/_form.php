<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usuario')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contrasena')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_repeat')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'perfil')->dropDownList([ 'ADMIN' => 'ADMIN', 'CARGUE' => 'CARGUE', 'CONSULTA' => 'CONSULTA', ], ['prompt' => '--Seleccione--']) ?>

    <?= $form->field($model, 'estado')->dropDownList([ 'Activo' => 'Activo', 'Inactivo' => 'Inactivo', ], ['prompt' => '--Seleccione--']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
