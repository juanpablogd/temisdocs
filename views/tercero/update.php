<?php

use yii\helpers\Html;
use app\assets\AppAsset;
/* @var $this yii\web\View */
/* @var $model app\models\Tercero */

$this->title = 'Actualizar Tercero: ' . $model->idtercero;
$this->params['breadcrumbs'][] = ['label' => 'Terceros', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idtercero, 'url' => ['view', 'id' => $model->idtercero]];
$this->params['breadcrumbs'][] = 'Update';
?>

<?php
    AppAsset::register($this);
    //$this->beginPage();
    $this->registerCssFile('assets/multiselect/bootstrap-multiselect.css');
    $this->registerJsFile(Yii::getAlias('@web') . '/assets/multiselect/bootstrap-multiselect.js', ['depends' => [yii\web\JqueryAsset::className()]]);
    $this->registerJsFile(Yii::getAlias('@web') . '/assets/tercero_create.js', ['depends' => [yii\web\JqueryAsset::className()]]);

?>

<div class="tercero-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
