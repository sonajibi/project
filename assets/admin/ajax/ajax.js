



/*login clinc request start*/
$("#btn-login").on('click',(function(e) {
    $.ajax({
      url: base_url+"admin/login/check_admin_login",
      type: "POST",
      data: new FormData($('#loginform')[0]),
      contentType: false,
      cache: false,
      processData:false,
      success: function(data)
      {
        if(data!=1){
		      document.getElementById("mesg").innerHTML=data;
        }else {
          window.location.href=base_url+'admin/settings/order_list';
        }
      },
      error: function()
      {
      }
    });
}));
/*login clinci request end*/
$("#btn-updatepass").on('click',(function(e) {
    $.ajax({
      url: base_url+"admin/dashboard/update_pass",
      type: "POST",
      data: new FormData($('#uppwdform')[0]),
      contentType: false,
      cache: false,
      processData:false,
      success: function(data)
      {
        document.getElementById("mesg").innerHTML=data;
      },
      error: function()
      {
      }
    });
}));
$("#btn-signup").on('click',(function(e) {
    $.ajax({
      url: base_url+"site/insert_user",
      type: "POST",
      data: new FormData($('#signupform')[0]),
      contentType: false,
      cache: false,
      processData:false,
      success: function(data)
      {
        if(data!=1){
		      alert(data);
        }else {
			alert('Success! Your account is created, click ok button for login.');
           window.location.href=base_url+'site/login';
        }
      },
      error: function()
      {
      }
    });
}));

$("#btn-userlogin").on('click',(function(e) {
    $.ajax({
      url: base_url+"site/check_login",
      type: "POST",
      data: new FormData($('#userloginform')[0]),
      contentType: false,
      cache: false,
      processData:false,
      success: function(data)
      {
        if(data!=1){
		      alert(data);
        }else {
		   alert('Success! click ok button for continue.');
           document.location.href=document.referrer;
        }
      },
      error: function()
      {
      }
    });
}));

function purchase_invoice(id){
	$.ajax({
      url: base_url+"purchase/purchase_inoice/"+id,
      type: "POST",
      contentType: false,
      cache: false,
      processData:false,
      success: function(data)
      {
        $('#purchase_details').html(data);
      },
      error: function()
      {
      }
    });
}