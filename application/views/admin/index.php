<!DOCTYPE html>
<html lang="en">
<head>
<title>WB : Login</title>
<title>Admin Login</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/maruti-login.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/gocaargo-logo.css" />
</head>
<body >
<div id="loginbox">
  <form id="loginform" method="post" class="form-vertical" action="javascript:void(0);">
    <div class="control-group normal_text">
    	
      <h3 style="margin-top:22px;"><i></i></h3>
    </div>
    <p id="mesg"></p>
    <div class="control-group">
      <div class="controls">
        <div class="main_input_box"> <span class="add-on"><i class="icon-user"></i></span>
          <input type="text" name="username" id="username" placeholder="Username" />
        </div>
      </div>
    </div>
    <div class="control-group">
      <div class="controls">
        <div class="main_input_box"> <span class="add-on"><i class="icon-lock"></i></span>
          <input type="password" name="password" id="password" placeholder="Password" />
        </div>
      </div>
    </div>

    <div class="form-actions" style="text-align:left;"><span class="pull-right">

      <button type="submit" id="btn-login" class="btn btn-success"><b>Login</b></button>

      </span> </div>

  </form>

</div>



<script type="text/javascript">

	var base_url = '<?php echo base_url();?>';

	var admin_assets = '<?php echo base_url();?>assets/admin/';

</script> 

<script src="<?php echo base_url(); ?>assets/admin/js/jquery-1.7.2.min.js"></script> 

<script src="<?php echo base_url(); ?>assets/admin/js/bootstrap.min.js"></script> 

<script src="<?php echo base_url(); ?>assets/admin/ajax/ajax.js"></script>

</body>

</html>