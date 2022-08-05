var minDate, maxDate;
// Custom filtering function which will search data in column four between two values
$.fn.dataTable.ext.search.push(

    function( settings, data, dataIndex ) {

        if ( !$('#min').length && !$('#max').length ) {
            return true;
        }

        var min = minDate.val();
        var max = maxDate.val();

        if ( $('.tbl_invoices').length ) {
            var string_date = data[4];
        } else if ( $('.tbl_payouts').length ) {
            var string_date = data[2];
        } else if ( $('.tbl_hebset_rechnungen').length ) {
            var string_date = data[3];
        }

        // change date format from 'DD.MM.YYYY' to 'Y.M.D'
        var arr_date = string_date.split('.');
        var format_date = '"' + arr_date[2] + '.' + arr_date[1] + '.' + arr_date[0] + '"';
        var date = new Date( format_date );

        if (
            ( min === null && max === null ) ||
            ( min === null && date <= max ) ||
            ( min <= date  && max === null ) ||
            ( min <= date  && date <= max )
        ) {
            return true;
        }

        return false;
    }
);



jQuery(document).ready(function () {

    $('#select_by_month').on( 'change', function( e ) {
        var val = $(this).val();
        $('.month_wrapper').removeClass('section-show').addClass('section-hide');
        $( '#' + val + '.month_wrapper').removeClass('section-hide').addClass('section-show');
    });

    $('#select_by_date').on( 'change', function( e ) {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
    });   
    //

    let wrapper = $('.wrapper');
    let headerBottom = $('.header-bottom');

    $(window).scroll(function() {

        let headerTopHeight = $('.header-top').height();
        let headerBottomHeight = $('.header-bottom').height();

        if($(this).scrollTop() > headerTopHeight) {
            headerBottom.addClass('header-bottom_fixed');
            wrapper.css('padding-top', headerBottomHeight + 'px');
        } else {
            headerBottom.removeClass('header-bottom_fixed');
            wrapper.css('padding-top', '0');
        }
    });



    $('.hamburger').click(function () {

        $(this).toggleClass('open');
        $('.header-bottom__nav-mobile').toggleClass('open').slideToggle();
    });



    $('#payouts__table input[type="checkbox"]').click(function () {

        if ($(this).parents('thead').length){

            var allCheck = $('#payouts__table tbody input[type="checkbox"]');

            if (this.checked){
                allCheck.prop('checked', true);
            } else {
                allCheck.prop('checked', false);
            }

        } else {
            $('#payouts__table thead input[type="checkbox"]').prop('checked', false)
        }
    });

    // sort in table
    // $("#payouts__table").tablesorter({headers: {0: {sorter: false}}});

    init_data_table( '.tbl_invoices', [ 0, 9 ] );
    init_data_table( '.tbl_payouts', [ 0, 4 ] );
    init_data_table( '.tbl_hebset_invoices', [ 0, 4 ] );
    init_data_table( '.tbl_hebset_rechnungen', [ 0, 4 ] );
    init_data_table( '.tbl_sicherstellungszuschlag', [ 0, 1 ] );
    init_data_table( '.tbl_statistiken', [ ] );


    function init_data_table( tbl_selector, targets ) {

        var table = $( tbl_selector ).DataTable( {
            
            // initComplete: function () {

            //     if ( tbl_selector == '.tbl_invoices' ) {

            //         this.api().columns( [1] ).every( function () {
            //             var column = this;
            //             var select = $('<select class="date-select"><option value="">Datum</option></select>&nbsp;')
            //                 .prependTo( $('#payouts__table_length') )
            //                 .on( 'change', function () {
            //                     var val = $.fn.dataTable.util.escapeRegex(
            //                         $(this).val()
            //                     );
        
            //                     column
            //                         .search( val ? '^'+val+'$' : '', true, false )
            //                         .draw();
            //                 } );
        
            //             column.data().unique().sort().each( function ( d, j ) {
            //                 select.append( '<option value="'+d+'">'+d+'</option>' )
            //             } );
            //         } );

            //     } else if ( tbl_selector == '.tbl_hebset_rechnungen' ) {

            //         this.api().columns( [3] ).every( function () {
            //             var column = this;
            //             var select = $('<select class="date-select"><option value="">Datum</option></select>&nbsp;')
            //                 .prependTo( $('#payouts__table_length') )
            //                 .on( 'change', function () {
            //                     var val = $.fn.dataTable.util.escapeRegex(
            //                         $(this).val()
            //                     );
        
            //                     column
            //                         .search( val ? '^'+val+'$' : '', true, false )
            //                         .draw();
            //                 } );
        
            //             column.data().unique().sort().each( function ( d, j ) {
            //                 select.append( '<option value="'+d+'">'+d+'</option>' )
            //             } );
            //         } );

            //     } else if ( tbl_selector == '.tbl_payouts' ) {

            //         this.api().columns( [2,3] ).every( function (i) {
            //             var column = this;
            //             var select_name = ( i == 2 ) ? 'Datum ab' : 'Datum bis';
            //             var select = $('<select class="date-select"><option value="">' + select_name + '</option></select>&nbsp;')
            //                 .prependTo( $('#payouts__table_length') );

            //             select.on( 'change', function () {
            //                 var val = $.fn.dataTable.util.escapeRegex(
            //                     $(this).val()
            //                 );
    
            //                 column
            //                     .search( val ? '^'+val+'$' : '', true, false )
            //                     .draw();
            //             } );
        
            //             column.data().unique().sort().each( function ( d, j ) {
            //                 select.append( '<option value="'+d+'">'+d+'</option>' )
            //             } );
            //         } );

            //     }
            // },
            language: {
                url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/de_de.json'
            },
            columnDefs: [{
                orderable: false,
                targets: targets
            }],
            // "pageLength": 20,
            "lengthMenu": [ 20, 40, 60 ],
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            responsive: true
        } );




        // Create date inputs
        minDate = new DateTime( $('#min'), {
            // format: 'YYYY/M/D '
            format: 'DD.MM.YYYY'
        });
        maxDate = new DateTime( $('#max'), {
            // format: 'YYYY/M/D'
            format: 'DD.MM.YYYY'
        });
        // Refilter the table
        $('#min, #max').on('change', function() {
            table.draw();
        });




    }
})





//// Функция определения поддержки формата Webp
function testWebP(callback) {
    var webP = new Image();
    webP.onload = webP.onerror = function () {

        callback(webP.height == 2);
    };

    webP.src = "data:image/webp;base64,UklGRjoAAABXRUJQVlA4IC4AAACyAgCdASoCAAIALmk0mk0iIiIiIgBoSygABc6WWgAA/veff/0PP8bA//LwYAAA";
}



testWebP(function (support) {

    if (support == true) {
        document.querySelector('body').classList.add('webp');
    } else {
        document.querySelector('body').classList.add('no-webp');
    }

});

