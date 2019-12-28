<?php /** @var $accounts Array
 * @var $account Accounts*/?>
<select autocomplete="off" id="pdm-accounts-selector" name="title" class="btn btn-outline-primary btn-sm">
    <option value="" selected>All accounts</option>
    <?php foreach ($accounts as $account):?>
    <option value="<?php echo $account->id;?>"><?php echo $account->name;?></option>
    <?php endforeach;?>
</select>
