<?php /** @var $model Accounts */ ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $model->name;?></h1>
        <div class="d-none d-sm-inline-block">
            <?php $this->customDatePickerWidget();?>
            <div class="dropdown d-none d-sm-inline-block">
                <button class="dropdown-toggle btn btn-sm btn-dark shadow-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Options
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="<?php echo $model->getUpdateViewUrl();?>">
                        <i class="fa fa-edit"></i>&nbsp; Edit Account</a>
                    <a class="dropdown-item" href="<?php echo $model->getTransactionsViewUrl();?>">
                        <i class="fa fa-list"></i>&nbsp; View all Transactions</a>
                    <a class="dropdown-item" href="<?php echo $model->getReconcileViewUrl();?>"><i class="fa fa-balance-scale"></i>&nbsp; Reconcile Account</a>
                    <a class="dropdown-item" href="<?php echo $model->getCloseViewUrl();?>"><i class="fa fa-trash"></i>&nbsp; Delete Account</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Current Balance</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                 <span id="av-tile" class="aj">

                                </span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-wallet fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Income</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                 <span id="in-tile" class="aj">

                                </span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Expenses</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                 <span id="ex-tile" class="aj">

                                </span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-bill fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Savings</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                 <span id="sv-tile" class="aj">

                                </span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-piggy-bank fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Expenses by Category</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <div class="aj charts-loader"></div>
                        <canvas id="pie-cats"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Expenses Legend</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="" style="height: 320px; overflow: auto;">
                        <ul class="pie-cats" id="pie-cats-list">
                            <div class="aj"></div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Income vs Expenditure</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="aj charts-loader"></div>
                    <canvas width="400" height="135" class="chart-area" id="incomevsexpense"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Transactions</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="transdropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="transdropdownMenuLink">
                            <div class="dropdown-header">Options:</div>
                            <a class="dropdown-item" href="<?php echo $model->getTransactionsViewUrl();?>">View all transactions</a>
                        </div>
                    </div>
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
<?php echo Utils::pageSettings([
    'category'=>$model->name,
    'startdate' => (isset($_GET['startdate'])) ? $_GET['startdate'] : "",
    'enddate' => (isset($_GET['enddate'])) ? $_GET['enddate'] : "",
    'month' => (isset($_GET['month'])) ? $_GET['month'] : Utils::getNumMonth(),
    'year' => (isset($_GET['year'])) ? $_GET['year'] : Utils::getYear(),
    'type' => (isset($_GET['type'])) ? $_GET['type'] : "",
    'accountId' => $model->id,
]);?>

