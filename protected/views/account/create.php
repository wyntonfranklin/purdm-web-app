<?php ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add New Account</h1>
    </div>

    <div class="row">

        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Create a new Account</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <div class="form-label">
                                <label>Account Name</label>
                                <input type="text" id="accountName" class="form-control" placeholder="Account name" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label">
                                <label>Account Type</label>
                                <input type="text" id="accountType" class="form-control" placeholder="Account name" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label">
                                <label>Current Balance</label>
                                <input type="text" id="accountFunds" class="form-control" placeholder="Current Balance" required="required">
                            </div>
                        </div>
                        <a class="btn btn-primary btn-block" href="login.html">Save Account</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

