<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package funktory
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function funktory_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'funktory_body_classes' );


/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function funktory_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'funktory_pingback_header' );


// function remove_admin_bar() {
	// if (!current_user_can('administrator') && !is_admin()) {
	  // show_admin_bar(false);
	// }
// }
// add_action('after_setup_theme', 'remove_admin_bar');

add_filter('show_admin_bar', '__return_false');


function keep_me_logged_in_for_4_hours( $expirein ) {
    return 14400; 
}
add_filter( 'auth_cookie_expiration', 'keep_me_logged_in_for_4_hours' );


/**
 * Get permalink by template name
 */

function ut_get_permalik_by_template( $template ) {

	$result = '';

	if ( ! empty( $template ) ) {
		$pages = get_pages( [
		    'meta_key'   => '_wp_page_template',
		    'meta_value' => $template,
			'hierarchical' => 0
		] );
		$template_id = $pages[0]->ID;
		$page = get_post( $template_id );
		$result = get_permalink( $page );
	}
	
	return $result;
}


/**
 * Get title by template name
 */

function ut_get_title_by_template( $template ) {

	$result = '';

	if ( ! empty( $template ) ) {
		$pages = get_pages( [
		    'meta_key'   => '_wp_page_template',
		    'meta_value' => $template,
			'hierarchical' => 0
		] ); 
		$template_id = $pages[0]->ID;
		$result = get_the_title( $template_id );
	}
	
	return $result;
}


function ut_get_subtitle_by_template( $template ) {

	$result = '';

	if ( ! empty( $template ) ) {
		$pages = get_pages( [
		    'meta_key'   => '_wp_page_template',
		    'meta_value' => $template,
			'hierarchical' => 0
		] ); 
		$template_id = $pages[0]->ID;
		$result = carbon_get_post_meta( $template_id, 'subtitle_page' );
	}
	
	return $result;
}


/** 
 * Redirect to home page
 */ 

function ut_redirect_non_logged_users() {

	if ( ! is_user_logged_in() &&
		(
			is_page_template('template-dashboard.php') ||
			is_page_template('template-contact-person.php') ||
			is_page_template('template-hebset-invoices.php') ||
			is_page_template('template-invoices.php') ||
			is_page_template('template-payouts.php') ||
			is_page_template('template-profile.php') ||
			is_page_template('template-sicherstellungszuschlag.php') ||
			is_page_template('template-statistics.php') 
		)
	) {
		wp_redirect( ut_get_permalik_by_template('template-login.php') );  
    	exit;
	} else if (
		is_user_logged_in() &&
		( 
			is_page_template('template-forgot.php') || 
			is_page_template('template-send-password.php') || 
			is_page_template('template-login.php') ||
			is_page_template('template-new-password.php')
		) 
	) {
		wp_redirect( home_url() );  
    	exit;
	}

}
add_action( 'template_redirect', 'ut_redirect_non_logged_users' );


function get_yoshteq_token( $user_name, $user_pass ) {

	$response = null;
	$data = array(
	  	'user' => $user_name,
	  	'password' => $user_pass
	); 
    $api_url = 'https://hebset-portal-dev.yoshteq.de/login';
	$curl = curl_init();
	curl_setopt( $curl, CURLOPT_URL, $api_url );
	curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt( $curl, CURLOPT_POST, 1 );
	curl_setopt( $curl, CURLOPT_POSTFIELDS, http_build_query( $data ) );
	$output = curl_exec( $curl );
	curl_close( $curl );

	if ( ! $output ) {
		return false;
	}
	
	$response = json_decode( $output, true );
	
	return $response['token'];
}


