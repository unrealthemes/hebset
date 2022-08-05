<?php
/**
 * Template name: Midwive Profile
 */

get_header();

echo do_shortcode('[elementor-template id="951"]');

// $token = $_SESSION['yoshteq_token'] ?? null;
$token = get_user_meta( get_current_user_id(), 'user_yoshteq_token', true );
$user_data = ut_get_midwife( $token );
$invoices = ut_invoices( $token );
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

        <section class="customer-hints">
            <div class="container">
                <ul class="hints-list">

                    <?php get_template_part( 'template-parts/notification', 'after-register' ); ?>

                    <?php get_template_part( 'template-parts/notification', 'profile' ); ?>

                </ul>
            </div>
        </section>

        <?php if ( $user_data ) : ?>

            <section class="customer-data">
                <div class="container customer-data__container">
                    <div class="customer-data__column">
                        <h2 class="customer-data__title">Mein Profil</h2>

                        <?php if ( isset( $user_data['firstName'] ) && isset( $user_data['lastName'] ) ) : ?>

                            <div class="customer-data__field">
                                <div class="field-title">Vor- und Nachname</div>
                                <div class="field-text">
                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36 36"><path fill="#3B88C3" d="M36 32c0 2.209-1.791 4-4 4H4c-2.209 0-4-1.791-4-4V4c0-2.209 1.791-4 4-4h28c2.209 0 4 1.791 4 4v28z"/><path fill="#FFF" d="M30.2 10L23 4v4h-8C9.477 8 5 12.477 5 18c0 1.414.297 2.758.827 3.978l3.3-2.75C9.044 18.831 9 18.421 9 18c0-3.314 2.686-6 6-6h8v4l7.2-6zm-.026 4.023l-3.301 2.75c.083.396.127.806.127 1.227 0 3.313-2.687 6-6 6h-8v-4l-7.2 6 7.2 6v-4h8c5.522 0 10-4.478 10-10 0-1.414-.297-2.758-.826-3.977z"/></svg> -->
                                    <?php echo $user_data['firstName'] . ' ' . $user_data['lastName']; ?>
                                </div>
                            </div>

                        <?php endif; ?>

                        <?php if ( isset( $user_data['street'] ) && isset( $user_data['zipCode'] ) && isset( $user_data['cityName'] ) ) : ?>

                            <div class="customer-data__field">
                                <div class="field-title">Adresse</div>
                                <div class="field-text">
                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36 36"><path fill="#3B88C3" d="M36 32c0 2.209-1.791 4-4 4H4c-2.209 0-4-1.791-4-4V4c0-2.209 1.791-4 4-4h28c2.209 0 4 1.791 4 4v28z"/><path fill="#FFF" d="M30.2 10L23 4v4h-8C9.477 8 5 12.477 5 18c0 1.414.297 2.758.827 3.978l3.3-2.75C9.044 18.831 9 18.421 9 18c0-3.314 2.686-6 6-6h8v4l7.2-6zm-.026 4.023l-3.301 2.75c.083.396.127.806.127 1.227 0 3.313-2.687 6-6 6h-8v-4l-7.2 6 7.2 6v-4h8c5.522 0 10-4.478 10-10 0-1.414-.297-2.758-.826-3.977z"/></svg> -->
                                    <?php echo $user_data['street']; ?> <br>
                                    <?php echo $user_data['zipCode'] . ' ' . $user_data['cityName']; ?>
                                </div>
                            </div>

                        <?php endif; ?>

                        <?php if ( isset( $user_data['phone'] ) && isset( $user_data['mobil'] ) ) : ?>

                            <div class="customer-data__field">
                                <div class="field-title">Telefon- und Handynummer</div>
                                <div class="field-text">
                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36 36"><path fill="#3B88C3" d="M36 32c0 2.209-1.791 4-4 4H4c-2.209 0-4-1.791-4-4V4c0-2.209 1.791-4 4-4h28c2.209 0 4 1.791 4 4v28z"/><path fill="#FFF" d="M30.2 10L23 4v4h-8C9.477 8 5 12.477 5 18c0 1.414.297 2.758.827 3.978l3.3-2.75C9.044 18.831 9 18.421 9 18c0-3.314 2.686-6 6-6h8v4l7.2-6zm-.026 4.023l-3.301 2.75c.083.396.127.806.127 1.227 0 3.313-2.687 6-6 6h-8v-4l-7.2 6 7.2 6v-4h8c5.522 0 10-4.478 10-10 0-1.414-.297-2.758-.826-3.977z"/></svg> -->
                                    <?php echo $user_data['phone']; ?> <br>
                                    <?php echo $user_data['mobil']; ?>
                                </div>
                            </div>

                        <?php endif; ?>

                        <?php if ( isset( $user_data['mail'] ) ) : ?>

                            <div class="customer-data__field">
                                <div class="field-title">E-Mail-Adresse (Kontakt)</div>
                                <div class="field-text">
                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36 36"><path fill="#3B88C3" d="M36 32c0 2.209-1.791 4-4 4H4c-2.209 0-4-1.791-4-4V4c0-2.209 1.791-4 4-4h28c2.209 0 4 1.791 4 4v28z"/><path fill="#FFF" d="M30.2 10L23 4v4h-8C9.477 8 5 12.477 5 18c0 1.414.297 2.758.827 3.978l3.3-2.75C9.044 18.831 9 18.421 9 18c0-3.314 2.686-6 6-6h8v4l7.2-6zm-.026 4.023l-3.301 2.75c.083.396.127.806.127 1.227 0 3.313-2.687 6-6 6h-8v-4l-7.2 6 7.2 6v-4h8c5.522 0 10-4.478 10-10 0-1.414-.297-2.758-.826-3.977z"/></svg> -->
                                    <?php echo $user_data['mail']; ?>  <br>
                                    <?php echo $user_data['mailNotification']; ?>
                                </div>
                            </div>

                        <?php endif; ?>

                        <?php if ( isset( $user_data['institutionCode'] ) ) : ?>

                            <div class="customer-data__field">
                                <div class="field-title">IK-Nummer</div>
                                <div class="field-text">
                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36 36"><path fill="#3B88C3" d="M36 32c0 2.209-1.791 4-4 4H4c-2.209 0-4-1.791-4-4V4c0-2.209 1.791-4 4-4h28c2.209 0 4 1.791 4 4v28z"/><path fill="#FFF" d="M30.2 10L23 4v4h-8C9.477 8 5 12.477 5 18c0 1.414.297 2.758.827 3.978l3.3-2.75C9.044 18.831 9 18.421 9 18c0-3.314 2.686-6 6-6h8v4l7.2-6zm-.026 4.023l-3.301 2.75c.083.396.127.806.127 1.227 0 3.313-2.687 6-6 6h-8v-4l-7.2 6 7.2 6v-4h8c5.522 0 10-4.478 10-10 0-1.414-.297-2.758-.826-3.977z"/></svg> -->
                                    <?php echo $user_data['institutionCode']; ?>
                                </div>
                            </div>

                        <?php endif; ?>

                        <!-- <div class="customer-data__field">
                            <div class="field-title">Bankdaten</div>
                            <div class="field-text">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36 36"><path fill="#3B88C3" d="M36 32c0 2.209-1.791 4-4 4H4c-2.209 0-4-1.791-4-4V4c0-2.209 1.791-4 4-4h28c2.209 0 4 1.791 4 4v28z"/><path fill="#FFF" d="M30.2 10L23 4v4h-8C9.477 8 5 12.477 5 18c0 1.414.297 2.758.827 3.978l3.3-2.75C9.044 18.831 9 18.421 9 18c0-3.314 2.686-6 6-6h8v4l7.2-6zm-.026 4.023l-3.301 2.75c.083.396.127.806.127 1.227 0 3.313-2.687 6-6 6h-8v-4l-7.2 6 7.2 6v-4h8c5.522 0 10-4.478 10-10 0-1.414-.297-2.758-.826-3.977z"/></svg>
                                IBAN: **** **** **** 4521
                            </div>
                        </div> -->
                    </div>
                    <div class="customer-data__column">
                        <h2 class="customer-data__title">Kontoinformationen</h2>

                        <?php if ( isset( $user_data['midwifeCode'] ) ) : ?>

                            <div class="customer-data__field">
                                <div class="field-title">Kundennummer</div>
                                <div class="field-text">
                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36 36"><path fill="#3B88C3" d="M36 32c0 2.209-1.791 4-4 4H4c-2.209 0-4-1.791-4-4V4c0-2.209 1.791-4 4-4h28c2.209 0 4 1.791 4 4v28z"/><path fill="#FFF" d="M30.2 10L23 4v4h-8C9.477 8 5 12.477 5 18c0 1.414.297 2.758.827 3.978l3.3-2.75C9.044 18.831 9 18.421 9 18c0-3.314 2.686-6 6-6h8v4l7.2-6zm-.026 4.023l-3.301 2.75c.083.396.127.806.127 1.227 0 3.313-2.687 6-6 6h-8v-4l-7.2 6 7.2 6v-4h8c5.522 0 10-4.478 10-10 0-1.414-.297-2.758-.826-3.977z"/></svg> -->
                                    <?php echo $user_data['midwifeCode']; ?>
                                </div>
                            </div>

                        <?php endif; ?>

                        <?php if ( isset( $user_data['mail'] ) ) : ?>

                            <div class="customer-data__field">
                                <div class="field-title">E-Mail-Adresse (Log-in)</div>
                                <div class="field-text">
                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36 36"><path fill="#3B88C3" d="M36 32c0 2.209-1.791 4-4 4H4c-2.209 0-4-1.791-4-4V4c0-2.209 1.791-4 4-4h28c2.209 0 4 1.791 4 4v28z"/><path fill="#FFF" d="M30.2 10L23 4v4h-8C9.477 8 5 12.477 5 18c0 1.414.297 2.758.827 3.978l3.3-2.75C9.044 18.831 9 18.421 9 18c0-3.314 2.686-6 6-6h8v4l7.2-6zm-.026 4.023l-3.301 2.75c.083.396.127.806.127 1.227 0 3.313-2.687 6-6 6h-8v-4l-7.2 6 7.2 6v-4h8c5.522 0 10-4.478 10-10 0-1.414-.297-2.758-.826-3.977z"/></svg> -->
                                    <?php echo $user_data['mail']; ?>
                                </div>
                            </div>

                        <?php endif; ?>

                        <div class="customer-data__field">
                            <div class="field-title">Passwort</div>
                            <div class="field-text">
                                ***************
                            </div>
                        </div>
                        <a href="#edit_form" class="change-data change-data__login smooth-scrolling">
                            <i class="fas fa-edit"></i>
                            Zugangsdaten ändern
                        </a>

                        <div class="customer-data__title">Rechnungen (Gebühren)</div>
                        <div class="customer-data__field">
                            <div class="field-title">Aktuelle Rechnungen</div>

                            <?php foreach( $invoices as $key => $invoice ) : ?>

                                <?php  
                                if ( $key > 2 ) {
                                    break;
                                }
                                ?>

                                <div class="field-text profile_invoice_pdf" data-id="<?php echo $invoice['id']; ?>" data-action="download_pdf_invoice">
                                    <i class="fas fa-file-download"></i>
                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36 36"><path fill="#3B88C3" d="M36 32c0 2.209-1.791 4-4 4H4c-2.209 0-4-1.791-4-4V4c0-2.209 1.791-4 4-4h28c2.209 0 4 1.791 4 4v28z"/><path fill="#FFF" d="M30.2 10L23 4v4h-8C9.477 8 5 12.477 5 18c0 1.414.297 2.758.827 3.978l3.3-2.75C9.044 18.831 9 18.421 9 18c0-3.314 2.686-6 6-6h8v4l7.2-6zm-.026 4.023l-3.301 2.75c.083.396.127.806.127 1.227 0 3.313-2.687 6-6 6h-8v-4l-7.2 6 7.2 6v-4h8c5.522 0 10-4.478 10-10 0-1.414-.297-2.758-.826-3.977z"/></svg> -->
                                    RE-2021-<?= $invoice['id']; ?>
                                </div>

                            <?php endforeach; ?>

                        </div>
                        <a href="<?php echo ut_get_permalik_by_template('template-invoices.php'); ?>" class="view_all_invoices">Alle Rechnungen anzeigen</a>
                    </div>
                    <div class="customer-data__signature">
                        <p>Sie möchten uns eine Änderung Ihrer Daten mitteilen?</p>
                        <a class="change-data change-data__all smooth-scrolling" href="#edit_form">   
                            <i class="fas fa-edit"></i>
                            Daten anpassen
                        </a>
                    </div>
                </div>
            </section>

        <?php endif; ?>
        
        <div class="change-password-wrapper elementor-element elementor-element-83a5fba elementor-button-align-end elementor-widget elementor-widget-form">
            
            <div data-elementor-type="wp-page" data-elementor-id="1088" class="elementor elementor-1088">
                <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-50bbf18">
                    <section data-particle_enable="false" data-particle-mobile-disabled="false" class="elementor-section elementor-inner-section elementor-element elementor-element-f0b6721 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="f0b6721" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}" style="width: 100%;">
                        <div class="elementor-container elementor-column-gap-default">
                            <div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-230f6b0" data-id="230f6b0" data-element_type="column">
                                <div class="elementor-widget-wrap elementor-element-populated">
                                    <div class="elementor-element elementor-element-bfc136d elementor-widget elementor-widget-heading" data-id="bfc136d" data-element_type="widget" data-widget_type="heading.default">
                                        <div class="elementor-widget-container">
                                            <h3 class="elementor-heading-title elementor-size-default">Passwort ändern</h3>		
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <form id="ut_change_pass_form" action="" method="post" class="elementor-form-fields-wrapper elementor-labels-">
                <div class="elementor-field-type-tel elementor-field-group elementor-column elementor-field-group-message elementor-col-50">
                    <input type="password" name="new_password" value="" placeholder="Passwort">
                </div>
                <div class="elementor-field-type-tel elementor-field-group elementor-column elementor-field-group-message elementor-col-50">
                    <input type="password" name="repeat_new_password" value="" placeholder="Passwort wiederholen">
                </div>
                <div class="elementor-field-group elementor-column elementor-field-type-submit elementor-col-100 e-form__buttons">
                    <input type="submit" value="Veränderung" class="elementor-button elementor-size-md">
                </div>
                <div id="change_pass_error"></div>
            </form>
        </div>

        <section id="edit_form">

            <?php the_content(); ?>

        </section>

    </div>

<?php
get_footer();