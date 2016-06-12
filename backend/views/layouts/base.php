<?php

/* @var $this \yii\web\View */
/* @var $content string */
use kartik\sidenav\SideNav;
use backend\assets\AppAsset;
use yii\helpers\Html;
use mdm\admin\components\MenuHelper;
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
    <script type="text/javascript" src="/js/jquery-1.8.3.min.js"></script>
</head>
<body style="background-color: rgba(75, 80, 102, 0.92)">
    <?php $this->beginBody() ?>
    <?= $content ?>
    <?php $this->endBody() ?>
</body>
<?php $this->endPage() ?>
</html>
