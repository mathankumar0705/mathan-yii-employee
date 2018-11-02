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
        //'brandLabel' => 'Employee Details',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Employee List', 'url' => ['/employee']],
        ],
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
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php
    if (Yii::$app->session->getFlash('success') != '') {
        $this->registerJs('
            toastr.success("' . addslashes(Yii::$app->session->getFlash('success')) . '");
        ');
    }
    if (Yii::$app->session->getFlash('error') != '') {
        $this->registerJs('
            toastr.error("' . addslashes(Yii::$app->session->getFlash('error')) . '");
        ');
    }
    if (Yii::$app->session->getFlash('warning') != '') {
        $this->registerJs('
            toastr.warning("' . addslashes(Yii::$app->session->getFlash('warning')) . '");
        ');
    }
    if (Yii::$app->session->getFlash('info') != '') {
        $this->registerJs('
            toastr.info("' . addslashes(Yii::$app->session->getFlash('info')) . '");
        ');
    }
?>
<?php $this->endPage() ?>

