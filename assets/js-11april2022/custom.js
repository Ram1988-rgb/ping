function manageloanbusiness(){
    var plan_id = $("input[type='radio'].radioBtnClass:checked").val();
    $.ajax({
        type: "POST",
        url: baseURL+"user/loan/getloanform",
        data: {plan_id: plan_id},
        success: function(loanform) {
            $("#loanform").html(loanform);
            
        }
    });
}

function get_payment_plan_duration(plan_id){
    $.ajax({
        type: "POST",
        url: baseURL+"user/cash/get_payment_plan_duration",
        data: {plan_id: plan_id},
        dataType:"JSON",
        success: function(response) {
           manage_plan_type_payment_type(response, 'payment_type', 'payment_duration');
        }
    });
}

function manage_plan_type_payment_type(response, duration_type_id, payment_type_id){
    const plan_type_duration = response.plan_type_duration;
    const payment_type_duration = response.payment_type_duration;
    let select_payment = '<option value="">Select</option>';
    for(var i=0; i<plan_type_duration.length;i++ ){
        let plan = plan_type_duration[i];
        select_payment = `${select_payment}
        <option value="${plan.paymentduration_id}" data-id="${plan.label}">${plan.label}</option>`;
    }

    let select_duration = '<option value="">Select</option>';
    for(var i=0; i<payment_type_duration.length;i++ ){
        let payment = payment_type_duration[i];
        select_duration = `${select_duration}
        <option value="${payment.paymenttype_id}" data-id="${payment.label}">${payment.label}</option>`;
    }
    $("#"+payment_type_id).html(select_payment);
    $("#"+duration_type_id).html(select_duration);
}

function changeStatus(tbl,id, type){  
  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, change it!'
  }).then((result) => {
    if (result.isConfirmed) {
    $.ajax({
        type: "POST",
        url: baseURL+"admin/comman/change_status",
        data: {tbl: tbl, id:id, type:type},
        dataType:"JSON",
        success: function(response) {
        let link = '';
          if(response.status && response.status == 1){
            link = `<a onclick="changeStatus('${tbl}', '${id}', '${type}')" class="mini-card-verify px-3">Active </a> `;
          }else{
            link = `<a onclick="changeStatus('${tbl}', '${id}', '${type}')" class="mini-card-pending px-3">Inactive </a>` 
          }
          if(type == 'cash'){
            change_cash_status_notification(id,tbl);
          }
          if(type == 'fund'){
            change_fund_status_notification(id,tbl); 
          }
          if(type == 'agentfund'){
            chnagefundstatus(tbl, id, type);
            //change_fund_status_notification(id,tbl); 
          }
          $('#status-'+id).html(link);
          swal(
            'Status!',
            'Status has been changed.',
            'success'
          )
        }
      })
    }
    });
}

function chnagefundstatus(tbl, id, type){
  $.ajax({
    type: "POST",
    url: baseURL+"admin/comman/changefundstatus",
    data: {tbl: tbl, id:id, type:type},
    dataType:"JSON",
    success: function(response) {
    }
  })
}

function duration_change(check, textId){
  if($(check).is(':checked')){
     $("#"+textId).prop('disabled', false);
  }
 else{
  $("#"+textId).val('');
  $("#"+textId).prop('disabled', true);
 }
}

function get_rate_according_plan(duration_id, plan_id){
  $.ajax({
    type: "POST",
    url: baseURL+"user/cash/get_plan_duration",
    data: {plan_id: plan_id, duration_id, payment_type:$("#payment_type").val()},
    dataType:"JSON",
    success: function(response) {
     $("#plan_rate").html("Rate of interest: "+response.rate+"%");
    }
  });
}

function move_to_wallet(id,cpdid){
  Swal.fire({
    title: 'Are you sure?',
    text: "You want to move wallet!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, move it!'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: baseURL+"user/cash/move_to_wallet",
        data: {id: id},
        dataType:"JSON",
        async:false,
        success: function(response) {
        if(response.status == true){
          $("#wallet-"+cpdid).html("Done");
        }
        }
      });
    }
  })
}
function move_to_wallet_vip(invid){
  //$("#move_to_wallet_sol").hide();
  let message = "You want to move wallet!";
  if($("#vip_date").val()=='1'){
    let investment_charge = $("#vip_charge").val()
    message = "You want to move wallet!. Investment prematured charge deducted HTG "+investment_charge;
  }
  Swal.fire({
    title: 'Are you sure?',
    text: message,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, move it!'
  }).then((result) => {
    if (result.isConfirmed) {
      $("#move_to_wallet_sol").hide();
     // return false;
      $.ajax({
        type: "POST",
        url: baseURL+"user/investment/move_to_wallet",
        data: {invid: invid},
        dataType:"JSON",
        async:false,
        success: function(response) {
        if(response.status == true){
          $("#wallet-"+invid).html("Done");
        }
        }
      });
    }
  })

}

function move_to_wallet_new(invid){
  //$("#move_to_wallet_sol").hide();
  let message = "You want to move wallet!";
  if($("#sol_date").val()=='1'){
    let investment_charge = $("#sol_charge").val()
    message = "You want to move wallet!. Investment prematured charge deducted HTG "+investment_charge;
  }
  Swal.fire({
    title: 'Are you sure?',
    text: message,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, move it!'
  }).then((result) => {
    if (result.isConfirmed) {
      $("#move_to_wallet_sol").hide();
     // return false;
      $.ajax({
        type: "POST",
        url: baseURL+"user/investment/move_to_wallet",
        data: {invid: invid},
        dataType:"JSON",
        async:false,
        success: function(response) {
        if(response.status == true){
          $("#wallet-"+cpdid).html("Done");
        }
        }
      });
    }
  })

}

