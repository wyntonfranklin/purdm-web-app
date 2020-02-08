<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Updates</h1>
    </div>


    <div class="row mb-3">

        <div class="col">
            <?php $this->renderPartial('tabs_menu');?>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">All Available Updates</h6>
                </div>
                <div class="card-body" style="min-height: 350px;">

                    <div class="row">


                        <div class="col-12">
                            <p>Current Application Version: <?php echo Utils::getAppVersion();?></p>
                            <div id="updates-lay"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>


<div id="update-modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update the Application</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="min-height: 300px;">
                <p><i class="fa fa-download fa-2x"></i>&nbsp; Update this application with this version
                    <span id="download-version" class="badge badge-primary"></span></p>
                <p><strong>PLEASE DONT CLOSE THIS MODAL UNTIL TOLD</strong></p>
                <p style="color: green">Click start to begin updating
                </p>
                <p style="padding: 5px; color: black; font-weight: bold; background:#e2e5ec; border: 1px solid #000; min-height: 200px;" id="update-status"></p>
            </div>
            <div class="modal-footer">
                <div id="pb-bar" class="float-left" style="margin-right: 10%; display: none;">
                    <div class="dot-pulse"></div>
                </div>
                <button id="start-update-btn" type="button" class="btn btn-danger">
                    Start Update</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
