<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tipodoc */

$this->title = 'Update Tipodoc: ' . $model->idtipodoc;
$this->params['breadcrumbs'][] = ['label' => 'Tipodocs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idtipodoc, 'url' => ['view', 'id' => $model->idtipodoc]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tipodoc-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
