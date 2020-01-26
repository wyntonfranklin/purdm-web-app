<?php /** @var $model SetupForm */?>
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Setup your PURDM Database</h1>
                        </div>
                    <?php $form=$this->beginWidget('CActiveForm', array(
                                'id'=>'login-form',
                                'enableAjaxValidation'=>false,
                                'htmlOptions' =>[
                                    'class' =>'user'
                                ]
                            ));?>
                            <div class="form-group">
                                <label>Database Name</label>
                                <?php echo $form->textField($model,'dbname', array('class'=>'form-control form-control-user',
                                    'title'=>'Database Name','placeholder'=>'Database Name','required'=>'required')); ?>
                            </div>
                            <div class="form-group">
                                <label>Database User</label>
                                <?php echo $form->textField($model,'dbuser', array('class'=>'form-control form-control-user',
                                    'title'=>'Database user','placeholder'=>'database User','required'=>'required')); ?>
                            </div>
                            <div class="form-group">
                                <label>Database Password</label>
                                <?php echo $form->textField($model,'dbpassword', array('class'=>'form-control form-control-user',
                                    'title'=>'Database Password','placeholder'=>'Database Password')); ?>
                            </div>
                            <button value="" type="submit" class="btn btn-primary btn-user btn-block">
                                Save database configuration
                            </button>
                            <hr>
                        <div class="text-center">
                            <p>Next Steps. Create a admin user account.</p>
                        </div>
                        <?php $this->endWidget(); ?>
                    </div>
                </div>
            </div>
        </div>
