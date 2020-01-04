<?php /** @var $this SettingsController */?>
<?php /** @var $transaction RepeatTransaction */?>
<?php /** @var $model Transaction */?>
<?php /** @var $transactions Array | Transaction */?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Repeat Transactions</h1>
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
                <div id="rt-layout" class="card-body" style="min-height: 350px;">

                </div>
            </div>
        </div>
    </div>
</div>

<div id="rt-modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Frequency</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card border-left-primary py-2 mb-3">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div id="rt-header" class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Bills (RBC Account)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="rt-amount"></div>
                                <p class="mb-0" id="rt-description"></p>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar-plus fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label><i class="fa fa-reply"></i>&nbsp;Change Frequency</label>
                    <select id="rt-frequency" name="rt-frequency" class="form-control">
                        <option value="">Do not repeat</option>
                        <option value="year">Every Year</option>
                        <option value="month">Every Month</option>
                        <option value="week">Every Week</option>
                        <option value="day">Every Day</option>
                    </select>
                </div>
                <div class="form-group">
                    <label><i class="fa fa-calendar"></i>&nbsp;Runs next on </label>
                    <input id="rt-date" type="text" value="" class="form-control"/>
                </div>
            </div>
            <div class="modal-footer">
                <button id='update-rt' type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

