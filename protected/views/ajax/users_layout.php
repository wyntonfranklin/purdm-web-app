<?php /** @var $user Users */?>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
    <tr>
        <th>Username</th>
        <th>Email</th>
        <th>Role</th>
        <th>Created At</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($users as $user):?>
        <tr>
            <td>
                <?php echo $user->username;?>
            </td>
            <td><?php echo $user->email;?></td>
            <td>
                <span class="badge badge-primary"><?php echo strtoupper($user->getUserRole());?></span>
            </td>
            <td><?php echo $user->createdAt;?></td>
            <td>
                <div data-id="<?php echo $user->id;?>">
                    <a href="javascript:void(0);" class="users-password"><i class="fa fa-key"></i></a>&nbsp;
                    <a href="javascript:void(0);" class="users-edit"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<script>

</script>
