<?php /** @var $model Categories | UserCategories */ ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <a id="cat-back-btn" href="javascript:void(0);"><i class="fa fa-arrow-left"></i></a>
            &nbsp;Category / <?php echo ucfirst($model->name);?></h1>
        <div class="d-none d-sm-inline-block">
            <?php $this->customDatePickerWidget();?>
            <?php $this->accountSelectorWidget(); ?>
            <a id='pdm-add-transaction' href="javascript:void(0);" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-coins fa-sm text-white-50"></i> Add transaction</a>
        </div>
     </div>

    <div class="row">

        <div class="col-xl-6 col-md-6 mb-6">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Expenses</div>
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

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-6">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Avg Expense (Year)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                 <span id="av-tile" class="aj">
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

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
        </div>
    </div>

    <div class="row">

        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Income vs Expenditure by Year
                        <br><span class="card-header-subtitle"></span>
                    </h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <div class="aj charts-loader"></div>
                        <canvas width="400" height="125" class="chart-area" id="incomevsexpense"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Transactions
                        <br><span class="card-header-subtitle"></span>
                    </h6>
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
    'type' => (isset($_GET['type'])) ? $_GET['type'] : "month",
    'accountId' => (isset($_GET['accountId'])) ? $_GET['accountId'] : "",
]);?>

