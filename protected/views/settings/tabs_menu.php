<?php /** @var $this SettingsController */?>
<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link <?php echo $this->settingsMenuActive('general');?>" href="<?php echo $this->createUrl('/settings/general');?>">General</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo $this->settingsMenuActive('repeat');?>" href="<?php echo $this->createUrl('/settings/repeat');?>">Repeat Transactions</a>
    </li>
</ul>
