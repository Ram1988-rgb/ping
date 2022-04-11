
$('#createAccount').validate({
    rules: {
      name: {
        required: true,
      },
      email: {
        required: true,
        email: true,
      },
      password: {
        required: true,
        minlength: 5
      },
      phone: {
        required: true,
        minlength: 5
      }
    },   
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.input-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
});

function get_payment_plan_duration(plan_id){
  
  // $.ajax({
  //     type: "POST",
  //     url: baseURL+"user/cash/get_payment_plan_duration",
  //     data: {plan_id: plan_id},
  //     datatype: 'json',
  //     success: function(response) {
          
  //     }
  // });
}