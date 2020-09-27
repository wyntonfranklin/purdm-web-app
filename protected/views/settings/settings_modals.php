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


<div id="download-transactions-modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Download your transactions as a xls file</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Download all your transactions as a csv file.</p>
                <div class="input-group mb-3">
                    <input id="file-name-input" value="mytransactions" type="text" class="form-control" placeholder="Save File as">
                    <div class="input-group-append">
                        <button title="Generate random name" class="btn btn-outline-primary" type="button">Generate</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="download-excel-action" class="btn btn-outline-primary" type="button">Download</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div id="upload-transactions-modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload your transactions</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Upload a correctly formatted xls file with transactions. <a title="Learn more" target="_blank" href="https://youtu.be/RDa5t_4_tBI"><i class="fa fa-question-circle"></i></a></p>
                <div class="alert alert-info">You might need to convert the downloaded xls file to 97-2003 xls version for this to work correctly.</div>
                <form id="bu-form">
                <div class="input-group mb-3">
                    <input id="uploader-placeholder" type="text" class="form-control" placeholder="Choose a file"/>
                    <input id="uploader" style="display:none;" type="file" placeholder="Choose File"/>
                    <div class="input-group-append">
                        <button id="choose-file" class="btn btn-outline-primary" type="button">Select File</button>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Upload to account</label>
                    <select class="form-control" id="bu-accounts">
                        <option value="byname" selected>Find account by name</option>
                        <?php foreach (Accounts::model()->getUserAccounts() as $account):?>
                            <option value="<?php echo $account->id;?>">Upload to - <?php echo $account->getShortName();?></option>
                        <?php endforeach;?>
                    </select>
                    </select>
                </div>
                <div class="form-check">
                    <input id="bu-create" class="form-check-input" type="checkbox" value="">
                    <label class="form-check-label" for="defaultCheck1">
                        Create account if not exists
                    </label>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="upload-import-btn" type="button" class="btn btn-primary">Upload</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div id="upload-transactions-errors-modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Log</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>View the upload log here.</p>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Bulk Upload log output</label>
                    <textarea class="form-control" style="width: 100%;" id="upload-log"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div id="backup-database-modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Backup your database</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Press start to create you backup.</p>
                <div class="input-group mb-3">
                    <input id="backup-filename-input" type="text" class="form-control" placeholder="Filename">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="button" id="backup-database-btn">Start Backup</button>
                    </div>
                </div>

                <br>
                <div>
                    <p>Available Backups <span style="float:right;"><a id="refresh-backup-listing" href="javascript:void(0);">Refresh listing</a></span></p>
                    <ul class="list-group" id="backups-previous-layout">
                    </ul>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

