<?php /** @var $transaction Transaction */?>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
    <tr>
        <th>Date</th>
        <th>Amount</th>
        <th>Description</th>
        <th>Category</th>
        <th>Account</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($transactions as $transaction):?>
        <tr>
            <td>
                <?php echo $transaction->getShortDate();?></td>
            <td>
                <?php echo Utils::getTransactionIcon($transaction->type);?>
                &nbsp;&nbsp;
                <?php echo Utils::formatMoney($transaction->amount);?></td>
            <td style="min-width: 200px;"><?php echo $transaction->description;?></td>
            <td><?php echo $transaction->category;?></td>
            <td><?php echo $transaction->getAccountName();?></td>
            <td>
                <div data-id="<?php echo $transaction->transaction_id;?>">
                    <a href="javascript:void(0);" class="open-trans-modal"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                    <a href="javascript:void(0);" class="trans-delete"><i class="fa fa-trash"></i></a>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "order": []
        });

        $('#dataTable').on('click','.trans-delete',function(){
            var el = $(this);
            var transId = $(this).parent().attr('data-id');
            var c = confirm('Remove this tranaction');
            if(c){
                $.post('/ajax/DeleteTransaction',{id:transId},function(){
                    el.trigger('pdm.update.transtable');
                });
            }
           return false;
        });
    });
</script>
