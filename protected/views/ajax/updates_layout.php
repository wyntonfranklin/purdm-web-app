<ul class="list-group">
    <?php foreach($links as $link):?>
<li class="list-group-item">
    <?php echo Utils::getBaseName($link);?>
<span class="float-right">
    <a data-link="<?php echo $link;?>" href="javascript:void(0);" class="btn btn-sm btn-primary up-btn">Download &amp; Update</a>
</span>
</li>
    <?php endforeach; ?>
</ul>
