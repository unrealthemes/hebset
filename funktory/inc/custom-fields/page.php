<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', 'Custom Data')
	->show_on_post_type('page')
    ->add_fields( array(
        Field::make( "text", "subtitle_page", "subTitle")->set_width( 100 ),
    ));