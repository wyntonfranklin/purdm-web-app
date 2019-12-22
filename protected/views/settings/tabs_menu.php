<?php /** @var $this SettingsController */?>
<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link <?php echo $this->settingsMenuActive('notifications');?>" href="<?php echo $this->createUrl('/settings/notifications');?>">Notifications</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo $this->settingsMenuActive('account');?>" href="<?php echo $this->createUrl('/settings/account');?>">Account</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo $this->settingsMenuActive('profile');?>" href="<?php echo $this->createUrl('/settings/profile');?>">Profile</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo $this->settingsMenuActive('backups');?>" href="<?php echo $this->createUrl('/settings/backups');?>" >Backups</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo $this->settingsMenuActive('membership');?>" href="<?php echo $this->createUrl('/settings/membership');?>" >Membership</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo $this->settingsMenuActive('help');?>" href="<?php echo $this->createUrl('/settings/help');?>" >Help</a>
    </li>
</ul>
