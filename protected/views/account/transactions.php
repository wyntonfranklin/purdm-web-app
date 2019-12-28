<?php /** @var $model Accounts */ ?>

<div class="container-fluid">


    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
           <a href="<?php echo $model->getAccountViewUrl();?>"><?php echo $model->name;?></a> /
            Transactions</h1>
        <div class="d-none d-sm-inline-block">
            <a id='pdm-add-transaction' href="javascript:void(0);" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-coins fa-sm text-white-50"></i> Add transaction</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">All Transactions</h6>
                </div>
                <div class="card-body">
                    <div id="trans-layout" class="table-responsive" style="min-height: 500px;">
                        <div class="aj"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php echo Utils::pageSettings(['accountId'=>$model->id]);?>
<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/pages/transactions.js",
    CClientScript::POS_END);?>
