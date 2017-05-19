<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Tercero;
use app\models\Tipodoc;
use app\models\Usuario;
use kartik\widgets\Select2;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Documento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="documento-form">

    <?php $form = ActiveForm::begin([
        'options'=>['enctype'=>'multipart/form-data'] // important
    ]); ?>

<?php    // Normal select with ActiveForm & model
    echo $form->field($model, 'tercero_idtercero')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Tercero::find()->orderBy(['idtercero'=>SORT_ASC])->all(),'idtercero','idtercero'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione un Tercero ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); 

?>

    <?= $form->field($model, 'tipodoc_idtipodoc')->dropDownList(
            ArrayHelper::map(
                Tipodoc::find()->orderBy(['nombre'=>SORT_ASC])->all(),
                'idtipodoc',
                'nombre'),
                ['prompt' => '---Seleccione---']
        )
     ?>
    <?= $form->field($model, 'usuario_idusuario')->dropDownList(
            ArrayHelper::map(
                Usuario::find()->orderBy(['nombre'=>SORT_ASC])->all(),
                'idusuario',
                'nombre'),
                ['prompt' => '---Seleccione---']
        )
     ?>

    <?= // Usage with ActiveForm and model
        $form->field($model, 'file')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
        ]);


    ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
