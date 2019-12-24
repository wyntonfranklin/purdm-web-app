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

    <title><?php echo $this->pageTitle;?></title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/primary.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/fullcalendar.bundle.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/three-dots.min.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery-confirm.min.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/select2.min.css" rel="stylesheet">

</head>


<body id="page-top">
    <div id="wrapper">
        <?php $this->renderPartial('//layouts/primary_menu');?>

        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <?php $this->renderPartial("//layouts/primary_top_bar");?>
                <?php echo $content;?>
                <?php $this->renderPartial('//layouts/cdp_popups');?>
            </div>
    </div>
    <?php $this->renderPartial('//layouts/transaction_modal');?>

    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/Chart.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script type="text/javascript" src="../js/jquery.easing.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/moment.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/fullcalendar.bundle.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/notify.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-confirm.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/select2.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.maskMoney.min.js"></script>


        <!-- Custom scripts for all pages-->
    <script  type="text/javascript"src="<?php echo Yii::app()->request->baseUrl; ?>/js/sb-admin-2.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/app.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/charts.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/create_transaction.js"></script>
    <!-- Page level plugins -->

</body>

</html>
