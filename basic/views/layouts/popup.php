<?php

use yii\helpers\Html;
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        ul.main-nav li:hover > ul.dropdown-menu {
            display: block;
        }
        div.user .dropdown:hover > ul.dropdown-menu {
            display: block;
        }
    </style>
    <script>
        var AppConfigs = function () {
            var userdetail;
            userdetail = <?php echo \yii\helpers\Json::encode(\yii::$app->user->identity);?>;
            this.getUser = function () {
                return userdetail;
            }
            this.getBaseUrl = function () {
                return "<?php echo Url::base('http').'/'; ?>";
            }
        };
    </script>
</head>
<body style="background:#FFFFFF; ">
<?php $this->beginBody() ?>
    <div class="container-fluid" id="content">
        <div id="main">
       
            <?= $content ?>
           
        </div>
    </div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>