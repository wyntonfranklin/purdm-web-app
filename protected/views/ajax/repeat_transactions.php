<?php /** @var $transaction Transaction */?>
<table class="table table-bordered" id="rt-datatable" width="100%" cellspacing="0">
    <thead>
    <tr>
        <th>Next Date</th>
        <th>Frequency</th>
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
            <td><?php echo $model->getFrequency();?></td>
            <td><?php echo $model->category;?></td>
            <td style="min-width: 200px;"><?php echo $model->description;?></td>
            <td>
                <?php echo Utils::getTransactionIcon($model->type);?>
                &nbsp;&nbsp;
                <?php echo Utils::formatMoney($model->amount);?></td>
            <td><?php echo $model->getAccountName();?></td>
            <td>
                <div data-id="<?php echo $transaction->id;?>">
                    <a href="javascript:void(0);" class="edit-rt"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                    <a href="javascript:void(0);" class="delete-rt"><i class="fa fa-trash"></i></a>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#rt-datatable').DataTable({
            "order": []
        });
    });
</script>
