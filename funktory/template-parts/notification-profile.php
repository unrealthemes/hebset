<?php  
if ( get_user_meta( get_current_user_id(), 'hide_profile_notif', true ) ) {
	return;
}

$txt = carbon_get_theme_option('message_profile_notif');
?>

<li id="hide_profile_notif" class="hints-list__item hint-warning">
    <div class="list-item__image">
        <i class="fas fa-exclamation-circle"></i>
    </div>
    <div class="list-item__text">

        <?php echo apply_filters( 'the_content', $txt ); ?>

        <ul>
            <li>
                <a href="#edit_form" class="smooth-scrolling">
                    <i aria-hidden="true" class="fas fa-edit"></i>
                    Daten anpassen
                </a>
            </li>
            <li id="notif_profile_close">
                <span >
                    <i aria-hidden="true" class="fas fa-check-circle"></i>
                    Ich bestätige, dass die Daten korrekt sind
                </span>
            </li>
        </ul>
    </div>
</li>