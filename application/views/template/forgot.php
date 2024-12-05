<section class="bg-light py-5 bg-login">

    <div class="login-wrap">
        <small> <?= $this->session->flashdata('message'); ?></small>
        <div class="login-html">

            <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Forgot Password</label>
            <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>
            <div class="login-form">
                <div class="sign-in-htm">

                    <form action="<?= base_url('auth/forgotpassword') ?>" method="post">
                        <div class="group">
                            <label for="user" class="label">Email</label>
                            <input id="user" name="email" type="text" class="input">
                        </div>


                        <div class="group">
                            <input type="submit" class="button" value="Reset Password">
                        </div>
                    </form>

                    <div class="hr"></div>
                    <div class="foot-lnk">
                        <a href="<?= base_url('auth/login') ?>">Sign In</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>