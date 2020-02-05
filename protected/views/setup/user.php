<?php /** @var $model SetupForm */?>
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create Your Admin Account</h1>
                        </div>
                        <?php $form=$this->beginWidget('CActiveForm', array(
                            'id'=>'login-form',
                            'enableAjaxValidation'=>false,
                            'htmlOptions' =>[
                                'class' =>'user'
                            ]
                        ));
                        echo CHtml::errorSummary($model);
                        ?>
                            <div class="form-group">
                                <label>User Name</label>
                                <?php echo $form->textField($model,'username', array('class'=>'form-control form-control-user',
                                    'title'=>'username','placeholder'=>'Username')); ?>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <?php echo $form->textField($model,'email', array('class'=>'form-control form-control-user',
                                    'title'=>'Your email','placeholder'=>'Your email','required'=>'required')); ?>   </div>
                            <div class="form-group">
                                <label>Password</label>
                                <?php echo $form->textField($model,'password', array('class'=>'form-control form-control-user',
                                    'title'=>'Your password','placeholder'=>'Your password','required'=>'required')); ?> </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Save user credentials
                            </button>
                            <hr>
                            <div class="text-center">
                                <p>Next steps. Confirm user credentials and login.</p>
                            </div>
                        <?php $this->endWidget(); ?>
                    </div>
                </div>
            </div>
        </div>
