<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
    'Error',
);
?>

<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Opps. An error occured (Error <?php echo $code; ?>)</h1>
                        </div>
                        <div style="min-height: 300px;">
                            <div class="text-center">
                                <p><i style="color:darkred;" class="fa fa-exclamation-triangle fa-5x"></i></p>
                                <h3>
                                    <?php echo CHtml::encode($message); ?>
                                </h3>
                            </div>
                            <a onclick="window.history.back()" class="btn btn-user btn-block btn-outline-primary">
                                <i class="fa fa-chevron-left"></i> Go Back
                            </a>
                        </div>
                        <hr>
                        <div class="text-center">
                            <p>Report an issue <a href="https://forms.gle/Fe7NN4PT2gRMtS9w7">here</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
