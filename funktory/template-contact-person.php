<?php
/**
 * Template name: Contact person
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
        	<div class="photo-inform">
        		<a class="photo-block" href="mailto:<?php echo $user_data['mail']; ?>">
					<img src="<?php echo $user_data['imageUrl']; ?>" title="Hebamme-Ansprechpartnerin-Beispiel" alt="<?php echo $user_data['firstName'] . ' ' . $user_data['lastName']; ?>">
				</a>
        		<div class="inform-block">
        			<p class="text-1">Ihr persönlicher Ansprechpartner</p>
        			<h3 class="title"><?php echo $user_data['firstName'] . ' ' . $user_data['lastName']; ?></h3>
        			<p class="text-2">Sie erreichen mich unter:</p>
        			<p class="email"><?php echo $user_data['mail']; ?></p>
        			<p class="tel"><?php echo $user_data['phone']; ?></p>
        		</div>
        	</div>
        </div>

    </div>

<?php
get_footer();