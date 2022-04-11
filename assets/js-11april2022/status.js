function changeCashStatus(tbl,id, type){
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
          url: baseURL+"admin/cash/change_status",
          data: {id:id},
          dataType:"JSON",
          success: function(response) {
          let link = '';
            if(response.status && response.status == 1){
              link = `<a onclick="changeCashStatus('${tbl}', '${id}', '${type}')" class="mini-card-verify px-3">Active </a> `;
            }else{
              link = `<a onclick="changeCashStatus('${tbl}', '${id}', '${type}')" class="mini-card-pending px-3">Inactive </a>` 
            }
            change_cash_status_notification(id,tbl);
            $('#status-'+id).html(link);
          }
      });
    }
  })
}

function changeInvestmentStatus(tbl,id, type){
    Swal.fire({
      title: 'Are you sure?',
      text: "You want to change status!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, change it!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
            type: "POST",
            url: baseURL+"admin/investment/updateStatus",
            data: {id:id},
            dataType:"JSON",
            success: function(response) {
            let link = '';
              if(response.status && response.status == 1){
                link = `<a onclick="changeInvestmentStatus('${tbl}', '${id}', '${type}')" class="mini-card-verify px-3">Active </a> `;
              }else{
                link = `<a onclick="changeInvestmentStatus('${tbl}', '${id}', '${type}')" class="mini-card-pending px-3">Inactive </a>` 
              }
              //change_investment_status_notification(id,tbl);
              $('#status-'+id).html(link);
            }
        });
    }
  })
}

function changeLoanStatus(tbl,id, type){
  Swal.fire({
    title: 'Are you sure?',
    text: "You want to change status!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, change it!'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
          type: "POST",
          url: baseURL+"admin/loan/updateStatus",
          data: {id:id},
          dataType:"JSON",
          success: function(response) {
          let link = '';
            if(response.status && response.status == 1){
              link = `<a onclick="changeLoanStatus('${tbl}', '${id}', '${type}')" class="mini-card-verify px-3">Active </a> `;
            }else{
              link = `<a onclick="changeLoanStatus('${tbl}', '${id}', '${type}')" class="mini-card-pending px-3">Inactive </a>` 
            }
            //change_loan_status_notification(id,tbl);
            $('#status-'+id).html(link);
          }
      });
    }
  })
}