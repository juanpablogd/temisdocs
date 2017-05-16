<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DocumentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Documentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documento-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Documento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'iddocumento',
            ['attribute' => 'Tercero','value' => 'terceroIdtercero.nombre'],
            ['attribute' => 'Documento','value' => 'tipodocIdtipodoc.nombre'],
            'ruta',
            'fechasis',
            // 'usuario_idusuario',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
