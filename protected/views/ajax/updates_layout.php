<ul class="list-group">
    <?php foreach($links as $link):?>
<li class="list-group-item">
    <i class="fa fa-upload"></i> &nbsp;<?php echo $link->name;?>
    <span class="badge badge-primary">Ver <?php echo $link->version;?></span>
    |   <?php echo $link->description;?>
<span class="float-right">
    <a data-link="<?php echo $link->url;?>" href="javascript:void(0);" class="btn btn-sm btn-primary up-btn">Download &amp; Update</a>
</span>
</li>
    <?php endforeach; ?>
</ul>
