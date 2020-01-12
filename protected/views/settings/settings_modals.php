<div id="default-account-modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update default account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="post">
                    <p>Select a default account from the list below.(Which account do you register transactions with the most)</p>
                    <div class="form-group">
                        <?php echo CHtml::dropDownList('account','', Accounts::model()->getListing(),
                            array(
                                'class'=>'form-control',
                                'id'=>'default-account',
                            ));?>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id='save-default-account-btn' type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div id="update-account-password-modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update account password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="update-user-password-form" action="" method="post">
                    <div class="form-group">
                        <div class="form-label">
                            <label>Old Password</label>
                            <input minlength="2" type="password" id="oldPassword" class="form-control" placeholder="Enter your old password" required="required"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label">
                            <label>New Password</label>
                            <input minlength="2" type="password" id="newPassword" class="form-control" placeholder="Enter your new password" required="required"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label">
                            <label>Confirm New Password</label>
                            <input minlength="2" type="password" id="confirmPassword" class="form-control" placeholder="Enter you new password again" required="required">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-user-password-btn" type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div id="update-account-info-modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Account Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="update-user-info-form" action="#" method="post">
                    <div class="form-group">
                        <div class="form-label">
                            <label>Username</label>
                            <input type="text" id="userName" class="form-control" placeholder="Username" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label">
                            <label>Email</label>
                            <input type="email" id="userEmail" class="form-control" placeholder="User email" required="required">
                        </div>
                    </div>
                 </form>
            </div>
            <div class="modal-footer">
                <button id="update-user-btn" type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div id="category-modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Manage Categories</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Manage your categories used for transactions</p>
                <div class="input-group mb-3">
                    <input id="settings-cat-input" type="text" class="form-control" placeholder="Add category name">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="setting-save-category">Save</button>
                    </div>
                </div>
                <div id="settings-cat-list" class="aj" style="height: 300px; overflow: auto;">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div id="api-modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Manage Api Key</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Create or generate a new api key to use with the PURDM app.</p>
                <div class="input-group mb-3">
                    <input id="api-key-input" type="text" class="form-control" placeholder="Api Key">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="button" id="generate-api-key">Generate</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
