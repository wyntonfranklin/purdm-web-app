<?php ?>
<div id="transaction-modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-coins"></i>&nbsp;Add new Transaction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col">
                                <label for="transType">Transaction Type</label>
                                <select class="form-control" id="transType">
                                    <option>Expense</option>
                                    <option>Income</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="account">Account</label>
                                <select class="form-control" id="account">
                                    <option>Primary</option>
                                    <option>Savings</option>
                                    <option>Credit Union</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col">
                                <div class="form-label">
                                    <label for="category">Category</label>
                                    <input type="text" id="category" class="form-control" placeholder="Current Balance" required="required">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-label">
                                    <label for="transDate">Date</label>
                                    <input type="text" id="transDate" class="form-control" placeholder="Current Balance" required="required">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label">
                            <label for="description">Description</label>
                            <input type="text" id="description" class="form-control" placeholder="Account name" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label">
                            <label for="amount">Amount</label>
                            <input type="text" id="amount" class="form-control" placeholder="Account name" required="required">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="transType">Repeat</label>
                        <select class="form-control">
                            <option>Every Year</option>
                            <option>Every Month</option>
                            <option>Every Week</option>
                            <option>Every Day</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Memo</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
