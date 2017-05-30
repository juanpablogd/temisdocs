<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Documento */

$this->title = $model->iddocumento;
$this->params['breadcrumbs'][] = ['label' => 'Documentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documento-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?php
            if(Yii::$app->user->identity->perfil == "ADMIN" || Yii::$app->user->identity->perfil == "CARGUE"){
                
                echo Html::a('Borrar', ['delete', 'id' => $model->iddocumento], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Seguro que desea eliminar este Archivo?',
                        'method' => 'post',
                    ],
                ]);
            }
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                   'label'=>'Archivo',
                   'format' => 'html',
                   'value'=>function ($data) {
                     return Html::a('<span class="glyphicon glyphicon-file"></span>', $data->ruta, ['target' => "_blank"]);
                        //return Html::button('<a target="_blank" href="'.$data->ruta.'" ><span class="glyphicon glyphicon-file"></span></a>'); //$data->ruta
                    },
            ],
            'fechasis',
            [
                'label' => 'Tercero',
                'value' => function($model) {
                    return $model->terceroIdtercero['FullTercero'];
                },
            ],
            [
             'attribute' => 'tipodoc_idtipodoc',
                'value' => function($model) {
                    return $model->tipodocIdtipodoc['nombre'];
                },
            ],
            'usuarioIdusuario.usuario',
        ],
    ]) ?>

</div>
