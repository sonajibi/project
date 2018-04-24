<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin Forgot Password</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/maruti-login.css" />
</head>
<body>
<div id="loginbox">
  <form method="post" class="forgot_frm" action="<?php echo base_url(); ?>login/forgot_password">
    <div class="control-group normal_text">
      <h3>FORGOT PASSWORD</h3>
    </div>
    <div class="control-group">
      <div class="controls">
        <div class="main_input_box">
          <p style="text-align:left;margin-left:5%;color:#999;">Please fill your email address.</p>
          <span class="add-on"><i class="icon-user"></i></span>
          <input type="email" name="email" id="email" placeholder="Enter Your Email Address" />
        </div>
      </div>
    </div>
    <div class="form-actions" style="text-align:left;"> <span class=""><a id="to-login" class="flip-link btn btn-warning" href="<?php echo base_url(); ?>">« Back to login</a></span> <span class="pull-right">
      <button type="submit" id="btn-login" class="btn btn-success" />
      Send to Email</span> </div>
  </form>
</div>
<script type="text/javascript">
  var base_url = '<?php echo base_url();?>';
  var front_assets = '<?php echo base_url();?>assets/front/';
  </script>
<script src="<?php echo base_url(); ?>assets/front/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/front/js/maruti.login.js"></script>
<script src="<?php echo base_url(); ?>assets/front/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/front/ajax/ajax.js"></script>
</body>
</html>
