<?php ?>
<style>
    .select2-selection {
        height: 38px!important;
    }
    .select2-selection__rendered {
        line-height: 38px!important;
    }
    .select2-selection__arrow {
        height: 38px!important;
    }
</style>
<div id="transaction-modal" class="modal" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-coins"></i>&nbsp;<span id="modalTitle">Add new Transaction</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="transaction-form" autocomplete="off">
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col">
                                <label for="transType"><i class="fa fa-list"></i>&nbsp;Transaction Type</label>
                                <select name="transType" class="form-control" id="transType">
                                    <option value="expense">Expense</option>
                                    <option value="income">Income</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="account"><i class="fa fa-folder"></i>&nbsp;Account</label>
                                <?php echo CHtml::dropDownList('account','', Accounts::model()->getListing(),
                                    array(
                                        'class'=>'form-control',
                                        'id'=>'account',
                                    ));?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col">
                                <div class="form-label">
                                    <label for="category"><i class="fa fa-tag"></i>&nbsp;
                                        Category <span><a href="#"id="add-trans-cat"><i class="fa fa-plus"></i></a></span>
                                    </label>
                                    <div id="trans-cat-container">
                                        <?php echo CHtml::dropDownList('category','', Categories::model()->getListing(),
                                            array(
                                                'class'=>'form-control',
                                                'id'=>'category',
                                                'empty' => '--Select category--',
                                                'style'=>'height:50px;width:100%',
                                            ));?>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-label">
                                    <label for="transDate"><i class="fa fa-calendar"></i>&nbsp;Date</label>
                                    <input name="transDate" type="text" id="transDate" class="form-control" placeholder="Transaction Date" required="required">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label">
                            <label for="description">Description</label>
                            <input name="description" type="text" id="description" class="form-control" placeholder="Description" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label">
                            <label for="amount"><i class="fa fa-dollar-sign"></i>&nbsp;Amount</label>
                            <input name="amount" type="text" id="amount" class="form-control" placeholder="Dollar amount" required="required">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label><i class="fa fa-reply"></i>&nbsp;Repeat</label>
                        <select id="frequency" name="frequency" class="form-control">
                            <option value="">Do not repeat</option>
                            <option value="year">Every Year</option>
                            <option value="month">Every Month</option>
                            <option value="week">Every Week</option>
                            <option value="day">Every Day</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="memo">Memo</label>
                        <textarea name="memo" class="form-control" id="memo" rows="3"></textarea>
                    </div>
                    <input id="transId" name="transId" value="" type="hidden"/>
                </form>
            </div>
            <div class="modal-footer">
                <button data-action="save" id="pdm-transaction-save" type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

