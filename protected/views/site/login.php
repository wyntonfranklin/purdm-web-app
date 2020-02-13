<div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                            </div>
                            <?php $form=$this->beginWidget('CActiveForm', array(
                                'id'=>'login-form',
                                'enableAjaxValidation'=>false,
                                'htmlOptions' =>[
                                    'class' =>'user'
                                ]
                            ));
                            echo $form->error($model, 'error');
                            ?>
                            <form class="user">
                                <div class="form-group">
                                    <?php echo $form->textField($model,'email', array('class'=>'form-control form-control-user',
                                        'title'=>'e.g. someone@example.com','placeholder'=>'Enter username or email','required'=>'required')); ?>
                                </div>
                                <div class="form-group">
                                    <?php echo $form->passwordField($model,'password', array('class'=>'form-control form-control-user',
                                        'title'=>'Your password','placeholder'=>'Password','required'=>'required')); ?>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" class="custom-control-input" id="customCheck">
                                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-user btn-block" type="submit">Login</button>
                                <?php $this->endWidget(); ?>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
