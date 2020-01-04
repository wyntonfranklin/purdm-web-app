<?php /** @var $this SettingsController */?>
<?php /** @var $transaction RepeatTransaction */?>
<?php /** @var $model Transaction */?>
<?php /** @var $transactions Array | Transaction */?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Repeat Transactions</h1>
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
                    <h6 class="m-0 font-weight-bold text-primary">Repeat Transactions</h6>
                </div>
                <div class="card-body" style="min-height: 350px;">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Next Date</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Account</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($transactions as $transaction):?>
                        <?php $model = Transaction::model()->findByPk($transaction->transaction_id);?>
                            <tr>
                                <td><?php echo $transaction->getShortDate();?></td>
                                <td><?php echo $model->category;?></td>
                                <td style="min-width: 200px;"><?php echo $model->description;?></td>
                                <td>
                                    <?php echo Utils::getTransactionIcon($model->type);?>
                                    &nbsp;&nbsp;
                                    <?php echo Utils::formatMoney($model->amount);?></td>
                                <td><?php echo $model->getAccountName();?></td>
                                <td>
                                    <div data-id="<?php echo $model->transaction_id;?>">
                                        <a href="javascript:void(0);" class="open-trans-modal"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                        <a href="javascript:void(0);" class="trans-delete"><i class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
