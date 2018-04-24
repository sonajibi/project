<main class="main-content" id="MainContent" role="main">
    <div class="page-width">
        <div class="grid">
            <div class="grid__item medium-up--one-half medium-up--push-one-quarter">
                <div class="form-vertical">
                    <form id="signup" name="signup" method="post" action="<?php echo base_url(); ?>auth/insert_user">
                        <h1 class="text-center">Create Account</h1>

                        <label for="LastName">Name</label>
                        <input name="name" type="text" value="" id="name" />
                        <label for="Email">Email</label>
                        <input name="email" type="text" value="" id="email" />
                        <label for="CreatePassword">Password</label>
                        <input name="password" type="password" value="" id="password" />
                        <label for="CreatePassword">Confirm Password</label>
                        <input name="confirm_password" type="password" value="" id="confirm_password" />
                        <p class="text-center">
                            <input type="submit" value="Create" class="btn">
                        </p>
                        <p align="center">
                            <a href="<?php echo base_url(); ?>auth/login" id="customer_register_link">Login</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>