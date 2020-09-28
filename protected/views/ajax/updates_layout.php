<ul class="list-group">
    <?php $appVersion = Utils::getAppVersion(); $count = 0; foreach($links as $link): ?>
        <?php if($link['version'] >= $appVersion): $count++ ?>
        <li class="list-group-item">
            <i class="fa fa-upload"></i> &nbsp;<?php echo $link['name'];?>
            <span class="badge badge-primary">Ver <?php echo $link['version'];?></span>
            <br>   <?php echo $link['description'];?>
            <?php if($link["version"] < $appVersion):?>
                <span style="color:darkred">(Downgrade) Danger Zone!</span>
            <?php else:?>
                <span style="color:darkgreen">(Upgrade)</span>
            <?Php endif;?>
        <span class="float-right">
            <a data-version="<?php echo $link['version'];?>" data-link="<?php echo $link['url'];?>" href="javascript:void(0);" class="btn btn-sm btn-primary up-btn">Download &amp; Update</a>
        </span>
        </li>
    <?php endif;?>


    <?php endforeach; ?>
    <?php
    if($count <= 0){
        echo "<li class='list-group-item'>No updates found</li>";
    }
    ?>
</ul>
