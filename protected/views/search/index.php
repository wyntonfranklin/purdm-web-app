<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Search Transactions</h1>
        <div class="d-none d-sm-inline-block">
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

<?php echo Utils::pageSettings(['query'=>$_GET['query']]);?>
<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/pages/search.js",
    CClientScript::POS_END);?>
