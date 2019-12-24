<?php /** @var $transaction Transaction */?>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
    <tr>
        <th>Date</th>
        <th>Amount</th>
        <th>Description</th>
        <th>Category</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($transactions as $transaction):?>
        <tr>
            <td><?php echo $transaction->trans_date;?></td>
            <td><?php echo $transaction->amount;?></td>
            <td><?php echo $transaction->description;?></td>
            <td><?php echo $transaction->category;?></td>
            <td>
                <a href="#"><i class="fa fa-cog"></i></a>&nbsp;&nbsp;
                <a href="#" class="open-trans-modal"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                <a href="#"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
