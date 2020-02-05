<div id="users-change-password-modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update <span class="usr-active-user"></span> Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <div class="form-label">
                            <label>New Password</label>
                            <input name="usrpassword" type="password" class="form-control" placeholder="Enter the new password" required="required"/>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="usr-change-password" type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div id="users-edit-modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="usr-user-form">
                    <div class="form-group">
                        <div class="form-label">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Username" required="required"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" placeholder="Enter user email" required="required"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>User Type</label>
                        <select name="usertype" class="form-control">
                            <option value="0">Normal</option>
                            <option value="1">Admin</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="usr-save-user" type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
