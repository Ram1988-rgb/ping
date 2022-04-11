function change_cash_status_notification(id, tbl, type){
    $.ajax({
        type: "POST",
        url: baseURL+"admin/cash/send_status_notification",
        data: {tbl: tbl, id:id, type:type},
        dataType:"JSON",
        success: function(response) {
            return true;
        }
    });    

}

function change_fund_status_notification(id, tbl, type){
    $.ajax({
        type: "POST",
        url: baseURL+"admin/fund/send_status_notification",
        data: {tbl: tbl, id:id, type:type},
        dataType:"JSON",
        success: function(response) {
            return true;
        }
    });    

}