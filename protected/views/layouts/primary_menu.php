<?php ?>

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo $this->createUrl('/dashboard/');?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-wallet"></i>
        </div>
        <div class="sidebar-brand-text mx-3"><?php echo Yii::app()->name;?></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php echo $this->menuActive('dashboard');?>">
        <a class="nav-link" href="<?php echo $this->createUrl('/dashboard/');?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?php echo $this->menuActive('account');?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-folder"></i>
            <span>Accounts</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">All Accounts:</h6>
                <?php  $accounts = Accounts::model()->getUserAccounts(); ?>
                <?php foreach($accounts as $account):?>
                    <a class="collapse-item" href="<?php echo $this->createUrl('/account/'.$account->id);?>">
                        <?php echo $account->name;?></a>
                <?php endforeach;?>
                <a class="collapse-item" href="<?php echo $this->createUrl('/account/create');?>"><i class="fa fa-plus-circle"></i> &nbsp;New Account</a>
            </div>
        </div>
    </li>

    <li class="nav-item <?php echo $this->menuActive('reports');?>">
        <a class="nav-link" href="<?php echo $this->createUrl('/reports/');?>">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Insights</span>
        </a>
    </li>

    <li class="nav-item <?php echo $this->menuActive('calendar');?>">
        <a class="nav-link" href="<?php echo $this->createUrl('/calendar/');?>">
            <i class="fas fa-fw fa-calendar"></i>
            <span>Calendar</span>
        </a>
    </li>

    <li class="nav-item <?php echo $this->menuActive('settings');?>">
        <a class="nav-link" href="<?php echo $this->createUrl('/settings/');?>">
            <i class="fas fa-fw fa-cogs"></i>
            <span>Settings</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
