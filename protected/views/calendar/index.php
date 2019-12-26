<?php ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Calendar</h1>
        <a id='pdm-add-transaction' href="javascript:void(0);" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-coins fa-sm text-white-50"></i> Add transaction</a>
    </div>

    <div class="row">
        <div class="col-12">

            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Showing all Transactions</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div id="accounts-filter-menu" class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="acc-menu dropdown-header">Filter for Accounts:</div>
                            <a data-account="1" class="acc-menu dropdown-item" href="#">Account One</a>
                            <a data-account="2" class="acc-menu dropdown-item" href="#">Account Two</a>
                            <div class="dropdown-divider"></div>
                            <a data-account="all" class="acc-menu dropdown-item" href="#">
                                <i style="color:blue;" class="fa fa-check"></i>&nbsp;All Accounts</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div style="min-height: 500px;">
                        <div id="kt_calendar"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/pages/calendar.js",
    CClientScript::POS_END);

