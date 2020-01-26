<?php /**
 * @var $transaction Transaction
 * @var $transactions Array */ ?>
<ul class="list-group">
    <?php if(count($transactions) > 0 ): ?>
    <?php foreach ($transactions as $transaction):?>
    <li class="list-group-item" data-id="<?php echo $transaction->id;?>">
        <?php echo Utils::getReconcileIcon($transaction->category);?>&nbsp;&nbsp;
        <?php echo Utils::formatMoney($transaction->amount);?>
        &nbsp;&nbsp; | &nbsp;&nbsp;
        <?php echo $transaction->description;?>
        <span style="cursor: pointer;" class="reconcile-delete float-right"><i class="fa fa-trash"></i></span>
    </li>
    <?php endforeach; ?>
    <?php else :?>
        <span>No Reconciliations found</span>
    <?php endif; ?>
</ul>
