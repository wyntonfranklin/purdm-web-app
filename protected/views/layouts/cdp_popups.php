<?php
    $cdp_defaults = json_encode([
       'startdate' => date('Y-m-d'),
       "enddate" => date('Y-m-d'),
       "month" => Utils::getNumMonth(),
       "year" => Utils::getYear(),
       "type" => "month"
    ]);
    $currentYear = date('Y');
    $addYear = intval($currentYear) + 1;
    for($i =$addYear; $i>= $addYear-10; $i--){
        $yearsArray[] = $i;
    }

?>
<!-- customer date picker content -->
<div id="custom-date-picker" style="">

    <input type="hidden" id="cdp-settings" data-settings='<?php echo $cdp_defaults;?>' readonly="readonly"/>
    <div id="cdp-menu" class="cdp-options">
        <div class="card" style="padding: 15px;">
            <button  style="margin-bottom: 3px;" class="btn-month btn btn-sm btn-primary">Month</button><br><br>
            <button class="btn-range btn btn-sm btn-primary">Date Range</button>
        </div>
    </div>

    <div id="cdp-month-content" class="cdp">
        <div class="card" style="padding: 15px; width: 275px; display: block;">
            <p style="margin-bottom: 3px;">Pick a month</p>
            <span>Year: </span>&nbsp;&nbsp;<select id="months-picker" style="margin-bottom: 3px; width: 100px; display: inline;">
                <?php foreach($yearsArray as $year):?>
                <option value="<?php echo $year;?>" selected><?php echo $year;?></option>
                <?php endforeach;?>
            </select>
            <div class="months-listing" id="cdp-months-listing">
                <div class="mn-item" data-month="01">Jan</div>
                <div class="mn-item" data-month="02">Feb</div>
                <div class="mn-item" data-month="03">Mar</div>
                <div class="mn-item" data-month="04">Apr</div>
                <div class="mn-item" data-month="05">May</div>
                <div class="mn-item" data-month="06">Jun</div>
                <div class="mn-item" data-month="07">Jul</div>
                <div class="mn-item" data-month="08">Aug</div>
                <div class="mn-item" data-month="09">Sep</div>
                <div class="mn-item" data-month="10">Oct</div>
                <div class="mn-item" data-month="11">Nov</div>
                <div class="mn-item" data-month="12">Dec</div>
            </div>
            <button id="cdp-update-months" class="btn btn-sm btn-danger">Update Page</button>
        </div>
    </div>

    <div id="cdp-range-content" class="cdp">
        <div class="card" style="padding: 15px; width: 300px; display: block;">
            <p style="margin-bottom: 3px;">Select a date range</p>
            <span style="color: #4e73df">Start Date</span>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                </div>
                <input id='cdp-start-date' type="text" class="form-control" placeholder="Start date" aria-label="Username" aria-describedby="basic-addon1">
            </div>
            <span style="color: #4e73df">End Date</span>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                </div>
                <input id='cdp-end-date' type="text" class="form-control" placeholder="End date" aria-label="Username" aria-describedby="basic-addon1">
            </div>
            <button id="cdp-update-range" class="btn btn-sm btn-danger">Update Page</button>
        </div>
    </div>
</div>

<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/custom-datepicker.js",
    CClientScript::POS_END);?>
