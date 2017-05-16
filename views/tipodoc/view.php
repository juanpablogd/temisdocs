<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tipodoc */

$this->title = $model->idtipodoc;
$this->params['breadcrumbs'][] = ['label' => 'Tipodocs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipodoc-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->idtipodoc], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->idtipodoc], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Seguro que desea eliminar este elemento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nombre',
            'decripcion',
            'estado',
        ],
    ]) ?>

</div>
