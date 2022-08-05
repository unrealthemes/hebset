<?php
/**
 * Template name: Midwive Statistics
 */

get_header();

echo do_shortcode('[elementor-template id="951"]');

// $token = $_SESSION['yoshteq_token'] ?? null;
$token = get_user_meta( get_current_user_id(), 'user_yoshteq_token', true );
$earliest_year = 2000;
$selected_year = $_GET['_year'] ?? null;
$statistics = ut_statistics( $token, $selected_year );

$pr_items = [];
$st_items = [];
foreach ( (array)$statistics as $key => $statistic ) {
    foreach ( (array)$statistic['privateServices'] as $prservice ) {

        if ( array_key_exists($prservice['serviceNumber'], $pr_items) ) {
            $pr_items[ $prservice['serviceNumber'] ]['amount'] = $pr_items[ $prservice['serviceNumber'] ]['amount'] + $prservice['amount'];
            $pr_items[ $prservice['serviceNumber'] ]['quantity'] = $pr_items[ $prservice['serviceNumber'] ]['quantity'] + $prservice['quantity'];
        } else {
            $pr_items[ $prservice['serviceNumber'] ] = [
                'amount' => $prservice['amount'],
                'description' => $prservice['description'],
                'quantity' => $prservice['quantity'],
                'serviceNumber' => $prservice['serviceNumber'],
            ];
        }
    }  
    foreach ( (array)$statistic['statutoryServices'] as $prservice ) {

        if ( array_key_exists($prservice['serviceNumber'], $st_items) ) {
            $st_items[ $prservice['serviceNumber'] ]['amount'] = $st_items[ $prservice['serviceNumber'] ]['amount'] + $prservice['amount'];
            $st_items[ $prservice['serviceNumber'] ]['quantity'] = $st_items[ $prservice['serviceNumber'] ]['quantity'] + $prservice['quantity'];
        } else {
            $st_items[ $prservice['serviceNumber'] ] = [
                'amount' => $prservice['amount'],
                'description' => $prservice['description'],
                'quantity' => $prservice['quantity'],
                'serviceNumber' => $prservice['serviceNumber'],
            ];
        }
    }  
}
?>

    <style>
        .elementor.elementor-location-header {
            display: none;
        }
    </style>

    <?php while ( have_posts() ) : the_post(); ?>

        <div class="wrapper">

            <div class="page-title">
                <div class="container">
                    <?php the_title( '<h1>', '</h1>' ); ?>

                    <?php get_template_part('template-parts/personal-widget'); ?>
                </div>
            </div>

            <section class="customer-payouts">
			
                <div class="container">
						<h2 class="section-headline">
							Jahresaufstellung
						</h2>
						<div class="divider">&nbsp;</div>
					<span class="yearlabel"><img src="<?php bloginfo('template_url'); ?>/img/cal.svg">Jahr wählen</span>
                    <select id="select_by_date">
                        <?php foreach ( range( date('Y'), $earliest_year ) as $x ) : ?>
                            <option value="<?php echo ut_get_permalik_by_template('template-statistics.php') . '?_year=' . esc_attr( $x ); ?>" <?php selected( $selected_year, $x ); ?>>
                                <?php echo esc_html( $x ); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </section>

            <?php if ( $statistics ) : ?>

                <div class="statistic_wrapper">
                    <section class="customer-payouts">
                        <div class="container">
                            <h2>Private Leistungen</h2>

                            <div id="chart_private_services"></div>
                            <style>
                                #chart_private_services {
                                  width: 100%;
                                  height: 500px;
                                }
                            </style>

                            <div class="table-container">
                                <table id="payouts__table" class="display nowrap DataTableJs tbl_statistiken" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Betrag</th>
                                        <th>Beschreibung</th>
                                        <th>Menge</th>
                                        <th>Service Nummer</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                        <?php foreach ( (array)$pr_items as $pr_item ) : ?>

                                            <tr>
                                                <td><?php echo str_replace( ".", ",", wc_price( $pr_item['amount'] ) ); ?></td>
                                                <!-- <td><?php // echo wc_price( $pr_item['amount'] ); ?></td> -->
                                                <td><?php echo $pr_item['description']; ?></td>
                                                <td><?php echo $pr_item['quantity']; ?></td>
                                                <td><?php echo $pr_item['serviceNumber']; ?></td>
                                            </tr>

                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                    <section class="customer-payouts">
                        <div class="container">
                            <h2>Gesetzliche Leistungen</h2>

                            <div id="chart_statutory_services"></div>
                            <style>
                                #chart_statutory_services {
                                  width: 100%;
                                  height: 500px;
                                }
                            </style>

                            <div class="table-container">
                                <table id="payouts__table" class="display nowrap DataTableJs tbl_statistiken" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Betrag</th>
                                        <th>Beschreibung</th>
                                        <th>Menge</th>
                                        <th>Service Nummer</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                        <?php foreach ( (array)$st_items as $st_item ) : ?>

                                            <tr>
                                                <td><?php echo str_replace( ".", ",", wc_price( $st_item['amount'] ) ); ?></td>
                                                <!-- <td><?php // echo wc_price( $st_item['amount'] ); ?></td> -->
                                                <td><?php echo $st_item['description']; ?></td>
                                                <td><?php echo $st_item['quantity']; ?></td>
                                                <td><?php echo $st_item['serviceNumber']; ?></td>
                                            </tr>

                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- ------------------------------------------------------------------------------------------- -->
			
			
			</div>
			
                <style>
                    .section-show {
                        display: block;
                    }
                    .section-hide {
                        display: none;
                    }
                </style>

                <section class="customer-payouts">
                    <div class="container">
						<h2 class="section-headline">
							Monatsaufstellung
						</h2>
						<div class="divider">&nbsp;</div>
						<span class="yearlabel"><img src="<?php bloginfo('template_url'); ?>/img/cal.svg">Monat wählen</span>
                        <select id="select_by_month">
                            <?php foreach ( (array)$statistics as $key => $statistic ) : ?>
                                <option value="<?php echo $statistic['description']; ?>">
                                    <?php echo $statistic['description']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </section>

                <?php foreach ( (array)$statistics as $key => $statistic ) : ?>

                    <?php $class = ( $key == 0 ) ? 'section-show' : 'section-hide'; ?>

                    <div id="<?php echo $statistic['description']; ?>" class="statistic_wrapper month_wrapper <?php echo $class; ?>">

                        <?php if ( ! empty( $statistic['privateServices'] ) ) : ?>

                            <section class="customer-payouts">
                                <div class="container">
                                    <h2>Private Leistungen</h2>
                                    <div class="table-container">
                                        <table id="payouts__table" class="display nowrap DataTableJs tbl_statistiken" style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>Betrag</th>
                                                <th>Beschreibung</th>
                                                <th>Menge</th>
                                                <th>Service Nummer</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                                <?php foreach ( (array)$statistic['privateServices'] as $private_service ) : ?>

                                                    <tr>
                                                        <td><?php echo str_replace( ".", ",", wc_price( $private_service['amount'] ) ); ?></td>
                                                        <!-- <td><?php // echo wc_price( $private_service['amount'] ); ?></td> -->
                                                        <td><?php echo $private_service['description']; ?></td>
                                                        <td><?php echo $private_service['quantity']; ?></td>
                                                        <td><?php echo $private_service['serviceNumber']; ?></td>
                                                    </tr>

                                                <?php endforeach; ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </section>

                        <?php endif; ?>

                        <?php if ( ! empty( $statistic['statutoryServices'] ) ) : ?>

                            <section class="customer-payouts">
                                <div class="container">
                                    <h2>Gesetzliche Leistungen</h2>
                                    <div class="table-container">
                                        <table id="payouts__table" class="display nowrap DataTableJs tbl_statistiken" style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>Betrag</th>
                                                <th>Beschreibung</th>
                                                <th>Menge</th>
                                                <th>Service Nummer</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                                <?php foreach ( (array)$statistic['statutoryServices'] as $statutory_service ) : ?>

                                                    <tr>
                                                        <td><?php echo str_replace( ".", ",", wc_price( $statutory_service['amount'] ) ); ?></td>
                                                        <!-- <td><?php // echo wc_price( $statutory_service['amount'] ); ?></td> -->
                                                        <td><?php echo $statutory_service['description']; ?></td>
                                                        <td><?php echo $statutory_service['quantity']; ?></td>
                                                        <td><?php echo $statutory_service['serviceNumber']; ?></td>
                                                    </tr>

                                                <?php endforeach; ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </section>

                        <?php endif; ?>

                    </div>

                <?php endforeach; ?>

            <?php else : ?>

                <div class="container">
                    <h4 class="infobox"><img src="<?php bloginfo('template_url'); ?>/img/info.svg"> Keine Daten vorhanden im gewählten Jahr</h4>
                </div>

            <?php endif; ?>

        </div>
      
    <?php endwhile; // End of the loop. ?>

<?php
get_footer();