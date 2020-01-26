<?php /** @var $model Accounts */ ?>

<div class="container-fluid">


    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <a href="<?php echo $model->getAccountViewUrl();?>"><?php echo $model->name;?></a> /
            Reconciliations</h1>
        <div class="d-none d-sm-inline-block">
         </div>
    </div>

    <div class="row">

        <div class="col-xl-5 col-lg-5">
            <div class="card shadow mb-4" style="min-height: 450px;">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Reconcile this account</h6>
                </div>
                <div class="card-body" style="height: 350px;">
                    <h6>Current Balance <span id="reconcile-account-balance" class="float-right badge badge-primary">0.00</span></h6>
                    <hr>
                    <form id="reconcile-form" action="" method="post" autocomplete="off">
                        <div class="form-group">
                            <div class="form-label">
                                <label>New Reconciliation Amount</label>
                                <input name="amount" type="text" id="amount" class="form-control" placeholder="Add amount to reconcile" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label">
                                <label>Reconcile Action (+ / - from account balance)</label>
                                <select name="type" class="form-control" id="type">
                                    <option selected="selected">-- Select an option -- </option>
                                    <option value="add">Add to balance</option>
                                    <option value="minus">Minus from balance</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label">
                                <label>Reason</label>
                                <input name="reason" type="text" id="reason" class="form-control" placeholder="State your reason for update">
                            </div>
                        </div>
                        <input type="hidden" name="account" value="<?php echo $model->id;?>"/>
                        <input id="reconcile-save-button" class="btn btn-primary btn-block"  value="Save Changes" type="submit"/>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-xl-7 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">All Reconciliations</h6>
                </div>
                <div class="card-body" style="">
                    <div id="reconcile-layout" style="height: 350px; overflow: auto">
                        <div class="dot-pulse"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<?php echo Utils::pageSettings(['accountId'=>$model->id]);?>

