<ul class="list-group">
    <?php $appVersion = Utils::getAppVersion(); foreach($links as $link): ?>

    <?php if($link["version"] > $appVersion):?>
        <li class="list-group-item">
            <i class="fa fa-upload"></i> &nbsp;<?php echo $link['name'];?>
            <span class="badge badge-primary">Ver <?php echo $link['version'];?></span>
            <br>   <?php echo $link['description'];?>
        <span class="float-right">
            <a data-version="<?php echo $link['version'];?>" data-link="<?php echo $link['url'];?>" href="javascript:void(0);" class="btn btn-sm btn-primary up-btn">Download &amp; Update</a>
        </span>
        </li>
    <?php endif;?>

    <?php endforeach; ?>
</ul>
