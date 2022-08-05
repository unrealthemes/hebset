<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make( 'theme_options', __( 'Theme Options', 'green_paradise' ) )
    ->set_icon( 'dashicons-hammer' )
    ->set_page_menu_title( 'Template settings' )
    ->add_tab( 'Notifications', array(
        Field::make( "rich_text", "message_after_register_notif", "Message after register")->set_width( 100 ),
        Field::make( "rich_text", "message_profile_notif", "Message in Profile page")->set_width( 100 ),
    ));

 