function move_to_investment_wallet(id,cpdid){
  let message = "You want to move wallet!";
  if($("#investment_type").val()=='1' && $("#date_confirm").val()=='1'){
    let investment_charge = $("#investment_charge").val()
    message = "You want to move wallet!. Investment prematured charge deducted HTG "+investment_charge;
  }
  
  Swal.fire({
    title: 'Are you sure?',
    text: message,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, move it!'
  }).then((result) => {
    if (result.isConfirmed) {
     // return false;
      $.ajax({
        type: "POST",
        url: baseURL+"user/investment/move_to_wallet",
        data: {id: id},
        dataType:"JSON",
        async:false,
        success: function(response) {
        if(response.status == true){
          $("#wallet-"+cpdid).html("Done");
        }
        }
      });
    }
  })
}



// function move_to_investment_wallet(id){
//   $.ajax({
//     type: "POST",
//     url: baseURL+"user/investment/move_to_wallet",
//     data: {id: id},
//     dataType:"JSON",
//     success: function(response) {
//     if(response.status == true){
//       $("investment-"+id).html("Done");
//     }
//     }
//   });
// }

function cashPayment(cashPayment_date_id){
  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, change it!'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: baseURL+"user/cash/cash_payment",
        data: {cashPayment_date_id: cashPayment_date_id},
        dataType:"JSON",
        async:false,
        success: function(response) {
          if(response.status == true){
            $("#cash_payment-"+cashPayment_date_id).html("Done");
            $("#payment_date-"+cashPayment_date_id).html(response.payment_date);
            $("#cash_saving").html(response.cash_saving);
            $("#wallet-"+cashPayment_date_id).html(`<button type="button" class="btn btn-block btn-primary btn-sm" onclick="move_to_wallet('${response.cpid}', '${cashPayment_date_id}')">Move to Wallet</button>`);
          
            
          }else{
            swal(
              'Oops...',
              'Something went wrong!',
              'error'
            )
          }
        }
      });
    }
  })
}

function investmentPayment(investment_date_id){
  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, change it!'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: baseURL+"user/investment/investment_payment",
        data: {investment_date_id: investment_date_id},
        dataType:"JSON",
        async:false,
        success: function(response) {
          if(response.status == true){
            $("#cash_payment-"+investment_date_id).html("Done");
            $("#payment_date-"+investment_date_id).html(response.payment_date);
            $("#cash_saving").html(response.cash_saving);
            $("#wallet-"+investment_date_id).html(`<button type="button" class="btn btn-block btn-primary btn-sm" onclick="move_to_wallet('${response.cpid}', '${investment_date_id}')">Move to Wallet</button>`);
          
            
          }else{
            swal(
              'Oops...',
              'Something went wrong!',
              'error'
            )
          }
        }
      });
    }
  })
}

function loan_payment_data(loan_date_id){
  Swal.fire({
    title: 'Are you sure?',
    text: "You want to loan payment",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, change it!'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: baseURL+"user/loan/loan_payment_data",
        data: {loan_date_id: loan_date_id},
        dataType:"JSON",
        async:false,
        success: function(response) {
          if(response.status == true){
            $("#payment_status-"+loan_date_id).html("Done");
            $("#payment_date-"+loan_date_id).html(response.payment_date);
           
            
          }else{
            swal(
              'Oops...',
              'Something went wrong!',
              'error'
            )
          }
        }
      });
    }
  })
}

function setCashAmountModal(){
  const payment_type = $('#payment_type').val();
  const amount = $('#amount').val();
  const payment_type_val = $('#payment_type').children('option:selected').data('id');
  if(payment_type_val){
    $("#plan_type").html(payment_type_val);
  }
  if(amount){
    $("#amount_plan").html(amount);
  }
  $("#payment_duration").attr('data-validation-req-params', `{"payment_type":${payment_type}}`);
  $( "#payment_duration" ).change();
  $( "#payment_duration" ).blur();
}

function setInterestAmountModal(){
  const payment_type = $('#payment_type').val();
  const amount = $('#amount').val();
  const payment_type_val = $('#payment_type').children('option:selected').data('id');
  if(payment_type_val){
    $("#plan_type").html(payment_type_val);
  }
  if(amount){
    $("#amount_plan").html(amount);
  }
  $("#payment_duration").attr('data-validation-req-params', `{"payment_type":${payment_type}}`);
  $( "#payment_duration" ).change();
  $( "#payment_duration" ).blur();
}

function loan_validation(){
  const payment_type = $('#payment_duration').val();
  $("#loan_duration").attr('data-validation-req-params', `{"payment_type":${payment_type}}`);
  $( "#loan_duration" ).change();
  $( "#loan_duration" ).blur();
}

function manage_start_date(str, modal=false){
  if(modal){
    $("#start_date").val($("#modal_date").val());
    return
  }
  var today = new Date();
  var dd = String(today.getDate()).padStart(2, '0');
  if(str=="tomarrow"){
    dd = parseInt(dd)+1;
  }
  var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
  var yyyy = today.getFullYear();

  let start_date = mm + '/' + dd + '/' + yyyy;
  $("#start_date").val(start_date);
  $("#modal_date").val(start_date);
}

function set_servervalidation_attribute(firstid, second_id, thirdattribute){
  let first = $("#"+firstid).val();
  $("#second_id").attr(thirdattribute,{first});
}

