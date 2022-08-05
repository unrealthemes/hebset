<?php
/**
 * Template name: Kilometer Statistics
 */
if(!is_user_logged_in()){
    wp_redirect( home_url('/login') );
}
get_header();

echo do_shortcode('[elementor-template id="951"]');

// $token = $_SESSION['yoshteq_token'] ?? null;
$token = get_user_meta( get_current_user_id(), 'user_yoshteq_token', true );
$earliest_year = 2000;
$selected_year = $_GET['_year'] ?? null;
if(!$selected_year){
    $selected_year = date('Y');
}
$statistics = ut_mileage( $token, $selected_year );
$balance = ut_balance( $token, $selected_year );

$response = array_reverse($statistics, true);

//print_r($balance);

$month_array = array(
    '1' => 'Januar',
    '2' => 'Februar',
    '3' => 'März',
    '4' => 'April',
    '5' => 'Mai',
    '6' => 'Juni',
    '7' => 'Juli',
    '8' => 'August',
    '9' => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Dezember',
);

$balance_array = array();
$sum_array = array();
foreach($balance as $invoice){
    $month = wp_date('n', strtotime($invoice['date']));
    /*$balance_array[$month]['invoiceNumber'] = $invoice['invoiceNumber'];
    $balance_array[$month]['revenue'] = $invoice['revenue'];
    $balance_array[$month]['expenses'] = $invoice['expenses'];
    $balance_array[$month]['mwst'] = $invoice['mwst'];*/
    if($balance_array[$month]['revenue'] != ''){
        $balance_array[$month]['revenue'] = $balance_array[$month]['revenue'] + (float)$invoice['revenue'];
    }else{
        $balance_array[$month]['revenue'] = (float)$invoice['revenue'];
    }
}
$css = '<style>.elementor.elementor-location-header{display:none}table,td,th{border:1px solid #81940a}td,th{padding:3px}table{width:100%;border-collapse:separate;border-spacing:0;text-align:center}</style>';
echo $css;
?>

    <div class="wrapper">
        <div class="page-title">
            <div class="container">
                <?php the_title( '<h1>', '</h1>' ); ?>

                <?php get_template_part('template-parts/personal-widget'); ?>
            </div>
        </div>

        <section class="customer-payouts">
            <div class="container">
				<span class="yearlabel"><img src="<?php bloginfo('template_url'); ?>/img/cal.svg">Jahr wählen</span>
                <select id="select_by_date">
                    <?php foreach ( range( date('Y'), $earliest_year ) as $x ) : ?>
                        <option value="<?php echo ut_get_permalik_by_template('template-kilometer-statistics.php') . '?_year=' . esc_attr( $x ); ?>" <?php selected( $selected_year, $x ); ?>>
                            <?php echo esc_html( $x ); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button id="print" style="float:right"><img src="<?php bloginfo('template_url'); ?>/img/printer.svg">Drucken</button>
            </div>
        </section>

        <div class="container customer-data__container">
            <table id="statistics-table">
                <tr>
                    <tr style="background: #A1B90A; color:white;">
                        <th rowspan="2" ></th>
                        <th colspan="3">Anzahl Kilometer</th>
                        <th colspan="3">Anzahl Pauschalen < 2km</th>
                        <th rowspan="2">Wegegeld [€]</th>
                    </tr>
                    <tr style="background: #A1B90A; color:white;">
                        <th>Tag</th>
                        <th>Nacht</th>
                        <th>Summe</th>
                        <th>Tag</th>
                        <th>Nacht</th>
                        <th>Summe</th>
                    </tr>
                </tr>
               <?php
                foreach($response as $month){
                    $sum_array['distanceDay'] += (float)$month['distanceDay'];
                    $sum_array['distanceNight'] += (float)$month['distanceNight'];
                    $sum_array['distanceSum'] += (float)$month['distanceSum'];
                    $sum_array['shortDistanceDayCount'] += (float)$month['shortDistanceDayCount'];
                    $sum_array['shortDistanceNightCount'] += (float)$month['shortDistanceNightCount'];
                    $sum_array['shortDistanceSum'] += (float)$month['shortDistanceSum'];
                    $sum_array['revenue'] += (float)$balance_array[$month['month']]['revenue'];
                    echo '<tr>
                    <td><b>'.$month_array[$month['month']].'</b></td>
                    <td>'.str_replace( ".", ",", $sum_array['distanceDay'] ).'</td>
                    <td>'.str_replace( ".", ",", $month['distanceNight'] ). '</td>
                    <td>'.str_replace( ".", ",", $sum_array['distanceSum'] ).'</td>
                    <td>'.$month['shortDistanceDayCount'].'</td>
                    <td>'.$month['shortDistanceNightCount'].'</td>
                    <td>'.$month['shortDistanceSum'].'</td>
                    <td>'.str_replace( ".", ",", $balance_array[$month['month']]['revenue'] ).'</td>
                  </tr>';
                }
                echo '<tr>
                        <td><b>Summe</b></td>
                        <td><b>'.str_replace( ".", ",", $sum_array['distanceDay'] ).'</b></td>
                        <td><b>'.str_replace( ".", ",", $sum_array['distanceNight'] ).'</b></td>
                        <td><b>'.str_replace( ".", ",", $sum_array['distanceSum'] ).'</b></td>
                        <td><b>'.str_replace( ".", ",", $sum_array['shortDistanceDayCount'] ).'</b></td>
                        <td><b>'.str_replace( ".", ",", $sum_array['shortDistanceNightCount'] ).'</b></td>
                        <td><b>'.str_replace( ".", ",", $sum_array['shortDistanceSum'] ).'</b></td>
                        <td><b>'.str_replace( ".", ",", $sum_array['revenue'] ).' €</b></td>
                      </tr>'
            ?>
            </table>
        </div>

        <script>
            const buttonPrint = document.getElementById('print');
            buttonPrint.addEventListener('click', () => {
                let prtContent = document.getElementById('statistics-table');
                let WinPrint = window.open('','','left=50,top=50,width=800,height=640,toolbar=0,scrollbars=1,status=0');
                let cssContent = '<?= $css ?>';
                WinPrint.document.write('<div id="print" class="contentpane">');
                WinPrint.document.write(cssContent);
                WinPrint.document.write(prtContent.outerHTML);
                WinPrint.document.write('</div>');
                WinPrint.document.close();
                WinPrint.focus();
                WinPrint.print();
                WinPrint.close();
            });
        </script>
    </div>

<?php get_footer();