function get_contact_person( $token ) {

	if ( empty( $token ) ) {
		return;
	}

	$authorization = "Authorization: Bearer " . $token;
	$api_url = 'https://hebset-portal-dev.yoshteq.de/contact-person';
	$curl = curl_init();
	curl_setopt( $curl, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json', $authorization ) );
	curl_setopt( $curl, CURLOPT_URL, $api_url );
	curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt( $curl, CURLOPT_HTTPGET, 1 );
	// curl_setopt( $curl, CURLOPT_POSTFIELDS, http_build_query( $data ) );
	$output = curl_exec( $curl );
	curl_close( $curl );
	$user_data = json_decode( $output, true );

	return $user_data;
}


if ( wp_doing_ajax() ) { 
	add_action( 'wp_ajax_hide_profile_notif', 'ut_hide_profile_notif' );
    add_action( 'wp_ajax_nopriv_hide_profile_notif', 'ut_hide_profile_notif' );
}

function ut_hide_profile_notif() {  

	if ( $_POST['action'] == 'hide_profile_notif' ) {
		update_user_meta( get_current_user_id(), 'hide_profile_notif', true );
		wp_send_json_success();
	}
}


if ( wp_doing_ajax() ) { 
	add_action( 'wp_ajax_download_pdf_invoice', 'ut_download_pdf_invoice' );
    add_action( 'wp_ajax_nopriv_download_pdf_invoice', 'ut_download_pdf_invoice' );
}

function ut_download_pdf_invoice() {  

	if ( isset( $_POST['invoice_id'] ) && ! empty( $_POST['invoice_id'] ) ) {
		$user_id = get_current_user_id();
		$token = get_user_meta( $user_id, 'user_yoshteq_token', true );    
		$invoice_id = $_POST['invoice_id'];
		$api_url = 'https://hebset-portal-dev.yoshteq.de/invoices/file';
		ut_file( $token, $invoice_id, $api_url );
	}
}


if ( wp_doing_ajax() ) { 
	add_action( 'wp_ajax_download_pdf_sicherstellungszuschlag', 'ut_download_pdf_sicherstellungszuschlag' );
    add_action( 'wp_ajax_nopriv_download_pdf_sicherstellungszuschlag', 'ut_download_pdf_sicherstellungszuschlag' );
}


function ut_download_pdf_sicherstellungszuschlag() {  

	if ( isset( $_POST['invoice_id'] ) && ! empty( $_POST['invoice_id'] ) ) {
		$user_id = get_current_user_id();
		$token = get_user_meta( $user_id, 'user_yoshteq_token', true );    
		$invoice_id = $_POST['invoice_id'];
		$api_url = 'https://hebset-portal-dev.yoshteq.de/sicherstellungszuschlag/file/';
		ut_file( $token, $invoice_id, $api_url );
	}
}


if ( wp_doing_ajax() ) { 
	add_action( 'wp_ajax_download_pdf_payout', 'ut_download_pdf_payout' );
    add_action( 'wp_ajax_nopriv_download_pdf_payout', 'ut_download_pdf_payout' );
}

function ut_download_pdf_payout() {  

	if ( isset( $_POST['invoice_id'] ) && ! empty( $_POST['invoice_id'] ) ) {
		$user_id = get_current_user_id();
		$token = get_user_meta( $user_id, 'user_yoshteq_token', true );    
		$invoice_id = $_POST['invoice_id'];
		$api_url = 'https://hebset-portal-dev.yoshteq.de/midwife-payout/file';
		ut_file( $token, $invoice_id, $api_url );
	}
}


if ( wp_doing_ajax() ) { 
	add_action( 'wp_ajax_download_pdf_hebset_invoice', 'ut_download_pdf_hebset_invoice' );
    add_action( 'wp_ajax_nopriv_download_pdf_hebset_invoice', 'ut_download_pdf_hebset_invoice' );
}


function ut_download_pdf_hebset_invoice() {  

	if ( isset( $_POST['invoice_id'] ) && ! empty( $_POST['invoice_id'] ) ) {
		$user_id = get_current_user_id();
		$token = get_user_meta( $user_id, 'user_yoshteq_token', true );    
		$invoice_id = $_POST['invoice_id'];
		$api_url = 'https://hebset-portal-dev.yoshteq.de/hebset-invoices/file';
		ut_file( $token, $invoice_id, $api_url );
	}
}


if ( wp_doing_ajax() ) { 
	add_action( 'wp_ajax_user_auth', 'ut_user_auth' );
    add_action( 'wp_ajax_nopriv_user_auth', 'ut_user_auth' );
}

function ut_user_auth() {  

    // check_ajax_referer( 'gpc_user', 'ajax_nonce' );
    parse_str( $_POST['form'], $_POST['form'] );

    if ( empty( $_POST['form']['user_name'] ) ) {
        wp_send_json_error( [
            'name_field' => 'user_name',
        ] );
    }   
           
    if ( empty( $_POST['form']['user_password'] ) ) {
        wp_send_json_error( [
            'name_field' => 'user_password',
        ] );
    }   

    $token = get_yoshteq_token( $_POST['form']['user_name'], $_POST['form']['user_password'] );

	if ( ! $token ) {
		wp_send_json_error( [
            'message' => __( 'Kein Benutzer mit diesen Daten vorhanden', 'ut' ),
        ] );
	}

	$authorization = "Authorization: Bearer " . $token;
	$api_url = 'https://hebset-portal-dev.yoshteq.de/midwife';
	$curl = curl_init();
	curl_setopt( $curl, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json', $authorization ) );
	curl_setopt( $curl, CURLOPT_URL, $api_url );
	curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt( $curl, CURLOPT_HTTPGET, 1 );
	$output = curl_exec( $curl );
	curl_close( $curl );
	$user_data = json_decode( $output, true );

	$user = get_user_by( 'email', $user_data['mail'] );
	
	if ( $user ) { // login
		$credentials = [
            'user_login'    =>  $user_data['mail'],
            'user_password' =>  $_POST['form']['user_password'],
            'remember'      =>  $_POST['form']['rememberme'] ?? false,
        ];  
        $user = wp_signon( $credentials, false ); 

        if ( is_wp_error( $user ) ) {
            wp_send_json_error( [
                'message' => $user->get_error_message(),
            ] );
        }
	} else { // register
		$user_id = wp_insert_user( [
            'user_login' => $user_data['midwifeCode'],
            'user_pass'  => $_POST['form']['user_password'],
            'user_email' => $user_data['mail'],
            'role'  	 => 'midwive',
        ] ) ;

        if ( is_wp_error( $user_id ) ) {
            wp_send_json_error( array(
                'message' => $user_id->get_error_message(),
            ) );
        } 

        $credentials = [
            'user_login'    =>  $user_data['mail'],
            'user_password' =>  $_POST['form']['user_password'],
            'remember'      =>  $_POST['form']['rememberme'] ?? false,
        ];  
        $user = wp_signon( $credentials, false ); 

        if ( is_wp_error( $user ) ) {
            wp_send_json_error( [
                'message' => $user->get_error_message(),
            ] );
        }

        update_user_meta( $user->ID, 'hide_after_register_notif', false );
	}

	update_user_meta( $user->ID, 'user_yoshteq_pass', $_POST['form']['user_password'] );
	update_user_meta( $user->ID, 'user_yoshteq_token', $token );
	$_SESSION['yoshteq_token'] = $token; 

    wp_send_json_success( [
        'redirect_url' => ut_get_permalik_by_template('template-dashboard.php'),
    ] );
}


if ( wp_doing_ajax() ) { 
	add_action( 'wp_ajax_user_forgot', 'ut_user_forgot' );
    add_action( 'wp_ajax_nopriv_user_forgot', 'ut_user_forgot' );
}


function ut_user_forgot() {  

    // check_ajax_referer( 'gpc_user', 'ajax_nonce' );
    parse_str( $_POST['form'], $_POST['form'] );

    if ( empty( $_POST['form']['user_name'] ) ) {
        wp_send_json_error( [
            'name_field' => 'user_name',
        ] );
    }  

    setcookie( 'user_name', $_POST['form']['user_name'], (time()+3600), "/" ); 
    $data = array(
		'user' => $_POST['form']['user_name'],
	); 
	$api_url = 'https://hebset-portal-dev.yoshteq.de/password/forgotten';
	$curl = curl_init();
	curl_setopt( $curl, CURLOPT_URL, $api_url );
	curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt( $curl, CURLOPT_POST, 1 );
	curl_setopt( $curl, CURLOPT_POSTFIELDS, http_build_query( $data ) );
	$output = curl_exec( $curl );
	$httpcode = curl_getinfo( $curl, CURLINFO_HTTP_CODE );
	curl_close( $curl );

	$message = ( $httpcode == 200 ) ? 'A link to change your password has been sent to your email.' : 'Error';

	if ( isset( $_POST['form']['get_passw'] ) ) {
		$user = get_user_by( 'login', $_POST['form']['user_name'] );

		if ( $user && $httpcode == 200 ) {
			$message .= ' The user exists in the system.';
		}
	}

    wp_send_json_success( [
        'message' => $message,
    ] );
}


if ( wp_doing_ajax() ) { 
	add_action( 'wp_ajax_user_new_pass', 'ut_user_new_pass' );
    add_action( 'wp_ajax_nopriv_user_new_pass', 'ut_user_new_pass' );
}


function ut_user_new_pass() {  

    // check_ajax_referer( 'gpc_user', 'ajax_nonce' );
    parse_str( $_POST['form'], $_POST['form'] );

    if ( empty( $_POST['form']['token'] ) ) {
        wp_send_json_error( [
            'name_field' => 'token',
            'message' => 'Error token',
        ] );
    } 

    if ( empty( $_POST['form']['user_name'] ) ) {
        wp_send_json_error( [
            'name_field' => 'user_name',
            'message' => 'Error user name',
        ] );
    } 

    if ( empty( $_POST['form']['new_password'] ) ) {
        wp_send_json_error( [
            'name_field' => 'new_password',
        ] );
    }  

    $data = array(
		'token' => $_POST['form']['token'],
		'newPassword' => $_POST['form']['new_password'],
	); 
	$api_url = 'https://hebset-portal-dev.yoshteq.de/password/reset';
	$curl = curl_init();
	curl_setopt( $curl, CURLOPT_URL, $api_url );
	curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt( $curl, CURLOPT_POST, 1 );
	curl_setopt( $curl, CURLOPT_POSTFIELDS, http_build_query( $data ) );
	$output = curl_exec( $curl );
	$httpcode = curl_getinfo( $curl, CURLINFO_HTTP_CODE );
	curl_close( $curl );

	if ( $httpcode == 200 ) {

		// reset password in wp
		$user = get_user_by( 'email', $_POST['form']['user_name'] );

		if ( ! $user ) {
			$user = get_user_by( 'login', $_POST['form']['user_name'] );
		}

		if ( $user ) {
			// update_user_meta( $user->ID, 'user_pass', $_POST['form']['new_password'] );
			wp_update_user( array('ID' => $user->ID, 'user_pass' => $_POST['form']['new_password']) ) ;
		}

	 	wp_send_json_success( [
	        'message' => 'Success',
	    ] );
	} else {
		wp_send_json_error( [
			'message' => 'Error',
		] );
	}
}


if ( wp_doing_ajax() ) { 
	add_action( 'wp_ajax_user_change_pass', 'ut_user_change_pass' );
    add_action( 'wp_ajax_nopriv_user_change_pass', 'ut_user_change_pass' );
}


function ut_user_change_pass() {  

    // check_ajax_referer( 'gpc_user', 'ajax_nonce' );
    parse_str( $_POST['form'], $_POST['form'] );

    if ( empty( $_POST['form']['new_password'] ) ) {
        wp_send_json_error( [
            // 'name_field' => 'new_password',
            'message' => 'Passwortfeld ist erforderlich',
        ] );
    } 

    if ( empty( $_POST['form']['repeat_new_password'] ) ) {
        wp_send_json_error( [
            // 'name_field' => 'repeat_new_password',
            'message' => 'Das Feld „Passwort wiederholen“ ist erforderlich',
        ] );
    } 

    if ( $_POST['form']['new_password'] != $_POST['form']['repeat_new_password'] ) {
        wp_send_json_error( [
            'message' => 'Passwörter stimmen nicht überein',
        ] );
    }  

	$token = get_user_meta( get_current_user_id(), 'user_yoshteq_token', true );
    $data = array(
		'newPassword' => $_POST['form']['new_password'],
	); 
	$authorization = "Authorization: Bearer " . $token;
	$api_url = 'https://hebset-portal-dev.yoshteq.de/password/change';
	$curl = curl_init();
	curl_setopt( $curl, CURLOPT_HTTPHEADER, array( 'Content-Type: application/x-www-form-urlencoded', 'Accept: */*', $authorization ) );
	curl_setopt( $curl, CURLOPT_URL, $api_url );
	curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt( $curl, CURLOPT_POST, 1 );
	curl_setopt( $curl, CURLOPT_POSTFIELDS, http_build_query( $data ) );
	$output = curl_exec( $curl );
	$httpcode = curl_getinfo( $curl, CURLINFO_HTTP_CODE );

	if ( $httpcode == 200 ) {
		wp_update_user( 
			[
				'ID' => get_current_user_id(), 
				'user_pass' => $_POST['form']['new_password']
			] 
		) ;
		curl_close( $curl );
	 	wp_send_json_success( [
	        'message' => 'Erfolg',
	    ] );
	} else {

		error_log( $token ); 
		error_log( $httpcode ); 
		error_log( curl_error($curl) ); 

		curl_close( $curl );
		wp_send_json_error( [
			'message' => 'Fehler',
		] );
	}
}


function ut_get_midwife( $token ) {

	if ( empty( $token ) ) {
		return;
	}

	$authorization = "Authorization: Bearer " . $token;
	$api_url = 'https://hebset-portal-dev.yoshteq.de/midwife';
	$curl = curl_init();
	curl_setopt( $curl, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json', $authorization ) );
	curl_setopt( $curl, CURLOPT_URL, $api_url );
	curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt( $curl, CURLOPT_HTTPGET, 1 );
	// curl_setopt( $curl, CURLOPT_POSTFIELDS, http_build_query( $data ) );
	$output = curl_exec( $curl );
	curl_close( $curl );
	$user_data = json_decode( $output, true );

	return $user_data;
}


function ut_invoices( $token ) {

	if ( empty( $token ) ) {
		return;
	}

	$data = array(
		// 'count' => 100,
	 //  	'dateFrom' => date('Y-m-d', $date_from ),
	 //  	'dateTo' => date('Y-m-d'),
	  	'orderBy' => 'INVOICEDATE',
	  	// 'orderDir' => 'DESC',
	); 
	$authorization = "Authorization: Bearer " . $token;
	$api_url = 'https://hebset-portal-dev.yoshteq.de/invoices?orderBy=INVOICEDATE';
	$curl = curl_init();
	curl_setopt( $curl, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json', $authorization ) );
	curl_setopt( $curl, CURLOPT_URL, $api_url );
	curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt( $curl, CURLOPT_HTTPGET, 1 );
	// curl_setopt( $curl, CURLOPT_POSTFIELDS, http_build_query( $data ) );
	$output = curl_exec( $curl );
	curl_close( $curl );
	$response = json_decode( $output, true );

	return $response;
}


function ut_file( $token, $ids, $api_url ) {

	if ( empty( $token ) ) {
		return;
	}

	$file_name = ( is_array( $ids ) ) ? 'invoices.pdf' : 'invoice.pdf';
	$destination = ABSPATH . 'files/' . $file_name;
	//$redirect_url = site_url() . '/download.php?id=' . $ids;
    $redirect_url = site_url() . '/files/' . $file_name;
	$authorization = "Authorization: Bearer " . $token;

	if ( ! stristr( $api_url, 'sicherstellungszuschlag' ) ) {

		if ( is_array( $ids ) ) {
			$api_url = $api_url;
			foreach ( $ids as $key => $item ) {
				$symbol = ( $key == 0 ) ? '?' : '&';
				$api_url .= $symbol . 'id=' . $item;
			}
		} else {
			$api_url = $api_url . '?id=' . $ids;
		}
		
	} else {
		$api_url = $api_url . '/' . $ids;
	}
	// clear directory
	ut_clear_directory( ABSPATH . 'files/' );

	$curl = curl_init();
	curl_setopt( $curl, CURLOPT_HTTPHEADER, array( 'Content-Type: application/pdf', $authorization ) );
	curl_setopt( $curl, CURLOPT_URL, $api_url );
	curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt( $curl, CURLOPT_HTTPGET, 1 );
	$output = curl_exec( $curl );
	curl_close( $curl );

	$file = fopen( $destination, "w" );

    if ( $file == false ) {
        wp_send_json_error();
    }

    fputs( $file, $output );
    fclose( $file );

	//ut_create_zip( $destination, $file_name, 'hebset-files.zip' );
	wp_send_json_success( [ 'redirect' => $redirect_url ] );
}


function ut_hebset_invoices( $token ) {

	if ( empty( $token ) ) {
		return;
	}

	$authorization = "Authorization: Bearer " . $token;
	$api_url = 'https://hebset-portal-dev.yoshteq.de/hebset-invoices';
	$curl = curl_init();
	curl_setopt( $curl, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json', $authorization ) );
	curl_setopt( $curl, CURLOPT_URL, $api_url );
	curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt( $curl, CURLOPT_HTTPGET, 1 );
	$output = curl_exec( $curl );
	curl_close( $curl );
	$response = json_decode( $output, true );

	return $response;
}


function ut_midwife_payout( $token ) {

	if ( empty( $token ) ) {
		return;
	}

	$date_from = strtotime( date('Y-m-d') . ' -2 year');
	$data = array(
		'count' => 100,
	  	'dateFrom' => date('Y-m-d', $date_from ),
	  	'dateTo' => date('Y-m-d'),
	  	'orderBy' => 'DATE_TO',
	  	'orderDir' => 'DESC',
	);  
	$authorization = "Authorization: Bearer " . $token;
	$api_url = 'https://hebset-portal-dev.yoshteq.de/midwife-payout';
	$curl = curl_init();
	curl_setopt( $curl, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json', $authorization ) );
	curl_setopt( $curl, CURLOPT_URL, $api_url );
	curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt( $curl, CURLOPT_HTTPGET, 1 );
	// curl_setopt( $curl, CURLOPT_POSTFIELDS, http_build_query( $data ) );
	$output = curl_exec( $curl );
	curl_close( $curl );
	$response = json_decode( $output, true );

	return $response;
}


function ut_statistics( $token, $year ) {

	if ( empty( $token ) ) {
		return;
	}

	if ( ! $year ) {
		$year = date('Y');
	}

	$authorization = "Authorization: Bearer " . $token;
	// $api_url = 'https://hebset-portal-dev.yoshteq.de/statistics?dateFrom=2015-07-22&dateTo=2021-07-22&groupType=MONTH';
	$api_url = 'https://hebset-portal-dev.yoshteq.de/statistics?dateFrom=' . $year . '-01-01&dateTo=' . $year . '-12-31&groupType=MONTH';
	$curl = curl_init();
	curl_setopt( $curl, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json', $authorization ) );
	curl_setopt( $curl, CURLOPT_URL, $api_url );
	curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt( $curl, CURLOPT_HTTPGET, 1 );
	// curl_setopt( $curl, CURLOPT_POSTFIELDS, http_build_query( $data ) );
	$output = curl_exec( $curl );
	curl_close( $curl );
	$response = json_decode( $output, true );

	return $response;
}


function ut_mileage( $token, $year ) {

    if ( empty( $token ) ) {
        return;
    }

    if ( ! $year ) {
        $year = date('Y');
    }

    $authorization = "Authorization: Bearer " . $token;
    $api_url = 'https://hebset-portal-dev.yoshteq.de/mileage?year='.$year;
    $curl = curl_init();
    curl_setopt( $curl, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json', $authorization ) );
    curl_setopt( $curl, CURLOPT_URL, $api_url );
    curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt( $curl, CURLOPT_HTTPGET, 1 );
    // curl_setopt( $curl, CURLOPT_POSTFIELDS, http_build_query( $data ) );
    $output = curl_exec( $curl );
    curl_close( $curl );
    $response = json_decode( $output, true );

    return $response;
}


function ut_balance( $token, $year ) {

    if ( empty( $token ) ) {
        return;
    }

    if ( ! $year ) {
        $year = date('Y');
    }

    $authorization = "Authorization: Bearer " . $token;
    $api_url = 'https://hebset-portal-dev.yoshteq.de/balance?dateFrom='.$year.'-01-01&dateTo='.$year.'-12-12';
    $curl = curl_init();
    curl_setopt( $curl, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json', $authorization ) );
    curl_setopt( $curl, CURLOPT_URL, $api_url );
    curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt( $curl, CURLOPT_HTTPGET, 1 );
    // curl_setopt( $curl, CURLOPT_POSTFIELDS, http_build_query( $data ) );
    $output = curl_exec( $curl );
    curl_close( $curl );
    $response = json_decode( $output, true );

    return $response;
}


function ut_sicherstellungszuschlag( $token, $year ) {

	if ( empty( $token ) ) {
		return;
	}

	$authorization = "Authorization: Bearer " . $token;
	$api_url = 'https://hebset-portal-dev.yoshteq.de/sicherstellungszuschlag/' . $year;
	$curl = curl_init();
	curl_setopt( $curl, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json', $authorization ) );
	curl_setopt( $curl, CURLOPT_URL, $api_url );
	curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt( $curl, CURLOPT_HTTPGET, 1 );
	$output = curl_exec( $curl );
	curl_close( $curl );
	$response = json_decode( $output, true );

	return $response;
}


function ut_create_zip( $destination, $file_name, $zip_name ) {

    $file = ABSPATH . 'files/' . $zip_name;
    $redirect_url = site_url() . '/files/' . $zip_name;
 
    $zip = new ZipArchive();
    if ( $zip->open( $file, ZipArchive::CREATE ) !== TRUE ) {
        // throw new \Exception('Cannot create a zip file');
		wp_send_json_error('Cannot create a zip file');
    }
 
    $zip->addFile( $destination, $file_name );
    $zip->close();

	wp_send_json_success( [ 'redirect' => $redirect_url ] );
}


function ut_clear_directory( $path ) {

	$files = glob( $path .'*' ); // get all file names
	foreach ( $files as $file ) { // iterate files
		if ( is_file( $file ) ) {
			unlink( $file ); // delete file
		}
	}
}


function wc_price( $price, $args = array() ) {

	$args = apply_filters(
		'wc_price_args',
		wp_parse_args(
			$args,
			array(
				'ex_tax_label'       => false,
				'currency'           => '',
				'decimal_separator'  => wc_get_price_decimal_separator(),
				'thousand_separator' => wc_get_price_thousand_separator(),
				'decimals'           => wc_get_price_decimals(),
				'price_format'       => get_woocommerce_price_format(),
			)
		)
	);

	$original_price = $price;

	// Convert to float to avoid issues on PHP 8.
	$price = (float) $price;

	$unformatted_price = $price;
	$negative          = $price < 0;

	/**
	 * Filter raw price.
	 *
	 * @param float        $raw_price      Raw price.
	 * @param float|string $original_price Original price as float, or empty string. Since 5.0.0.
	 */
	$price = apply_filters( 'raw_woocommerce_price', $negative ? $price * -1 : $price, $original_price );

	/**
	 * Filter formatted price.
	 *
	 * @param float        $formatted_price    Formatted price.
	 * @param float        $price              Unformatted price.
	 * @param int          $decimals           Number of decimals.
	 * @param string       $decimal_separator  Decimal separator.
	 * @param string       $thousand_separator Thousand separator.
	 * @param float|string $original_price     Original price as float, or empty string. Since 5.0.0.
	 */
	$price = apply_filters( 'formatted_woocommerce_price', number_format( $price, $args['decimals'], $args['decimal_separator'], $args['thousand_separator'] ), $price, $args['decimals'], $args['decimal_separator'], $args['thousand_separator'], $original_price );

	if ( apply_filters( 'woocommerce_price_trim_zeros', false ) && $args['decimals'] > 0 ) {
		$price = wc_trim_zeros( $price );
	}

	$formatted_price = ( $negative ? '-' : '' ) . sprintf( $args['price_format'], $price, '<span class="woocommerce-Price-currencySymbol"> €</span>' );
	$return          = '<span class="woocommerce-Price-amount amount"><bdi>' . $formatted_price . '</bdi></span>';

	/**
	 * Filters the string of price markup.
	 *
	 * @param string       $return            Price HTML markup.
	 * @param string       $price             Formatted price.
	 * @param array        $args              Pass on the args.
	 * @param float        $unformatted_price Price as float to allow plugins custom formatting. Since 3.2.0.
	 * @param float|string $original_price    Original price as float, or empty string. Since 5.0.0.
	 */
	return apply_filters( 'wc_price', $return, $price, $args, $unformatted_price, $original_price );
}


/**
 * Return the thousand separator for prices.
 *
 * @since  2.3
 * @return string
 */
function wc_get_price_thousand_separator() {
	return stripslashes( apply_filters( 'wc_get_price_thousand_separator', get_option( 'woocommerce_price_thousand_sep' ) ) );
}

/**
 * Return the decimal separator for prices.
 *
 * @since  2.3
 * @return string
 */
function wc_get_price_decimal_separator() {
	$separator = apply_filters( 'wc_get_price_decimal_separator', get_option( 'woocommerce_price_decimal_sep' ) );
	return $separator ? stripslashes( $separator ) : '.';
}

/**
 * Return the number of decimals after the decimal point.
 *
 * @since  2.3
 * @return int
 */
function wc_get_price_decimals() {
	return absint( apply_filters( 'wc_get_price_decimals', get_option( 'woocommerce_price_num_decimals', 2 ) ) );
}

/**
 * Get the price format depending on the currency position.
 *
 * @return string
 */
function get_woocommerce_price_format() {
	$currency_pos = get_option( 'woocommerce_currency_pos' );
	$format       = '%1$s%2$s';

	switch ( $currency_pos ) {
		case 'left':
			$format = '%1$s%2$s';
			break;
		case 'right':
			$format = '%2$s%1$s';
			break;
		case 'left_space':
			$format = '%1$s&nbsp;%2$s';
			break;
		case 'right_space':
			$format = '%2$s&nbsp;%1$s';
			break;
	}

	return apply_filters( 'woocommerce_price_format', $format, $currency_pos );
}

add_action( 'show_user_profile', 'add_user_custom_fields' );
add_action( 'edit_user_profile', 'add_user_custom_fields' );

function add_user_custom_fields($user){
    $user_notif = get_user_meta($user->ID, 'hide_after_register_notif', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="hide_after_register_notif">Zulassungsbescheid</label></th>
            <td>
                <label><input type="checkbox" id="hide_after_register_notif" name="hide_after_register_notif"<?php checked( $user_notif, '1', true ) ?>' /> Ja</label>
            </td>
        </tr>
    </table>
    <?php
}

add_action( 'personal_options_update', 'save_user_custom_fields' );
add_action( 'edit_user_profile_update', 'save_user_custom_fields' );

function save_user_custom_fields($user_id){
    $user_notif = $_POST['hide_after_register_notif'];
    if($user_notif == ''){
        $value = false;
    }else{
        $value = true;
    }
    update_user_meta( $user_id,'hide_after_register_notif', $value );
}