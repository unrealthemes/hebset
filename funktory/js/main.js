'use strict';

let MAIN = {

  	init: function init() {
	    
		MAIN.login();
		MAIN.forgot();
		MAIN.new_pass();
		MAIN.change_pass();
		MAIN.smooth_scrolling();
		MAIN.hide_profile_notif();
		MAIN.download_pdf();
  	},

  	download_pdf: function download_pdf() {

  		$(".modal_invoices .open_invoices").click( function(e) {
  			event.preventDefault();	
			var ids = [];
			var action = '';
			$('.download_file:checked').each( function ( index, value ) {
				ids.push( $(this).val() );
				action = $(this).data('action');
			});
			MAIN.output_pdf_file( ids, action );
		});

  		$(".download_file").change( function(e) {
  			var count_cheked = $('.download_file:checked').length;
  			$('.modal_invoices').show();
			$('.modal_invoices .checked_invoices span').html( count_cheked );

  			if ( ! count_cheked ) {
  				$('.modal_invoices').hide();
			}
		});

  		$(".all_seleted").change( function(e) {

  			if ( this.checked ) {
	         	var $section = $('#payouts__table');

		    	if ( $section.is( '.processing' ) ) {
					return false;
				}

				$section.addClass( 'processing' ).block({
					message: null,
					overlayCSS: {
						background: '#fff',
						opacity: 0.6
					}
				});

				var count_items = $('.download_file').length;

				if ( count_items ) {
					$('.modal_invoices').show();
					$('.modal_invoices .checked_invoices span').html( count_items );
				}

				$section.removeClass( 'processing' ).unblock();
		    } else {
		    	$('.modal_invoices').hide();
		    }
		});

  		// $(".download_file").on( 'dblclick', function(e) {
  		$(".download_icon").on( 'click', function(e) {
  			var $this = $(this);
		    // var invoice_id = $this.val();
		    var invoice_id = $this.data('id');
		    var action = $this.data('action');
		    // var $section = $this.parents('tr');

	    	// if ( $section.is( '.processing' ) ) {
			// 	return false;
			// }

			// $section.addClass( 'processing' ).block({
			// 	message: null,
			// 	overlayCSS: {
			// 		background: '#fff',
			// 		opacity: 0.6
			// 	}
			// });

			MAIN.output_pdf_file( invoice_id, action );
			// $section.removeClass( 'processing' ).unblock();
		});

		$('.download_icon').on( 'click', function(e) {
			var $this = $(this);
			var invoice_id = $this.find('td svg').data('id');
		    var action = $this.find('td svg').data('action');

			MAIN.output_pdf_file( invoice_id, action );
		});

		$(".profile_invoice_pdf").on( 'click', function(e) {
  			var $this = $(this);
		    var invoice_id = $this.data('id');
		    var action = $this.data('action');
		    var $section = $this;

	    	if ( $section.is( '.processing' ) ) {
				return false;
			}

			$section.addClass( 'processing' ).block({
				message: null,
				overlayCSS: {
					background: '#fff',
					opacity: 0.6
				}
			});

			MAIN.output_pdf_file( invoice_id, action );
			$section.removeClass( 'processing' ).unblock();
		});
	},

	output_pdf_file: function output_pdf_file( invoice_id, action ) {

		let data = {
	        action     : action,
	        ajax_nonce : main_params.ajax_nonce,
	        invoice_id : invoice_id,
	    };

	    $.ajax({
	        url  : main_params.ajaxurl,
	        data : data,
	        type : 'POST',
	        success: function( response ) {

	        	if ( response.success ) {

					// window.location = response.data.redirect;
					window.open( response.data.redirect, '_blank' );
					// console.log( response.data.redirect );

	                /*var win = window.open( response.data.redirect, '_blank' );

					if (win) {
					    //Browser has allowed it to be opened
					    win.focus();
					} else {
					    //Browser has blocked it
					    // alert('Please allow popups for this website');
					}*/
	            }
	        }
	    });
	},

	smooth_scrolling: function smooth_scrolling() {

		$("a.smooth-scrolling").on( "click", function (event) {
	        //отменяем стандартную обработку нажатия по ссылке
	        event.preventDefault();
	        //забираем идентификатор бока с атрибута href
	        var id  = $(this).attr('href'),
	        //узнаем высоту от начала страницы до блока на который ссылается якорь
	        top = $(id).offset().top - 180;
	        //анимируем переход на расстояние - top за 1500 мс
	        $('body,html').animate({scrollTop: top}, 1500);
    	});

	},

	hide_profile_notif: function hide_profile_notif() {

		$("#notif_profile_close").on( "click", function (event) {
			let $section = $( '#hide_profile_notif' );

	    	if ( $section.is( '.processing' ) ) {
				return false;
			}

			$section.addClass( 'processing' ).block({
				message: null,
				overlayCSS: {
					background: '#fff',
					opacity: 0.6
				}
			});

		    let data = {
		        action     : 'hide_profile_notif',
		        ajax_nonce : main_params.ajax_nonce,
		    };

		    $.ajax({
		        url  : main_params.ajaxurl,
		        data : data,
		        type : 'POST',
		        beforeSend: function() {
					 
		        },
		        complete: function() {
		        	$section.removeClass( 'processing' ).unblock();
		        },
		        success: function( response ) {

		        	if ( response.success ) {
		                $( '#hide_profile_notif' ).remove();
		            }
		        }
		    });
		});
	},

	login: function login() {

    	$('#ut_login_form').submit( function( e ) {
	    	e.preventDefault();
	    	let $section = $( '#ut_login_form' );

	    	if ( $section.is( '.processing' ) ) {
				return false;
			}

			$section.addClass( 'processing' ).block({
				message: null,
				overlayCSS: {
					background: '#fff',
					opacity: 0.6
				}
			});

		    let data = {
		        action     : 'user_auth',
		        ajax_nonce : main_params.ajax_nonce,
		        form       : $('#ut_login_form').serialize(),
		    };

		    $.ajax({
		        url  : main_params.ajaxurl,
		        data : data,
		        type : 'POST',
		        beforeSend: function() {
					 
		        },
		        complete: function() {
		        	$section.removeClass( 'processing' ).unblock();
		        },
		        success: function( response ) {

		        	if ( response.success == false ) {

	        			$('#auth_error').hide();
		        		$('input').removeClass('error');
		                $('input[name="' + response.data.name_field + '"]').addClass('error');

		                if ( response.data.message ) {
		                	let message = response.data.message.replace(/<a\b[^>]*>(.*?)<\/a>/i,""); // without tag <a href=""></a>
		                	$('#auth_error').html( message ).show();
		                }

		            } else {
		                document.location.href = response.data.redirect_url;
		            }
		        }
		    });
	    });
	},

	forgot: function forgot() {

    	$('#ut_forgot_form').submit( function( e ) {
	    	e.preventDefault();
	    	let $section = $( '#ut_forgot_form' );

	    	if ( $section.is( '.processing' ) ) {
				return false;
			}

			$section.addClass( 'processing' ).block({
				message: null,
				overlayCSS: {
					background: '#fff',
					opacity: 0.6
				}
			});

		    let data = {
		        action     : 'user_forgot',
		        ajax_nonce : main_params.ajax_nonce,
		        form       : $('#ut_forgot_form').serialize(),
		    };

		    $.ajax({
		        url  : main_params.ajaxurl,
		        data : data,
		        type : 'POST',
		        beforeSend: function() {
					 
		        },
		        complete: function() {
		        	$section.removeClass( 'processing' ).unblock();
		        },
		        success: function( response ) {

		        	if ( response.success == false ) {

	        			$('#forgot_error').hide();
		        		$('input').removeClass('error');
		                $('input[name="' + response.data.name_field + '"]').addClass('error');

		                if ( response.data.message ) {
		                	let message = response.data.message.replace(/<a\b[^>]*>(.*?)<\/a>/i,""); // without tag <a href=""></a>
		                	$('#forgot_error').html( message ).show();
		                }

		            } else {
		                if ( response.data.message ) {
		                	let message = response.data.message.replace(/<a\b[^>]*>(.*?)<\/a>/i,""); // without tag <a href=""></a>
		                	$('#forgot_error').html( message ).show();
		                }
		            }
		        }
		    });
	    });
	},

	new_pass: function new_pass() {

    	$('#ut_new_pass_form').submit( function( e ) {
	    	e.preventDefault();
	    	let $section = $( '#ut_new_pass_form' );

	    	if ( $section.is( '.processing' ) ) {
				return false;
			}

			$section.addClass( 'processing' ).block({
				message: null,
				overlayCSS: {
					background: '#fff',
					opacity: 0.6
				}
			});

		    let data = {
		        action     : 'user_new_pass',
		        ajax_nonce : main_params.ajax_nonce,
		        form       : $('#ut_new_pass_form').serialize(),
		    };

		    $.ajax({
		        url  : main_params.ajaxurl,
		        data : data,
		        type : 'POST',
		        beforeSend: function() {
					 
		        },
		        complete: function() {
		        	$section.removeClass( 'processing' ).unblock();
		        },
		        success: function( response ) {

		        	if ( response.success == false ) {

	        			$('#new_pass_error').hide();
		        		$('input').removeClass('error');
		                $('input[name="' + response.data.name_field + '"]').addClass('error');

		                if ( response.data.message ) {
		                	let message = response.data.message.replace(/<a\b[^>]*>(.*?)<\/a>/i,""); // without tag <a href=""></a>
		                	$('#new_pass_error').html( message ).show();
		                }

		            } else {
		                if ( response.data.message ) {
		                	let message = response.data.message.replace(/<a\b[^>]*>(.*?)<\/a>/i,""); // without tag <a href=""></a>
		                	$('#new_pass_error').html( message ).show();
		                }
		            }
		        }
		    });
	    });
	},

	change_pass: function forgot() {

    	$('#ut_change_pass_form').submit( function( e ) {
	    	e.preventDefault();
			var form = $(this);
	    	var $section = form;

	    	if ( $section.is( '.processing' ) ) {
				return false;
			}

			$section.addClass( 'processing' ).block({
				message: null,
				overlayCSS: {
					background: '#fff',
					opacity: 0.6
				}
			});

		    let data = {
		        action     : 'user_change_pass',
		        ajax_nonce : main_params.ajax_nonce,
		        form       : form.serialize(),
		    };

		    $.ajax({
		        url  : main_params.ajaxurl,
		        data : data,
		        type : 'POST',
		        success: function( response ) {
		        	$('#change_pass_error').html( response.data.message );
					$section.removeClass( 'processing' ).unblock();
		        }
		    });
	    });
	},

};

$(document).ready( MAIN.init() ); 