<?php ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Account</h1>
    </div>

    <div class="row">

        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Edit this Account</h6>
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
                    <form action="<?php echo $this->createUrl('/account/update');?>" method="post">
                        <div class="form-group">
                            <div class="form-label">
                                <label>Account Name</label>
                                <input name="accountName" type="text" id="accountName" class="form-control" placeholder="Account name" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label">
                                <label>Account Type</label>
                                <input name="accountType" type="text" id="accountType" class="form-control" placeholder="Account name" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label">
                                <label>Current Balance</label>
                                <input name="accountFunds" type="text" id="accountFunds" class="form-control" placeholder="Current Balance">
                            </div>
                        </div>
                        <input class="btn btn-primary btn-block"  value="Save Changes" type="submit"/>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

