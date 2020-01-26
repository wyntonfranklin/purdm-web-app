<?php
/**
 * @var $this Controller
 */?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/icon.ico" />
    <title><?php echo $this->pageTitle;?></title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <?php Utils::renderCssAssets();?>

</head>


<body id="page-top" class="bg-gradient-primary">

<div class="container ">
    <!-- Main Content -->
    <div id="content">
        <?php echo $content;?>
    </div>
</div>

<input id="alert-success" value="<?php echo Yii::app()->user->getFlash('success'); ?>" type="hidden" autocomplete="off"/>
<input id="alert-error" value="<?php echo Yii::app()->user->getFlash('error'); ?>" type="hidden" autocomplete="off"/>
<input id="alert-info" value="<?php echo Yii::app()->user->getFlash('info'); ?>" type="hidden" autocomplete="off"/>

<?php Utils::renderJsAssets();?>

<?php Utils::registerCustomScripts(['app','charts','create_transaction','accounts_selector']);?>

<?php $this->loadPageJsAssets();?>

    <!-- Page level plugins -->
</body>

</html>
