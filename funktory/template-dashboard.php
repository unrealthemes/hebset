<?php
/**
 * Template name: Midwive Dashboard
 */

get_header();

echo do_shortcode('[elementor-template id="951"]');
?>

    <style>
        .elementor.elementor-location-header {
            display: none;
        }
    </style>

    <div class="wrapper">
        <div class="page-title">
            <div class="container">
                <?php the_title( '<h1>', '</h1>' ); ?>

                <?php get_template_part('template-parts/personal-widget'); ?>
            </div>
        </div>

        <section class="customer-menu">
            <div class="container">
                <ul>
                    <li>
                        <a href="<?php echo ut_get_permalik_by_template('template-profile.php'); ?>">
                            <div class="customer-menu__item-image">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="76" height="76" x="0" y="0" viewBox="0 0 128 128"><g><g xmlns="http://www.w3.org/2000/svg"><path d="m107.662 26.708h-86.875a12.827 12.827 0 0 0 -12.812 12.813v48.958a12.827 12.827 0 0 0 12.812 12.813h86.875a12.828 12.828 0 0 0 12.813-12.813v-48.958a12.828 12.828 0 0 0 -12.813-12.813zm9.313 61.771a9.324 9.324 0 0 1 -9.313 9.313h-86.875a9.323 9.323 0 0 1 -9.312-9.313v-48.958a9.323 9.323 0 0 1 9.312-9.313h86.875a9.324 9.324 0 0 1 9.313 9.313z" fill="#a0b90a" data-original="#000000" style=""></path><path d="m42.956 62.529h-4.956a16.643 16.643 0 0 0 -16.622 16.625v8.163a1.75 1.75 0 0 0 1.75 1.75h34.7a1.75 1.75 0 0 0 1.75-1.75v-8.163a16.644 16.644 0 0 0 -16.622-16.625zm13.125 23.038h-31.2v-6.413a13.14 13.14 0 0 1 13.119-13.125h4.954a13.14 13.14 0 0 1 13.127 13.125z" fill="#a0b90a" data-original="#000000" style=""></path><path d="m40.479 60.681a11.549 11.549 0 1 0 -11.549-11.549 11.562 11.562 0 0 0 11.549 11.549zm0-19.6a8.049 8.049 0 1 1 -8.049 8.049 8.058 8.058 0 0 1 8.049-8.047z" fill="#a0b90a" data-original="#000000" style=""></path><path d="m77.314 45.582h21.962a1.75 1.75 0 0 0 0-3.5h-21.962a1.75 1.75 0 0 0 0 3.5z" fill="#a0b90a" data-original="#000000" style=""></path><path d="m104.979 56h-32.254a1.75 1.75 0 0 0 0 3.5h32.254a1.75 1.75 0 0 0 0-3.5z" fill="#a0b90a" data-original="#000000" style=""></path><path d="m104.979 66.543h-32.254a1.75 1.75 0 0 0 0 3.5h32.254a1.75 1.75 0 0 0 0-3.5z" fill="#a0b90a" data-original="#000000" style=""></path><path d="m104.979 77.087h-32.254a1.75 1.75 0 0 0 0 3.5h32.254a1.75 1.75 0 0 0 0-3.5z" fill="#a0b90a" data-original="#000000" style=""></path></g></g></svg>
                            </div>
                            <div class="customer-menu__item-content">
                                <div class="item-content__title"><?php echo ut_get_title_by_template('template-profile.php'); ?></div>
                                <div class="item-content__desc"><?php echo ut_get_subtitle_by_template('template-profile.php'); ?></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="/kundenbereich/ansprechpartner/">
                            <div class="customer-menu__item-image">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="55" height="55" x="0" y="0" viewBox="0 0 511.874 511.874"><g><g xmlns="http://www.w3.org/2000/svg"><path d="M490.114,12.813H132.568c-12.012,0.014-21.746,9.748-21.76,21.76v98.62l-16.35-24.525     c-7.484-11.289-22.535-14.676-34.133-7.68l-33.638,20.224c-11.016,6.464-19.097,16.946-22.545,29.244     c-12.271,44.681-3.166,121.66,109.824,234.667C203.821,474.885,270.816,499.06,316.99,499.06     c10.69,0.049,21.339-1.34,31.659-4.13c12.293-3.448,22.775-11.518,29.252-22.519l20.198-33.673     c6.968-11.589,3.584-26.609-7.68-34.091l-80.546-53.692c-11.049-7.308-25.859-4.905-34.031,5.521l-23.45,30.148     c-2.451,3.226-6.897,4.166-10.445,2.21l-4.463-2.458c-14.686-8.004-32.964-17.971-69.879-54.886     c-3.994-3.994-7.612-7.731-11.008-11.307h333.517c11.982,0.009,21.713-9.676,21.76-21.658V34.573     C511.86,22.561,502.126,12.827,490.114,12.813z M229.318,401.362l4.335,2.381c10.897,6.093,24.614,3.266,32.213-6.639     l23.45-30.148c2.666-3.396,7.49-4.179,11.093-1.801l80.546,53.692c3.659,2.439,4.759,7.321,2.5,11.093l-20.198,33.673     c-4.218,7.233-11.071,12.553-19.123,14.848c-40.337,11.093-110.933,1.707-218.078-105.446S9.56,195.273,20.627,154.97     c2.293-8.051,7.61-14.903,14.839-19.123l33.673-20.207c3.773-2.254,8.652-1.155,11.093,2.5l53.717,80.546     c2.382,3.602,1.599,8.43-1.801,11.093l-30.157,23.458c-9.903,7.597-12.731,21.311-6.639,32.205l2.389,4.335     c8.533,15.65,19.14,35.123,57.805,73.779C194.212,382.213,213.677,392.828,229.318,401.362z M494.808,298.526     c-0.028,2.567-2.127,4.627-4.693,4.608H141.203c-11.083-12.674-20.64-26.604-28.476-41.506l-2.458-4.48     c-1.96-3.54-1.022-7.982,2.202-10.428l30.157-23.458c10.43-8.17,12.833-22.982,5.521-34.031l-20.275-30.43V34.573     c-0.014-1.249,0.476-2.451,1.359-3.334c0.883-0.883,2.085-1.373,3.334-1.359h357.547c1.249-0.014,2.451,0.476,3.334,1.359     c0.883,0.883,1.373,2.085,1.359,3.334V298.526z" fill="#a0b90a" data-original="#000000" style="" class=""></path><path d="M460.725,52.323l-142.618,108.16c-4.035,2.932-9.499,2.932-13.534,0L162.008,52.323     c-3.756-2.849-9.111-2.113-11.959,1.643c-2.849,3.756-2.113,9.111,1.643,11.959l142.583,108.151     c10.144,7.494,23.989,7.494,34.133,0L471.034,65.925c1.805-1.368,2.992-3.398,3.299-5.642c0.307-2.244-0.29-4.518-1.661-6.321     C469.824,50.213,464.478,49.48,460.725,52.323z" fill="#a0b90a" data-original="#000000" style="" class=""></path><path d="M238.517,174.793l-87.415,93.611c-3.214,3.447-3.025,8.848,0.422,12.062c3.447,3.214,8.848,3.025,12.062-0.422     l87.416-93.653c2.888-3.484,2.553-8.617-0.762-11.698C246.924,171.612,241.78,171.656,238.517,174.793z" fill="#a0b90a" data-original="#000000" style="" class=""></path><path d="M384.728,174.793c-3.214-3.447-8.614-3.637-12.062-0.422c-3.447,3.214-3.637,8.614-0.422,12.062l87.39,93.611     c3.214,3.447,8.614,3.637,12.062,0.422c3.447-3.214,3.637-8.614,0.422-12.062L384.728,174.793z" fill="#a0b90a" data-original="#000000" style="" class=""></path></g></g></svg>
                            </div>
                            <div class="customer-menu__item-content">
                                <div class="item-content__title">Kundenbetreuerin</div>
                                <div class="item-content__desc">Sie haben Fragen? Wir helfen Ihnen gerne weiter!</div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo ut_get_permalik_by_template('template-invoices.php'); ?>">
                            <div class="customer-menu__item-image">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="58" height="58" x="0" y="0" viewBox="0 0 64 64" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path xmlns="http://www.w3.org/2000/svg" d="m61 23h-3v-13a1 1 0 0 0 -1-1h-6.84l-7.49-6.74a.971.971 0 0 0 -.67-.26h-28a1 1 0 0 0 -1 1v6h-6a1 1 0 0 0 -1 1v5h-3a1 1 0 0 0 -1 1v39a1 1 0 0 0 1 1h19.22l-1.19 4.76a1.022 1.022 0 0 0 .18.86 1 1 0 0 0 .79.38h20a1 1 0 0 0 .79-.38 1.022 1.022 0 0 0 .18-.86l-1.19-4.76h19.22a1 1 0 0 0 1-1v-31a1 1 0 0 0 -1-1zm-5-12v12h-3v-11a1 1 0 0 0 -.33-.74l-.29-.26zm-13-5.75 6.39 5.75h-6.39zm-28-1.25h26v8a1 1 0 0 0 1 1h9v10h-25.38l-3.73-7.45a.988.988 0 0 0 -.89-.55h-6zm-7 7h5v4h-5zm15.28 49 3.69-14.76a1.022 1.022 0 0 0 -.18-.86 1 1 0 0 0 -.79-.38h-6.78l12.78-14.49 12.78 14.49h-6.78a1 1 0 0 0 -.79.38 1.022 1.022 0 0 0 -.18.86l3.69 14.76zm36.72-6h-18.72l-2-8h7.72a1 1 0 0 0 .75-1.66l-15-17a1.033 1.033 0 0 0 -1.5 0l-15 17a1 1 0 0 0 .75 1.66h7.72l-2 8h-18.72v-37h16.38l3.73 7.45a.988.988 0 0 0 .89.55h35z" fill="#a0b90a" data-original="#000000" style="" class=""></path><path xmlns="http://www.w3.org/2000/svg" d="m18 7h5v2h-5z" fill="#a0b90a" data-original="#000000" style="" class=""></path><path xmlns="http://www.w3.org/2000/svg" d="m26 7h11v2h-11z" fill="#a0b90a" data-original="#000000" style="" class=""></path><path xmlns="http://www.w3.org/2000/svg" d="m18 11h19v2h-19z" fill="#a0b90a" data-original="#000000" style="" class=""></path><path xmlns="http://www.w3.org/2000/svg" d="m27 15h21v2h-21z" fill="#a0b90a" data-original="#000000" style="" class=""></path><path xmlns="http://www.w3.org/2000/svg" d="m27 19h21v2h-21z" fill="#a0b90a" data-original="#000000" style="" class=""></path></g></svg>                    </div>
                            <div class="customer-menu__item-content">
                                <div class="item-content__title"><?php echo ut_get_title_by_template('template-invoices.php'); ?></div>
                                <div class="item-content__desc"><?php echo ut_get_subtitle_by_template('template-invoices.php'); ?></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo ut_get_permalik_by_template('template-sicherstellungszuschlag.php'); ?>"> 
                            <div class="customer-menu__item-image">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="58" height="58" x="0" y="0" viewBox="0 0 511.999 511.999" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><g xmlns="http://www.w3.org/2000/svg"><path d="m467.117 88.631-208-88c-1.992-.842-4.241-.842-6.234 0l-208 88c-2.96 1.253-4.883 4.155-4.883 7.369v126.377c0 131.64 85.328 249.787 213.647 289.27 1.534.471 3.169.472 4.705 0 125.819-38.714 213.648-155.014 213.648-289.271v-126.376c0-3.214-1.923-6.116-4.883-7.369zm-11.117 133.745c0 125.813-80.262 235.308-200 273.242-119.738-37.934-200-147.428-200-273.242v-121.075l200-84.615 200 84.615z" fill="#a0b90a" data-original="#000000" style="" class=""></path><path d="m223.03 314.343c9.381 9.38 24.561 9.379 33.94 0l104.687-104.687c9.735-9.736 9.735-25.578 0-35.314-9.736-9.734-25.578-9.734-35.314 0l-86.343 86.344-38.343-38.344c-9.736-9.734-25.577-9.734-35.313 0-9.759 9.758-9.76 25.556 0 35.314zm-45.374-80.686c3.497-3.497 9.189-3.498 12.687 0l44 44c3.124 3.123 8.189 3.123 11.313 0l92.001-92c1.693-1.694 3.946-2.627 6.343-2.627 7.972 0 11.957 9.7 6.343 15.313l-104.687 104.686c-3.119 3.119-8.194 3.119-11.313 0l-56.687-56.687c-3.505-3.506-3.506-9.179 0-12.685z" fill="#a0b90a" data-original="#000000" style="" class=""></path><path d="m252.717 48.705-160 72c-2.871 1.291-4.717 4.146-4.717 7.295v102.483c0 104.788 66.452 198.451 165.357 233.067 1.818.637 3.811.597 5.614-.123l9.805-3.923c93.799-37.519 155.224-128.25 155.224-229.268v-102.236c0-3.148-1.847-6.004-4.717-7.295l-160-72c-2.089-.94-4.48-.94-6.566 0zm155.283 84.467v97.063c0 94.978-56.98 179.14-145.166 214.413l-6.995 2.799c-90.947-33.149-151.839-119.958-151.839-216.964v-97.311l152-68.4z" fill="#a0b90a" data-original="#000000" style="" class=""></path></g></g></svg>                    </div>
                            <div class="customer-menu__item-content">
                                <div class="item-content__title"><?php echo ut_get_title_by_template('template-sicherstellungszuschlag.php'); ?></div>
                                <div class="item-content__desc"><?php echo ut_get_subtitle_by_template('template-sicherstellungszuschlag.php'); ?></div>
								
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo ut_get_permalik_by_template('template-payouts.php'); ?>">
                            <div class="customer-menu__item-image">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="58" height="58" x="0" y="0" viewBox="0 0 64 64" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path xmlns="http://www.w3.org/2000/svg" d="m61 23h-3v-13a1 1 0 0 0 -1-1h-6.84l-7.49-6.74a.971.971 0 0 0 -.67-.26h-28a1 1 0 0 0 -1 1v6h-6a1 1 0 0 0 -1 1v5h-3a1 1 0 0 0 -1 1v39a1 1 0 0 0 1 1h23.25l5 5.66a1 1 0 0 0 1.5 0l5-5.66h23.25a1 1 0 0 0 1-1v-31a1 1 0 0 0 -1-1zm-5-12v12h-3v-11a1 1 0 0 0 -.33-.74l-.29-.26zm-13-5.75 6.39 5.75h-6.39zm-28-1.25h26v8a1 1 0 0 0 1 1h9v10h-25.38l-3.73-7.45a.988.988 0 0 0 -.89-.55h-6zm-7 7h5v4h-5zm24 48.49-12.78-14.49h6.78a1 1 0 0 0 .79-.38 1.022 1.022 0 0 0 .18-.86l-3.69-14.76h17.44l-3.69 14.76a1.022 1.022 0 0 0 .18.86 1 1 0 0 0 .79.38h6.78zm28-5.49h-20.49l8.24-9.34a1 1 0 0 0 -.75-1.66h-7.72l3.69-14.76a1.022 1.022 0 0 0 -.18-.86 1 1 0 0 0 -.79-.38h-20a1 1 0 0 0 -.79.38 1.022 1.022 0 0 0 -.18.86l3.69 14.76h-7.72a1 1 0 0 0 -.75 1.66l8.24 9.34h-20.49v-37h16.38l3.73 7.45a.988.988 0 0 0 .89.55h35z" fill="#a0b90a" data-original="#000000" style=""></path><path xmlns="http://www.w3.org/2000/svg" d="m18 7h5v2h-5z" fill="#a0b90a" data-original="#000000" style=""></path><path xmlns="http://www.w3.org/2000/svg" d="m26 7h11v2h-11z" fill="#a0b90a" data-original="#000000" style=""></path><path xmlns="http://www.w3.org/2000/svg" d="m18 11h19v2h-19z" fill="#a0b90a" data-original="#000000" style=""></path><path xmlns="http://www.w3.org/2000/svg" d="m27 15h21v2h-21z" fill="#a0b90a" data-original="#000000" style=""></path><path xmlns="http://www.w3.org/2000/svg" d="m27 19h21v2h-21z" fill="#a0b90a" data-original="#000000" style=""></path></g></svg>                    </div>
                            <div class="customer-menu__item-content">
                                <div class="item-content__title"><?php echo ut_get_title_by_template('template-payouts.php'); ?></div>
                                <div class="item-content__desc"><?php echo ut_get_subtitle_by_template('template-payouts.php'); ?></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo ut_get_permalik_by_template('template-statistics.php'); ?>">
                            <div class="customer-menu__item-image">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="58" height="58" x="0" y="0" viewBox="0 0 480.252 480.252" style="enable-background:new 0 0 512 512" xml:space="preserve"><g><g xmlns="http://www.w3.org/2000/svg"><path d="M456.126,464.252v-296c0-4.418-3.582-8-8-8h-80c-4.418,0-8,3.582-8,8v296h-16v-184c0-4.418-3.582-8-8-8h-80     c-4.418,0-8,3.582-8,8v184h-16v-264c0-4.418-3.582-8-8-8h-80c-4.418,0-8,3.582-8,8v264h-16v-152c0-4.418-3.582-8-8-8h-80     c-4.418,0-8,3.582-8,8v152h-24v16h480v-16H456.126z M104.126,464.252h-64v-144h64V464.252z M216.126,464.252h-64v-256h64V464.252     z M328.126,464.252h-64v-176h64V464.252z M440.126,464.252h-64v-288h64V464.252z" fill="#a0b90a" data-original="#000000" style=""></path><path d="M50.065,217.62c6.544,4.326,14.216,6.633,22.061,6.632c22.091-0.001,39.999-17.91,39.998-40.002     c0-7.842-2.306-15.512-6.63-22.054l56.624-56.632c6.49,4.343,14.119,6.67,21.928,6.688c2.355,0.001,4.705-0.205,7.024-0.616     c7.611-1.334,14.667-4.86,20.304-10.144l47.464,36.488c-7.922,20.622,2.373,43.762,22.995,51.684     c20.622,7.922,43.762-2.373,51.684-22.995c4.646-12.094,3.147-25.689-4.023-36.481l56.608-56.608     c18.477,12.23,43.37,7.165,55.599-11.312c12.23-18.477,7.165-43.37-11.312-55.599c-18.477-12.23-43.37-7.165-55.599,11.312     c-8.886,13.425-8.886,30.862,0,44.287l-56.608,56.608c-15.855-10.48-36.895-8.357-50.336,5.08     c-0.152,0.152-0.24,0.328-0.384,0.472l-46.776-35.952c8.985-20.182-0.092-43.826-20.274-52.811     c-20.182-8.985-43.826,0.092-52.811,20.274c-5.557,12.483-4.358,26.94,3.181,38.336l-56.6,56.608     c-18.429-12.183-43.244-7.119-55.427,11.31C26.573,180.622,31.636,205.437,50.065,217.62z M408.126,16.252     c13.255,0,24,10.745,24,24s-10.745,24-24,24s-24-10.745-24-24S394.871,16.252,408.126,16.252z M279.147,135.287     c4.502-4.505,10.61-7.036,16.979-7.035c13.255-0.002,24.001,10.742,24.003,23.997c0.001,6.369-2.53,12.477-7.035,16.979     c-9.5,9.055-24.436,9.055-33.936,0C269.782,159.858,269.778,144.662,279.147,135.287z M164.468,58.487     c0.001-0.001,0.001-0.002,0.002-0.003c3.638-5.226,9.214-8.781,15.488-9.872c1.393-0.239,2.803-0.359,4.216-0.36     c4.911,0.005,9.701,1.522,13.72,4.344c10.857,7.604,13.495,22.569,5.891,33.426s-22.569,13.494-33.426,5.891     C159.502,84.309,156.864,69.344,164.468,58.487z M55.147,167.287c0.004-0.004,0.007-0.007,0.011-0.011     c9.376-9.371,24.573-9.368,33.944,0.008c9.371,9.376,9.368,24.573-0.008,33.944c-9.5,9.055-24.436,9.055-33.936,0     C45.782,191.858,45.778,176.662,55.147,167.287z" fill="#a0b90a" data-original="#000000" style=""></path></g></g></svg>
                            </div>
                            <div class="customer-menu__item-content">
                                <div class="item-content__title"><?php echo ut_get_title_by_template('template-statistics.php'); ?></div>
                                <div class="item-content__desc"><?php echo ut_get_subtitle_by_template('template-statistics.php'); ?></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo ut_get_permalik_by_template('template-hebset-invoices.php'); ?>">
                            <div class="customer-menu__item-image">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="58" height="58" x="0" y="0" viewBox="0 0 432 432.00768" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path xmlns="http://www.w3.org/2000/svg" d="m82.003906 158.003906c0 3.3125 2.6875 6 6 6h14.789063c5.972656 16.234375 18.207031 29.398438 33.964843 36.535156 15.753907 7.140626 33.714844 7.664063 49.859376 1.449219 3.09375-1.191406 4.636718-4.664062 3.445312-7.757812s-4.664062-4.632813-7.757812-3.445313c-25.773438 9.933594-54.835938-1.761718-66.542969-26.78125h52.242187c3.3125 0 6-2.6875 6-6s-2.6875-6-6-6h-56.15625c-1.175781-5.929687-1.324218-12.019531-.441406-18h63.597656c3.3125 0 6-2.6875 6-6s-2.6875-6-6-6h-60.351562c10.773437-26.601562 40.878906-39.652344 67.65625-29.328125 3.09375 1.1875 6.566406-.351562 7.757812-3.445312 1.1875-3.09375-.351562-6.566407-3.445312-7.757813-16.578125-6.402344-35.0625-5.679687-51.09375 1.988282-16.03125 7.671874-28.1875 21.617187-33.601563 38.542968h-13.921875c-3.3125 0-6 2.6875-6 6s2.6875 6 6 6h11.316406c-.71875 5.988282-.597656 12.046875.355469 18h-11.671875c-3.3125 0-6 2.6875-6 6zm0 0" fill="#a0b90a" data-original="#000000" style="" class=""></path><path xmlns="http://www.w3.org/2000/svg" d="m6.035156 364.003906h27.96875v27.96875c.144532 3.378906 2.929688 6.039063 6.3125 6.03125h28.6875v28.25c-.082031 1.519532.472656 3.007813 1.535156 4.097656 1.0625 1.09375 2.53125 1.691407 4.054688 1.652344h283.378906c1.570313.058594 3.09375-.523437 4.230469-1.605468 1.132813-1.082032 1.785156-2.578126 1.800781-4.144532v-351.9375c.007813-3.382812-2.652344-6.167968-6.03125-6.3125h-27.96875v-27.96875c-.144531-3.378906-2.929687-6.039062-6.3125-6.03125h-28.6875v-28.25c.082032-1.519531-.472656-3.007812-1.535156-4.097656-1.0625-1.09375-2.53125-1.6914062-4.054688-1.65234375h-283.378906c-1.570312-.05859375-3.09375.51953175-4.230468 1.60546875-1.132813 1.082031-1.7851568 2.578125-1.80078175 4.144531v351.9375c-.0078125 3.382813 2.65234375 6.167969 6.03124975 6.3125zm323.96875 27.96875v-311.96875h22v340h-271v-22h242.6875c3.382813.007813 6.167969-2.652344 6.3125-6.03125zm-35-34.28125v-311.6875h23v340h-272v-22h243.410156c3.3125 0 5.589844-3 5.589844-6.3125zm-283-345.6875h271v340h-271zm0 0" fill="#a0b90a" data-original="#000000" style="" class=""></path><path xmlns="http://www.w3.org/2000/svg" d="m255.132812 317.003906h-214.816406c-3.316406 0-6 2.6875-6 6s2.683594 6 6 6h214.816406c3.316407 0 6-2.6875 6-6s-2.683593-6-6-6zm0 0" fill="#a0b90a" data-original="#000000" style="" class=""></path><path xmlns="http://www.w3.org/2000/svg" d="m255.132812 283.003906h-214.816406c-3.316406 0-6 2.6875-6 6s2.683594 6 6 6h214.816406c3.316407 0 6-2.6875 6-6s-2.683593-6-6-6zm0 0" fill="#a0b90a" data-original="#000000" style="" class=""></path><path xmlns="http://www.w3.org/2000/svg" d="m40.316406 261.003906h77.699219c3.3125 0 6-2.6875 6-6s-2.6875-6-6-6h-77.699219c-3.316406 0-6 2.6875-6 6s2.683594 6 6 6zm0 0" fill="#a0b90a" data-original="#000000" style="" class=""></path></g></svg>                    </div>
                            <div class="customer-menu__item-content">
                                <div class="item-content__title"><?php echo ut_get_title_by_template('template-hebset-invoices.php'); ?></div>
                                <div class="item-content__desc"><?php echo ut_get_subtitle_by_template('template-hebset-invoices.php'); ?></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="/aktuelles/" target="_blank">
                            <div class="customer-menu__item-image">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="58" height="58" x="0" y="0" viewBox="0 0 64 64" style="enable-background:new 0 0 512 512" xml:space="preserve"><g><g xmlns="http://www.w3.org/2000/svg" id="Calendar"><path d="M57,8H52V6a4,4,0,0,0-8,0V8H36V6a4,4,0,0,0-8,0V8H20V6a4,4,0,0,0-8,0V8H7a5,5,0,0,0-5,5V53a5,5,0,0,0,5,5H35a1,1,0,0,0,0-2H7a3.009,3.009,0,0,1-3-3V22H60V39a1,1,0,0,0,2,0V13A5,5,0,0,0,57,8ZM46,6a2,2,0,0,1,4,0v6a2,2,0,0,1-4,0ZM30,6a2,2,0,0,1,4,0v6a2,2,0,0,1-4,0ZM14,6a2,2,0,0,1,4,0v6a2,2,0,0,1-4,0ZM60,20H4V13a3.009,3.009,0,0,1,3-3h5v2a4,4,0,0,0,8,0V10h8v2a4,4,0,0,0,8,0V10h8v2a4,4,0,0,0,8,0V10h5a3.009,3.009,0,0,1,3,3Z" fill="#a0b90a" data-original="#000000" style=""></path><path d="M30,29a2,2,0,0,0-2-2H24a2,2,0,0,0-2,2v3a2,2,0,0,0,2,2h4a2,2,0,0,0,2-2Zm-6,3V29h4v3Z" fill="#a0b90a" data-original="#000000" style=""></path><path d="M18,29a2,2,0,0,0-2-2H12a2,2,0,0,0-2,2v3a2,2,0,0,0,2,2h4a2,2,0,0,0,2-2Zm-6,3V29h4v3Z" fill="#a0b90a" data-original="#000000" style=""></path><path d="M52,34a2,2,0,0,0,2-2V29a2,2,0,0,0-2-2H48a2,2,0,0,0-2,2v3a2,2,0,0,0,2,2Zm-4-5h4v3H48Z" fill="#a0b90a" data-original="#000000" style=""></path><path d="M30,38a2,2,0,0,0-2-2H24a2,2,0,0,0-2,2v3a2,2,0,0,0,2,2h4a2,2,0,0,0,2-2Zm-6,3V38h4v3Z" fill="#a0b90a" data-original="#000000" style=""></path><path d="M18,38a2,2,0,0,0-2-2H12a2,2,0,0,0-2,2v3a2,2,0,0,0,2,2h4a2,2,0,0,0,2-2Zm-6,3V38h4v3Z" fill="#a0b90a" data-original="#000000" style=""></path><path d="M28,45H24a2,2,0,0,0-2,2v3a2,2,0,0,0,2,2h4a2,2,0,0,0,2-2V47A2,2,0,0,0,28,45Zm-4,5V47h4v3Z" fill="#a0b90a" data-original="#000000" style=""></path><path d="M36,34h4a2,2,0,0,0,2-2V29a2,2,0,0,0-2-2H36a2,2,0,0,0-2,2v3A2,2,0,0,0,36,34Zm0-5h4v3H36Z" fill="#a0b90a" data-original="#000000" style=""></path><path d="M34,41a2,2,0,0,0,2,2,1,1,0,0,0,0-2V38h4a1,1,0,0,0,0-2H36a2,2,0,0,0-2,2Z" fill="#a0b90a" data-original="#000000" style=""></path><path d="M16,45H12a2,2,0,0,0-2,2v3a2,2,0,0,0,2,2h4a2,2,0,0,0,2-2V47A2,2,0,0,0,16,45Zm-4,5V47h4v3Z" fill="#a0b90a" data-original="#000000" style=""></path><path d="M49,36A13,13,0,1,0,62,49,13.015,13.015,0,0,0,49,36Zm0,24A11,11,0,1,1,60,49,11.013,11.013,0,0,1,49,60Z" fill="#a0b90a" data-original="#000000" style=""></path><path d="M54.778,44.808,47,52.586,43.465,49.05a1,1,0,0,0-1.414,1.414l4.242,4.243a1,1,0,0,0,1.414,0l8.485-8.485a1,1,0,0,0-1.414-1.414Z" fill="#a0b90a" data-original="#000000" style=""></path></g></g></svg>                    </div>
                            <div class="customer-menu__item-content">
                                <div class="item-content__title">Aktuelles</div>
                                <div class="item-content__desc">Hier finden Sie aktuelle Veranstaltungen</div>
                            </div>
                        </a>
                    </li>
                    <li>
                    <a href="<?php echo ut_get_permalik_by_template('template-hebset-downloads.php'); ?>">
                            <div class="customer-menu__item-image">
                            <svg id="Gruppe_4" data-name="Gruppe 4" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="43.77" height="56" viewBox="0 0 43.77 56">
                                <defs>
                                    <clipPath id="clip-path">
                                    <rect id="Rechteck_2" data-name="Rechteck 2" width="43.77" height="56" fill="#a0b90b"/>
                                    </clipPath>
                                </defs>
                                <g id="Gruppe_3" data-name="Gruppe 3" clip-path="url(#clip-path)">
                                    <path id="Pfad_7" data-name="Pfad 7" d="M43.53,12.927,39.341,8.738V2.489A2.492,2.492,0,0,0,36.851,0H2.458A2.461,2.461,0,0,0,0,2.458V43.7a2.461,2.461,0,0,0,2.458,2.458h1.39v1.37a2.461,2.461,0,0,0,2.458,2.458h5.332a.82.82,0,0,0,0-1.641H6.307a.818.818,0,0,1-.818-.817V14.542a.82.82,0,1,0-1.641,0V44.513H2.458a.818.818,0,0,1-.817-.817V2.458a.818.818,0,0,1,.817-.817H36.852a.85.85,0,0,1,.849.849V7.1L34.671,4.068a.821.821,0,0,0-.58-.24H6.307A2.461,2.461,0,0,0,3.848,6.286v4.438a.82.82,0,1,0,1.641,0V6.286a.818.818,0,0,1,.818-.817H33.27v8.037a.82.82,0,0,0,.82.82H42.13v33.2a.818.818,0,0,1-.817.817H36.044a.82.82,0,0,0,0,1.641h5.269a2.461,2.461,0,0,0,2.458-2.458V13.507A.821.821,0,0,0,43.53,12.927Zm-8.619-.242V6.629l6.058,6.058Z" fill="#a0b90b"/>
                                    <path id="Pfad_8" data-name="Pfad 8" d="M141.106,175.456H121.481a.82.82,0,0,0,0,1.641h19.624a.82.82,0,0,0,0-1.641" transform="translate(-107.464 -156.265)" fill="#a0b90b"/>
                                    <path id="Pfad_9" data-name="Pfad 9" d="M141.106,219.688H121.481a.82.82,0,1,0,0,1.641h19.624a.82.82,0,0,0,0-1.641" transform="translate(-107.464 -195.66)" fill="#a0b90b"/>
                                    <path id="Pfad_10" data-name="Pfad 10" d="M269.333,264.8h-3.877a.82.82,0,0,0,0,1.641h3.877a.82.82,0,1,0,0-1.641" transform="translate(-235.691 -235.839)" fill="#a0b90b"/>
                                    <path id="Pfad_11" data-name="Pfad 11" d="M133.368,266.443a.82.82,0,0,0,0-1.641H121.481a.82.82,0,1,0,0,1.641Z" transform="translate(-107.464 -235.839)" fill="#a0b90b"/>
                                    <path id="Pfad_12" data-name="Pfad 12" d="M184.99,371.563,182.8,373.75v-7.93a.82.82,0,0,0-1.641,0v7.93l-2.187-2.187a.82.82,0,0,0-1.16,1.16l3.587,3.587a.82.82,0,0,0,1.16,0l3.587-3.587a.82.82,0,0,0-1.16-1.16Z" transform="translate(-158.153 -325.077)" fill="#a0b90b"/>
                                    <path id="Pfad_13" data-name="Pfad 13" d="M133.976,323.61a10.3,10.3,0,1,0,10.3,10.3,10.315,10.315,0,0,0-10.3-10.3m0,18.965a8.662,8.662,0,1,1,8.662-8.662,8.672,8.672,0,0,1-8.662,8.662" transform="translate(-110.146 -288.215)" fill="#a0b90b"/>
                                </g>
                                </svg>
                    </div>
                            <div class="customer-menu__item-content">
                                <div class="item-content__title">Downloads</div>
                                <div class="item-content__desc">Hier finden Sie Musterverträge und Dokumente als PDF</div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="/kilometer-statistics/" target="_blank">
                            <div class="customer-menu__item-image">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="58" height="58" x="0" y="0" viewBox="0 0 480.252 480.252" style="enable-background:new 0 0 512 512" xml:space="preserve"><g><g xmlns="http://www.w3.org/2000/svg"><path d="M456.126,464.252v-296c0-4.418-3.582-8-8-8h-80c-4.418,0-8,3.582-8,8v296h-16v-184c0-4.418-3.582-8-8-8h-80     c-4.418,0-8,3.582-8,8v184h-16v-264c0-4.418-3.582-8-8-8h-80c-4.418,0-8,3.582-8,8v264h-16v-152c0-4.418-3.582-8-8-8h-80     c-4.418,0-8,3.582-8,8v152h-24v16h480v-16H456.126z M104.126,464.252h-64v-144h64V464.252z M216.126,464.252h-64v-256h64V464.252     z M328.126,464.252h-64v-176h64V464.252z M440.126,464.252h-64v-288h64V464.252z" fill="#a0b90a" data-original="#000000" style=""></path><path d="M50.065,217.62c6.544,4.326,14.216,6.633,22.061,6.632c22.091-0.001,39.999-17.91,39.998-40.002     c0-7.842-2.306-15.512-6.63-22.054l56.624-56.632c6.49,4.343,14.119,6.67,21.928,6.688c2.355,0.001,4.705-0.205,7.024-0.616     c7.611-1.334,14.667-4.86,20.304-10.144l47.464,36.488c-7.922,20.622,2.373,43.762,22.995,51.684     c20.622,7.922,43.762-2.373,51.684-22.995c4.646-12.094,3.147-25.689-4.023-36.481l56.608-56.608     c18.477,12.23,43.37,7.165,55.599-11.312c12.23-18.477,7.165-43.37-11.312-55.599c-18.477-12.23-43.37-7.165-55.599,11.312     c-8.886,13.425-8.886,30.862,0,44.287l-56.608,56.608c-15.855-10.48-36.895-8.357-50.336,5.08     c-0.152,0.152-0.24,0.328-0.384,0.472l-46.776-35.952c8.985-20.182-0.092-43.826-20.274-52.811     c-20.182-8.985-43.826,0.092-52.811,20.274c-5.557,12.483-4.358,26.94,3.181,38.336l-56.6,56.608     c-18.429-12.183-43.244-7.119-55.427,11.31C26.573,180.622,31.636,205.437,50.065,217.62z M408.126,16.252     c13.255,0,24,10.745,24,24s-10.745,24-24,24s-24-10.745-24-24S394.871,16.252,408.126,16.252z M279.147,135.287     c4.502-4.505,10.61-7.036,16.979-7.035c13.255-0.002,24.001,10.742,24.003,23.997c0.001,6.369-2.53,12.477-7.035,16.979     c-9.5,9.055-24.436,9.055-33.936,0C269.782,159.858,269.778,144.662,279.147,135.287z M164.468,58.487     c0.001-0.001,0.001-0.002,0.002-0.003c3.638-5.226,9.214-8.781,15.488-9.872c1.393-0.239,2.803-0.359,4.216-0.36     c4.911,0.005,9.701,1.522,13.72,4.344c10.857,7.604,13.495,22.569,5.891,33.426s-22.569,13.494-33.426,5.891     C159.502,84.309,156.864,69.344,164.468,58.487z M55.147,167.287c0.004-0.004,0.007-0.007,0.011-0.011     c9.376-9.371,24.573-9.368,33.944,0.008c9.371,9.376,9.368,24.573-0.008,33.944c-9.5,9.055-24.436,9.055-33.936,0     C45.782,191.858,45.778,176.662,55.147,167.287z" fill="#a0b90a" data-original="#000000" style=""></path></g></g></svg>
                            </div>
                            <div class="customer-menu__item-content">
                                <div class="item-content__title">Kilometer-Statistik</div>
                                <div class="item-content__desc">Statistik der zurückgelegten Strecke</div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </section>

        <section class="customer-hints">
            <div class="container">
                <ul class="hints-list">
                    
                    <?php get_template_part( 'template-parts/notification', 'after-register' ); ?>
                    
                    <!-- <li class="hints-list__item hint-message">
                        <div class="list-item__image">
                            <i class="fas fa-comment-alt"></i>
                        </div>
                        <div class="list-item__text">
                            <p>Der Footer “Swoosh” der bei Seitenlayout “Elementor Volle Breite” hinterlegt, muss noch auf den einzelnen Memberseiten ergänzt werden.</p>
                        </div>
                    </li> -->
                </ul>
            </div>
        </section>

    </div>

<?php
get_footer();