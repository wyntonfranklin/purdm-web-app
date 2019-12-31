<?php /** @var $this SettingsController */?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">General Settings</h1>
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
                    <h6 class="m-0 font-weight-bold text-primary">Select Default Account</h6>
                </div>
                <div class="card-body">
                    <form action="#" method="post">
                        <p>Select a default account from the list below.(Which account do you register transactions with the most)</p>
                        <div class="form-group">
                            <select style="width: 100%;">
                                <option value="volvo">Volvo</option>
                                <option value="saab">Saab</option>
                                <option value="mercedes">Mercedes</option>
                                <option value="audi">Audi</option>
                            </select><br>
                        </div>
                        <input class="btn btn-primary btn-block"  value="Save" type="submit"/>
                    </form>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Update Account Info</h6>
                </div>
                <div class="card-body">
                    <form action="#" method="post">
                        <div class="form-group">
                            <div class="form-label">
                                <label>Username</label>
                                <input name="accountName" type="text" id="accountName" class="form-control" placeholder="Account name" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label">
                                <label>Email</label>
                                <input name="accountFunds" type="text" id="accountFunds" class="form-control" placeholder="Current Balance">
                            </div>
                        </div>
                        <input class="btn btn-primary btn-block"  value="Update information" type="submit"/>
                    </form>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Repeat Transactions</h6>
                </div>
                <div class="card-body">
                    <form action="#" method="post">
                        <p>Mange you repeating transactions</p>
                        <input class="btn btn-primary btn-block"  value="Manage" type="submit"/>
                    </form>
                </div>
            </div>


        </div>

        <div class="col-6">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Change user password</h6>
                </div>
                <div class="card-body">
                    <form action="#" method="post">
                        <div class="form-group">
                            <div class="form-label">
                                <label>Old Password</label>
                                <input name="accountFunds" type="text" id="accountFunds" class="form-control" placeholder="Current Balance">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label">
                                <label>New Password</label>
                                <input name="accountFunds" type="text" id="accountFunds" class="form-control" placeholder="Current Balance">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label">
                                <label>Confirm New Password</label>
                                <input name="accountFunds" type="text" id="accountFunds" class="form-control" placeholder="Current Balance">
                            </div>
                        </div>
                        <input class="btn btn-primary btn-block"  value="Save new password" type="submit"/>
                    </form>
                </div>
            </div>


            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Delete Account</h6>
                </div>
                <div class="card-body">
                    <form action="#" method="post">
                        <p>Rand test adfasdfasdf</p>
                        <input class="btn btn-danger btn-block"  value="Create Account" type="submit"/>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

