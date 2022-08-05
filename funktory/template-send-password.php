<?php
/**
 * Template name: Send password
 */

get_header();
?>

  <div style="margin: 0 auto; width: 400px;">

    <?php while ( have_posts() ) : the_post(); ?>

        <div class="wrapper" style="height: 450px;">
            <section class="form-login">
                <form id="ut_forgot_form" name="forgot_form" method="post" action="">
                    <input type="hidden" name="get_passw">
                    <div id="forgot_error"></div>
                    <h2 class="form_title">Get password</h2>
                    <div class="form-login__field form-login__input">
                        <label for="user_name">Your customer number</label>
                        <input type="text" id="user_name" value="" size="25" name="user_name">
                    </div>
                    <div class="form-login__field form-login__button">
                        <button type="submit" class="login__button" name="swpm-login">Get password</button>
                    </div>
                    <a href="<?php echo ut_get_permalik_by_template('template-login.php'); ?>" class="form-login__forgot-pass">
                        Zurück
                    </a>
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