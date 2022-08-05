<?php
/**
 * Template name: Midwive Login
 */

get_header();
?>

  <div style="margin: 0 auto; width: 400px;">

    <?php while ( have_posts() ) : the_post(); ?>

        <div class="wrapper" style="height: 450px;">
            <section class="form-login">
                <form id="ut_login_form" name="login_form" method="post" action="">
                    <div id="auth_error"></div>
                    <h2 class="form_title">Kundenlogin</h2>
                    <div class="form-login__field form-login__input">
                        <label for="user_name">E-Mail-Adresse</label>
                        <input type="text" id="user_name" value="" size="25" name="user_name">
                    </div>
                    <div class="form-login__field form-login__input">
                        <label for="user_password">Passwort</label>
                        <input type="password" id="user_password" value="" size="25" name="user_password">
                    </div>
                    <div class="form-login__field form-login__remind-check">
                        <input type="checkbox" name="rememberme" id="remind-check">
                        <label for="remind-check"> Passwort merken</label>
                    </div>
                    <div class="form-login__field form-login__button">
                        <button type="submit" class="login__button" name="swpm-login">Login</button>
                    </div>

                    <a href="<?php echo ut_get_permalik_by_template('template-forgot.php'); ?>" class="form-login__forgot-pass">Passwort vergessen?</a>
                    <!-- <a href="#" class="form-login__register-link">Jetzt Kundenkonto anlegen</a> -->
                </form>
            </section>

            <section class="login_page-bottom">
                <div class="container">
                    Sie haben Fragen?</div>
                <img src="<?php echo get_template_directory_uri(); ?>/img/login_page-bottom.svg" alt="">
            </section>

        </div> 
      
    <?php endwhile; // End of the loop. ?>

  </div>

<?php
get_footer();