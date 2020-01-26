<?php if(count($categories) <= 0 ): ?>
    <ul class="list-group">
        <li class="list-group-item">No Categories found</li>
    </ul>
<?php else: ?>
    <ul class="list-group">
        <?php foreach($categories as $cat):?>
            <li data-id="<?php echo $cat->id;?>" data-name="<?php echo $cat->name;?>" class="list-group-item"><?php echo $cat->name;?>
                <a href="javascript:void(0);" class="float-right cat-item"><i class="fa fa-edit"></i></a>
            </li>
        <?php endforeach;?>
    </ul>
<?php endif; ?>
