<?php ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <a href="<?php echo $model->getAccountViewUrl();?>"><?php echo $model->name;?></a> /
            Close Account</h1>
    </div>

    <div class="row">

        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Close <?php echo $model->name;?></h6>
                </div>
                <!-- Card Body -->
                <div class="card-body" style="">
                    <form action="#" method="post">
                        <p>Delete this account? Taking this action will remove all your data from this website.</p>
                        <input class="btn btn-danger btn-block"  value="Remove Account" type="submit"/>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

