<?php
/**
 * Template name: Midwive New Password
 */

get_header();

$token = $_GET['token'] ?? null;
$user_name = $_COOKIE['user_name'] ?? null;
?>

  <div style="margin: 0 auto; width: 400px;">

    <?php while ( have_posts() ) : the_post(); ?>

        <div class="wrapper" style="height: 450px;">
            <section class="form-login">
                <form id="ut_new_pass_form" name="new_pass_form" method="post" action="">
                    <input type="hidden" name="token" value="<?php echo $token; ?>">
                    <input type="hidden" name="user_name" value="<?php echo $user_name; ?>">
                    <div id="new_pass_error"></div>
                    <h2 class="form_title">Neues Passwort</h2>
                    <div class="form-login__field form-login__input">
                        <label for="new_password">Passwort</label>
                        <input type="text" id="new_password" value="" size="25" name="new_password">
                    </div>
                    <div class="form-login__field form-login__button">
                        <button type="submit" class="login__button" name="swpm-login">Einreichen</button>
                    </div>
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