<?php /** @var $model Accounts */ ?>

<div class="container-fluid">


    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Categories</h1>
        <div class="d-none d-sm-inline-block">
        </div>
    </div>

    <div class="row">

        <div class="col">
            <div class="card shadow mb-4" style="">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Add new category</h6>
                </div>
                <div class="card-body" style="">
                    <form id="settings-add-cat-form" action="" method="post" autocomplete="off">
                        <div class="form-group">
                            <div class="form-label">
                                <label>New Reconciliation Amount</label>
                                <input name="amount" type="text" id="amount" class="form-control" placeholder="Add amount to reconcile" required="required">
                            </div>
                        </div>
                        <input type="hidden" name="account" value=""/>
                        <input id="reconcile-save-button" class="btn btn-primary btn-block"  value="Save Changes" type="submit"/>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">All Reconciliations</h6>
                </div>
                <div class="card-body" style="">
                    <div id="" style="height: 350px; overflow: auto">
                        <div class="dot-pulse"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


