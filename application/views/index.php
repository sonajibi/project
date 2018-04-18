<h2>LOGIN</h2>
<form id="form1" name="form1" method="post" action="<?php echo base_url(); ?>login/check_login">
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
    <table width="500">
        <tr>
            <td>Username</td>
            <td>
                <input name="username" type="text" value="<?php echo $uname; ?>" id="username" />
            </td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input name="password" type="password" value="<?php echo $upass; ?>" id="password" /></td>
        </tr>
        <tr>
            <td><input name="remember" type="checkbox" id="remember" <?php
                if ($chk == 1) {
                    echo 'checked="checked"';
                }
                ?> value="1" />
                Remember Password </td>
            <td>
                <input type="submit" name="Submit" value="Submit" />
            </td>
        </tr>
    </table>
</form>

<h2>SIGNUP</h2>

<form id="signup" name="signup" method="post" action="<?php echo base_url(); ?>login/insert_user">
    <table width="500">
        <tr>
            <td>Name</td>
            <td>
                <input name="name" type="text" value="" id="name" />
            </td>
        </tr>
        <tr>
            <td>Email</td>
            <td>
                <input name="email" type="text" value="" id="email" />
            </td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input name="password" type="password" value="" id="password" /></td>
        </tr>
        <tr>
            <td>Confirm Password</td>
            <td><input name="confirm_password" type="password" value="" id="confirm_password" /></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" name="Submit" value="Submit" />
            </td>
        </tr>
    </table>
</form>