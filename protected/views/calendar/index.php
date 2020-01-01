<?php ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Calendar</h1>
        <div class="d-none d-sm-inline-block">
            <?php $this->accountSelectorWidget(); ?>
            <a id='pdm-add-transaction' href="javascript:void(0);" class="btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-coins fa-sm text-white-50"></i> Add transaction</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">

            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Showing all Transactions</h6>
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
<?php echo Utils::pageSettings(['accountId'=>""]);?>

<?php Utils::registerPageJs('calendar'); ?>
