<?php ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <div class="d-none d-sm-inline-block">
            <a href="<?php echo $this->createUrl('/insights/');?>" class="btn btn-sm btn-secondary"><i class="fa fa-chart-area"></i>&nbsp;View Insights</a>
        </div>
    </div>

    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Net Worth</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <span id="nw-tile" class="aj">

                                </span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-pie fa-2x text-gray-300"></i>
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
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Income (This month)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <span id="in-tile" class="aj">0.00</span>
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
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Expenses (this month)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <span id="ex-tile" class="aj">0.00</span>
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
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Savings (This month)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <span id="sv-tile" class="aj">0.00</span>
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

        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Income vs Expenditure for
                    <?php echo Utils::getYear();?></h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="aj charts-loader"></div>
                    <canvas id="bar-chart" class="chart-area"></canvas>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Top Expenses for
                        <?php echo Utils::getYear();?></h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <div class="aj charts-loader"></div>
                        <canvas id="myPieChart" ></canvas>
                    </div>
                    <div id='myPieChart-labels' class="mt-4 text-center small">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Transactions</h6>
                </div>
                <div class="card-body">
                    <div id="trans-layout" class="table-responsive" style="min-height: 500px;">
                        <div class="dot-pulse"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php echo Utils::pageSettings([
    'accountId' => Utils::getCurrentUserSetting('default_account'),
]);?>
