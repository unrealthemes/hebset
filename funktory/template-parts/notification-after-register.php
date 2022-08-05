<?php  
// update_user_meta( get_current_user_id(), 'hide_after_register_notif', false ); 
if ( get_user_meta( get_current_user_id(), 'hide_after_register_notif', true ) ) {
	return;
}

$txt = carbon_get_theme_option('message_after_register_notif');
?>

<li class="hints-list__item hint-message">
    <div class="list-item__image">
        <i class="fas fa-comment-alt"></i>
    </div>
    <div class="list-item__text">
        
        <?php echo apply_filters( 'the_content', $txt ); ?>

    </div>
</li>