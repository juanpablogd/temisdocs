<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\assets\AppAsset;
use yii\widgets\Pjax;
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
<?php
    if(Yii::$app->user->identity->perfil == "ADMIN" || Yii::$app->user->identity->perfil == "CARGUE"){
        $menuItems = ['class' => 'yii\grid\ActionColumn','template' => '{view} {delete} '];
        echo Html::a('Crear Documento', ['create'], ['class' => 'btn btn-success']);
    }else{
        $menuItems = ['class' => 'yii\grid\ActionColumn','template' => '{view}'];
    } 
?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'CC / NIT',
                'attribute'=>'tercero_idtercero',
            ],
            [
                'label' => 'Nombres',
                'format' => 'ntext',
                'attribute'=>'nombres',
                'value' => function($model) {
                    return $model->terceroIdtercero['nombres'];
                },
            ],
            [
                'label' => 'Apellidos',
                'format' => 'ntext',
                'attribute'=>'apellido',
                'value' => function($model) {
                    return $model->terceroIdtercero['apellido'];
                },
            ],
            [
             'attribute' => 'tipodoc_idtipodoc',
             'value' => 'tipodocIdtipodoc.nombre'
            ],
            'referencia',
            'fechasis',
            [
                   'label'=>'Archivo',
                   'format' => 'html',
                   'value'=>function ($data) {
                     return Html::a('<span class="glyphicon glyphicon-file"></span>', $data->ruta, ['data-pjax' => 0, 'target' => "_blank"]);
                        //return Html::button('<a target="_blank" href="'.$data->ruta.'" ><span class="glyphicon glyphicon-file"></span></a>'); //$data->ruta
                    },
            ],
            $menuItems,
        ],
    ]); ?>
    <?php Pjax::begin(); ?>
</div>
