<?php /** @var $this SettingsController */?>
<?php /** @var $transaction RepeatTransaction */?>
<?php /** @var $model Transaction */?>
<?php /** @var $transactions Array | Transaction */?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Api Settings</h1>
    </div>


    <div class="row mb-3">

        <div class="col">
            <?php $this->renderPartial('tabs_menu');?>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Showing all recurring transactions</h6>
                </div>

            </div>
        </div>
    </div>
</div>
