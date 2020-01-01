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
                            <?php echo CHtml::dropDownList('account','', Accounts::model()->getListing(),
                                array(
                                    'class'=>'form-control',
                                    'id'=>'default-account',
                                ));?>
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
                                <input type="text" id="userName" class="form-control" placeholder="Username" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label">
                                <label>Email</label>
                                <input type="text" id="userEmail" class="form-control" placeholder="User email">
                            </div>
                        </div>
                        <input id="update-user-btn" class="btn btn-primary btn-block"  value="Update information" type="button"/>
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
                                <input type="password" id="oldPassword" class="form-control" placeholder="Current Balance">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label">
                                <label>New Password</label>
                                <input type="text" id="newPassword" class="form-control" placeholder="Current Balance">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label">
                                <label>Confirm New Password</label>
                                <input type="password" id="confirmPassword" class="form-control" placeholder="Current Balance">
                            </div>
                        </div>
                        <input id="update-user-password-btn" class="btn btn-primary btn-block"  value="Save new password" type="button"/>
                    </form>
                </div>
            </div>


            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Delete Account</h6>
                </div>
                <div class="card-body">
                    <form action="#" method="post">
                        <p>Delete your account you will loose all your transactions data.</p>
                        <input class="btn btn-danger btn-block"  value="Create Account" type="submit"/>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>


<?php echo Utils::pageSettings([
    'accountId' => Utils::getCurrentUserId(),
]);?>


<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/pages/settings.js",
    CClientScript::POS_END);?>
