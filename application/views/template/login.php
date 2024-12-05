<section class="bg-light py-5 bg-login">

    <div class="login-wrap">
        <small> <?= $this->session->flashdata('message'); ?></small>
        <div class="login-html">

            <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
            <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
            <div class="login-form">
                <div class="sign-in-htm">
                    <form action="<?= base_url('auth/login?url=' . $this->input->get('url')) ?>" method="post">
                        <div class="group">
                            <label for="user" class="label">Username/email</label>
                            <input id="user" name="email" type="text" class="input">
                        </div>
                        <div class="group">
                            <label for="pass" class="label">Password</label>
                            <input id="pass" name="password" type="password" class="input" data-type="password">
                        </div>
                        <div class="group">
                            <input id="check" type="checkbox" class="check">
                            <label for="check"><span class="icon"></span> Keep me Signed in</label>
                        </div>
                        <div class="group">
                            <input type="submit" class="button" value="Sign In">
                        </div>
                    </form>

                    <div class="hr"></div>
                    <div class="foot-lnk">
                        <a href="<?= base_url('auth/forgotpassword') ?>">Forgot Password?</a>
                    </div>
                </div>
                <div class="sign-up-htm">

                    <form action="<?= base_url('auth/registration') ?>" class="form-group" method="post">
                        <div class="group">
                            <label for="name" class="label">Full Name</label>
                            <input id="name" name="name" type="text" class="input">
                            <?= form_error('name', '<small class="text-danger">', '</small>') ?>
                        </div>
                        <div class="group">
                            <label for="email" class="label">Email Address</label>
                            <input id="email" name="email" type="text" class="input">
                            <?= form_error('email', '<small class="text-danger">', '</small>') ?>
                        </div>
                        <div class="group">
                            <label for="phone" class="label">Phone number</label>
                            <input id="phone" name="phone" type="text" class="input">
                            <?= form_error('phone', '<small class="text-danger">', '</small>') ?>
                        </div>
                        <div class="group">
                            <label for="password" class="label">Password</label>
                            <input id="password" name="password" type="password" class="input" data-type="password">
                            <?= form_error('password', '<small class="text-danger">', '</small>') ?>
                        </div>
                        <div class="group">
                            <label for="repassword" class="label">Repeat Password</label>
                            <input id="repassword" name="repassword" type="password" class="input" data-type="password">
                            <?= form_error('repassword', '<small class="text-danger">', '</small>') ?>
                        </div>
                        <div class="group">
                            <input type="submit" name="signup" class="button" value="Sign Up">
                        </div>
                    </form>


                    <div class="foot-lnk">
                        <label for="tab-1">Already Member?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>