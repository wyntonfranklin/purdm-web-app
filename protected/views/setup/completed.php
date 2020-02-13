<?php /** @var $model SetupForm */?>
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Success. Account created!</h1>
                        </div>
                        <div style="min-height: 300px;">
                            <div class="text-center">
                                <p><i style="color:darkgreen;" class="fa fa-check-circle fa-5x"></i></p>
                                <p>Your admin account was created</p>
                                <p><strong>Username:</strong> <?php echo $model->username;?></p>
                                <p><strong>Email:</strong> <?php echo $model->email;?></p>
                                <p><strong>Password:</strong> Your chosen password</p>
                            </div>
                            <a href="/site/login?completed" class="btn btn-primary btn-user btn-block">
                                Login
                            </a>
                        </div>
                        <hr>
                        <div class="text-center">
                            <p>Next steps. Login and user PURDM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
