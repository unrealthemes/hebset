<?php  
$token = get_user_meta( get_current_user_id(), 'user_yoshteq_token', true );
$user_data = get_contact_person( $token ); // ut_get_midwife( $token );
?>

<div class="personal-widget">
    <div class="img_content">
        <img src="<?php echo $user_data['imageUrl']; ?>" alt="">
    </div>
    <div class="text_content">
        <div class="position">Ihre Kundenbetreuerin</div>
        <div class="name"><?php echo $user_data['firstName'] . ' ' . $user_data['lastName']; ?></div>
        <a class="email" href="mailto:<?php echo $user_data['mail']; ?>">e-mail schreiben</a>
    </div>
</div>