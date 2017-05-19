<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Ciudad;
use kartik\select2\Select2;
//use app\assets\AppAsset.php
/* @var $this yii\web\View */
/* @var $model app\models\Tercero */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tercero-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idtercero')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombres')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>

<?php    // Normal select with ActiveForm & model
    echo $form->field($model, 'idciudad')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Ciudad::find()->orderBy(['departamento'=>SORT_ASC,'nombre'=>SORT_ASC])->all(),'idciudad','Nomdane'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione una Ciudad ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); 

?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
