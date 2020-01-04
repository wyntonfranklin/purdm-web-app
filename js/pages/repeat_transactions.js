var RTransactionsPage = (function() {

    var layout = $('#rt-layout');
    var currentRow = null;

    $('#rt-layout').on('click','.edit-rt',function(){
        var el = $(this);
        var rtId = $(this).parent().attr('data-id');
        currentRow = rtId;
        console.log(rtId);
        showRTModal(rtId)
        return false;
    });

    $('#rt-layout').on('click','.delete-rt',function(){
        var el = $(this);
        var rtId = $(this).parent().attr('data-id');
        currentRow = rtId;
        removeRT(rtId);
        return false;
    });

    $("#rt-date").datepicker({
        todayHighlight: true,
        orientation: "bottom left",
        format: 'yyyy-mm-dd',
        templates : {
            leftArrow: '<i class="fa fa-arrow-left"></i>',
            rightArrow: '<i class="fa fa-arrow-right"></i>'
        }
    });

    $('#update-rt').on('click',function(){
        updateRT();
        return false;
    });

    function showRTModal(id){
        $.get('/ajax/GetRtDetails',{rtId: id}, function(data){
            var response = PDMApp.getJsonResponseObject(data);
            $('#rt-amount').text(response.data.amount);
            $('#rt-description').text(response.data.description);
            $('#rt-header').text(response.data.header);
            $('#rt-frequency').val(response.data.frequency);
            $('#rt-date').val(response.data.nextDate);
            $('#rt-modal').modal('show');
            console.log(response);
        });
    }

    function updateRT(){
        var freq = $('#rt-frequency').val();
        var rtDate = $('#rt-date').val();
        $.post('/ajax/updatert',{
            frequency : freq,
            date : rtDate,
            id : currentRow
        },function(response){
            var res = PDMApp.getJsonResponseObject(response);
            console.log(res);
        });
    }

    function removeRT(id){
        $.post('/ajax/RemoveRT',{id:id},function(response){
           var res = PDMApp.getJsonResponseObject(response);
           if(res.status == 'good'){
               PDMApp.setAlert('success', res.message);
               loadPageData();
           }
        });
    }

    function loadPageData(){
        $.get('/ajax/GetRepeatTransactions',{},function(data){
            layout.empty().append(data);
        });
    }


    return {
        loadPageData : loadPageData
    }
})();

RTransactionsPage.loadPageData();
