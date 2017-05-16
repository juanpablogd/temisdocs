<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tipodoc */

$this->title = 'Crear Tipo Documento';
$this->params['breadcrumbs'][] = ['label' => 'Tipodocs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipodoc-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
