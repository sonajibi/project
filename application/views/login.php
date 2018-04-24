<?php
    if (!empty($cookie)) {
        $x = explode(',', $cookie);
        $uname = $x[0];
        $upass = $x[1];
        $chk = 1;
    } else {
        $uname = '';
        $upass = '';
        $chk = '';
    }
    ?>
	
	<main class="main-content" id="MainContent" role="main">
      <div class="page-width">
        <div class="grid">
            <div class="grid__item medium-up--one-half medium-up--push-one-quarter">
                <!--<div class="note form-success hide" id="ResetSuccess">
                    We&#39;ve sent you an email with a link to update your password.
                </div>-->
                <div id="CustomerLoginForm" class="form-vertical">
                    <form id="form1" name="form1" method="post" action="<?php echo base_url(); ?>auth/check_login">
                        <h1 class="text-center">Login</h1>
                        <label for="CustomerEmail">Email</label>
                        <input name="username" type="text" value="<?php echo $uname; ?>" id="username" />

                        <label for="CustomerPassword">Password</label>
                        <input name="password" type="password" value="<?php echo $upass; ?>" id="password" />
                        <div class="text-center">
                            <p><a href="#recover" id="RecoverPassword">Forgot your password?</a></p>
                            <input type="submit" class="btn" value="Sign In">
                            <p>
                                <a href="<?php echo base_url(); ?>auth/signup" id="customer_register_link">Create account</a>
                            </p>
                        </div>
                    </form>
                </div>

                <div id="RecoverPasswordForm" class="hide">
                    <div class="text-center">
                        <h2>Reset your password</h2>
                        <p>We will send you an email to reset your password.</p>
                    </div>
                    <div class="form-vertical">
                        <form method="post" action="<?php echo base_url(); ?>auth/send_password">
                            <label for="RecoverEmail">Email</label>
                            <input type="email" value="" name="email" id="RecoverEmail" class="input-full">
                            <div class="text-center">
                                <p>
                                    <input type="submit" class="btn" value="Submit">
                                </p>
                                <button type="button" id="HideRecoverPasswordLink" class="text-link">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </main>