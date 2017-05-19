<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tercero */

$this->title = 'Crear Tercero';
$this->params['breadcrumbs'][] = ['label' => 'Terceros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="tercero-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
