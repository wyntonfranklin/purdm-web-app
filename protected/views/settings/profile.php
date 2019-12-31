<?php /** @var $this SettingsController */?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Profile</h1>
    </div>


    <div class="row mb-3">

        <div class="col">
            <?php $this->renderPartial('tabs_menu');?>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Update Profile</h6>
                </div>
                <div class="card-body">
                    <form action="#" method="post">
                        <div class="form-group">
                            <div class="form-label">
                                <label>Account Name</label>
                                <input name="accountName" type="text" id="accountName" class="form-control" placeholder="Account name" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label">
                                <label>Current Balance</label>
                                <input name="accountFunds" type="text" id="accountFunds" class="form-control" placeholder="Current Balance">
                            </div>
                        </div>
                        <input class="btn btn-primary btn-block"  value="Create Account" type="submit"/>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Change user Password</h6>
                </div>
                <div class="card-body">
                    <form action="#" method="post">
                        <div class="form-group">
                            <div class="form-label">
                                <label>Current Balance</label>
                                <input name="accountFunds" type="text" id="accountFunds" class="form-control" placeholder="Current Balance">
                            </div>
                        </div>
                        <input class="btn btn-primary btn-block"  value="Create Account" type="submit"/>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

