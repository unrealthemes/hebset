<?php
/**
 * Template name: Midwive Downloads
 */

get_header();

echo do_shortcode('[elementor-template id="951"]');

// $token = $_SESSION['yoshteq_token'] ?? null;
$token = get_user_meta( get_current_user_id(), 'user_yoshteq_token', true );
$user_data = get_contact_person( $token );
?>

    <style>
        .elementor.elementor-location-header {
            display: none;
        }
    </style>

    <div class="wrapper">

        <div class="page-title">
            <div class="container">
                <?php the_title( '<h1>', '</h1>' ); ?>

                <?php get_template_part('template-parts/personal-widget'); ?>
            </div>
        </div>

        <div class="content-inform">
        	<table class="table_download">
                <thead>
                    <tr>
                        <td>Dokument</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><a href="#">Testdokument</a></td>
                        
                    </tr>
                    <tr>
                        <td><a href="#">Testdokument</a></td>
                        
                    </tr>
                    <tr>
                        <td><a href="#">Testdokument</a></td>
                        
                    </tr>
                    <tr>
                        <td><a href="#">Testdokument</a></td>
                        
                    </tr>
                    <tr>
                        <td><a href="#">Testdokument</a></td>
                        
                    </tr>
                    <tr>
                        <td><a href="#">Testdokument</a></td>
                        
                    </tr>
                </tbody>

            </table>
        </div>

    </div>

<?php
get_footer();