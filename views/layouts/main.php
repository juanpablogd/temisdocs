<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Avaltitulos',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    //echo Yii::$app->user->identity->idusuario;
    //echo '<script type="text/javascript">alert("R: ' . Yii::$app->user->identity->perfil . '");</script>';
    $menuItems = [
                ['label' => 'Inicio', 'url' => ['/site/index']],
            ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else{
        if(Yii::$app->user->identity->perfil == "ADMIN"){
            $menuItems[] = ['label' => 'Usuarios', 'url' => ['/usuario/index']];
            $menuItems[] = ['label' => 'Ciudades', 'url' => ['/ciudad/index']];
            $menuItems[] = ['label' => 'Tipo Doc.', 'url' => ['/tipodoc/index']];
        }
        if(Yii::$app->user->identity->perfil == "ADMIN" || Yii::$app->user->identity->perfil == "CARGUE"){
            $menuItems[] = ['label' => 'Terceros', 'url' => ['/tercero/index']];
        }

        $menuItems[] = ['label' => 'Documentos', 'url' => ['/documento/index']];
        $menuItems[] = [
                    'label' => 'Logout (' . Yii::$app->user->identity->usuario . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);

    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Sofytek <?= date('Y') ?></p>

        <p class="pull-right"><?php echo '<p class="pull-right">Desarrollado por <a href="http://www.sofytek.com.co/" rel="external">Sofytek SAS</a></p>'?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
