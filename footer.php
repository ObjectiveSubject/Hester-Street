<?php
/**
 * The template for displaying the footer.
 */
?>

	<footer class="site-footer footer" role="contentinfo">
        
        <div class="flex has-sidebar u-container">

            <div class="section__sidebar flex__item">

                <div class="masthead">
                    <a id="logo" class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <svg class="hsc-logo" viewBox="0 0 1140 400" fill-rule="evenodd">
                            <polygon points="136.9 329.9 98.2 329.9 98.2 215.9 39.3 215.9 39.3 329.9 0.6 329.9 0.6 68.4 39.3 68.4 39.3 182.4 98.2 182.4 98.2 68.4 136.9 68.4 136.9 329.9"></polygon>
                            <polygon points="279.4 296.3 279.4 329.9 167.8 329.9 167.8 68.4 276.8 68.4 276.8 102 206.4 102 206.4 182.4 270.9 182.4 270.9 216 206.4 216 206.4 296.4 279.4 296.4"></polygon>
                            <path d="M299.1,266.5 L299.1,244.8 L338.1,244.8 L338.5,264 C338.5,290.9 347.3,304.9 365.8,304.9 C383.1,304.9 391.2,292.7 391.2,273.2 L391.2,263.6 C391.2,243 388.6,232.7 368.4,219.4 L337,199.5 C310.8,182.6 301.6,163 301.6,136.1 L301.6,122.8 C301.6,84.9 327,62 365.7,62 C407,62 430.5,80.1 430.5,126.1 L430.5,145.6 L391.8,144.8 L391.8,129.8 C391.8,105.5 383.7,93 365.6,93 C349.8,93 341.3,104.4 341.3,120.3 L341.3,132.8 C341.3,149.7 347.6,160.8 363,170.4 L395,191 C424.5,209.8 431.1,230 431.1,258.4 L431.1,272.4 C431.1,312.6 408.6,336.1 365.2,336.1 C322.6,336.2 299.1,311.5 299.1,266.5 Z"></path>
                            <polygon points="588.7 102.2 537.9 102.2 537.9 329.9 500 329.9 500 102.2 448.8 102.2 448.8 68.3 588.8 68.3"></polygon>
                            <polygon points="726.1 296.3 726.1 329.9 614.4 329.9 614.4 68.4 726 68.4 726 102 653.1 102 653.1 179.3 717.6 179.3 717.6 212.9 653.1 212.9 653.1 296.4 726.1 296.4"></polygon>
                            <path d="M818.1,210.2 L795.6,210.2 L795.7,329.9 L757,329.9 L757,68.4 L818.5,68.4 C866.4,68.4 885.9,92.7 886.3,135.4 L886.3,150.1 C886.3,182.5 874,202.1 853.8,210.9 L893,329.9 L852.1,329.9 L818.1,210.2 Z M816.3,179.4 C838,179.4 846.5,176.6 846.5,146.7 L846.5,129.5 C846.5,99.7 838.1,96.6 815.9,96.6 L795.6,96.6 L795.6,179.3 L816.3,179.3 L816.3,179.4 L816.3,179.4 Z"></path>
                            <path d="M996.9,234.3 C970.2,234.3 954.8,218.3 954.8,190.3 L954.8,174.2 L984.6,174.1 L984.6,188.8 C984.6,209.2 993.7,209.2 997.1,209.2 C999.9,209.2 1008.5,209.2 1008.5,194.1 L1008.5,188.5 C1008.5,177.5 1007.5,172.6 996.7,165.6 L978.5,154 C962.9,143.9 956.3,132 956.3,114.2 L956.3,106.5 C956.3,82.9 972.3,67.6 997.1,67.6 C1024.4,67.6 1038.3,81.3 1038.3,108.4 L1038.3,123.2 L1008.9,123.1 L1008.9,110.6 C1008.9,94.6 1002.6,92.5 997.1,92.5 C987.4,92.5 986.3,101.2 986.3,105 L986.3,112.3 C986.3,121 989.4,126.4 997.4,131.3 L1016.1,143.4 C1034.9,155.4 1038.7,168.9 1038.7,185.6 L1038.7,193.8 C1038.8,219.5 1023.5,234.3 996.9,234.3 Z"></path>
                            <polygon points="1111.2 232.6 1082.2 232.6 1082.2 94.9 1052.3 94.9 1052.3 68.3 1140.7 68.3 1140.7 94.9 1111.1 94.9"></polygon>
                            <rect x="0.6" y="0.6" width="1140.3" height="33.9"></rect>
                            <rect x="0.6" y="363.8" width="1140.3" height="33.9"></rect>
                        </svg>
                        <span class="u-display-none"><?php bloginfo( 'name' ); ?></span>
                    </a>
                </div>

            </div>

            <div class="footer__content section__content flex flex__item">
                
                <nav class="flex__item">

                    <?php
                    $menu_primary   = false;                    
                    if ( has_nav_menu( 'footer-primary' ) ) {
                        $menu_primary = wp_nav_menu(array(
                            'theme_location' => 'footer-primary',
                            'container'		 => false,
                            'menu_class'	 => 'primary-menu footer-primary-menu',
                            'menu_id'		 => 'footer-primary-menu',
                            'echo'			 => false
                        ));
                        echo $menu_primary;
                    } ?>

                </nav>

                <div class="footer__lower flex flex__item is-borderless u-mt-3">

                    <nav class="flex flex__item is-flush flex-wrap">

                        <?php 
                        $menu_secondary = false;
                        if ( has_nav_menu( 'footer-secondary' ) ) {
                            $menu_secondary = wp_nav_menu(array(
                                'theme_location' => 'footer-secondary',
                                'container'		 => false,
                                'menu_class'	 => 'secondary-menu footer-secondary-menu u-mt-0',
                                'menu_id'		 => 'footer-secondary-menu',
                                'echo'			 => false
                            ));
                            echo $menu_secondary;
                        } ?>

                        <?php
                        $social_accounts = array(
                            'Facebook' => get_theme_mod('facebook', ''),
                            'Twitter' => get_theme_mod('twitter', ''),
                            'Instagram' => get_theme_mod('instagram', ''),
                            'Vimeo' => get_theme_mod('vimeo', ''),
                            'Linkedin' => get_theme_mod('linkedin', '')
                        );
                        ?>                    

                        <ul class="list social footer-social">
                        
                            <?php 
                            foreach ( $social_accounts as $name => $url ) :
                                if ( ! empty( $url ) ) : ?>
                                    <li class="list__item menu-item">
                                        <a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="nofollow"><?php echo $name; ?></a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>

                        </ul>

                    </nav>

                    <div id="colophon" class="footer-colophon flex__item">
                        <div>
                            <p class="u-mt-0">Hester Street is an urban planning, design and community development nonprofit working so that neighborhoods are shaped by their people.</p>
                            
                            <!-- Begin MailChimp Signup Form -->
                            <div id="mc_embed_signup">
                            <form action="//hesterstreet.us15.list-manage.com/subscribe/post?u=ad4ffc9caf6943d4a15bfaefb&amp;id=ab79784775" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" rel="nofollow" novalidate> 
                                <div id="mc_embed_signup_scroll">
                                    <input type="checkbox" id="fields-toggle" style="display:none"/>
                                    <label class="fields-toggle-label h6 label" for="fields-toggle" role="presentation"></label>

                                    <div class="toggled-fields">
                                    
                                        <div class="mc-field-group">
                                            <label for="mce-EMAIL" class="h6 u-mt-0">Email Address <span class="asterisk">*</span></label>
                                            <input type="email" value="" name="EMAIL" class="required email form-field u-display-block u-width-100" id="mce-EMAIL">
                                        </div>
                                        <div class="mc-field-group">
                                            <label for="mce-FNAME" class="h6 u-mt-0">First Name <span class="asterisk">*</span></label>
                                            <input type="text" value="" name="FNAME" class="required form-field u-display-block u-width-100" id="mce-FNAME">
                                        </div>
                                        <div class="mc-field-group">
                                            <label for="mce-LNAME" class="h6 u-mt-0">Last Name <span class="asterisk">*</span></label>
                                            <input type="text" value="" name="LNAME" class="required form-field u-display-block u-width-100" id="mce-LNAME">
                                        </div>
                                        <div class="mc-field-group">
                                            <label for="mce-MMERGE3" class="h6 u-mt-0">Company </label>
                                            <input type="text" value="" name="MMERGE3" class="form-field u-display-block u-width-100" id="mce-MMERGE3">
                                        </div>
                                        <div class="mc-address-group">
                                            <div class="mc-field-group">
                                                <label for="mce-MMERGE4-addr1" class="h6 u-mt-0">Address</label>
                                                <input type="text" value="" maxlength="70" name="MMERGE4[addr1]" id="mce-MMERGE4-addr1" class="form-field u-display-block u-width-100">
                                            </div>
                                            <div class="mc-field-group size1of2">
                                                <label for="mce-MMERGE4-city" class="h6 u-mt-0">City</label>
                                                <input type="text" value="" maxlength="40" name="MMERGE4[city]" id="mce-MMERGE4-city" class="form-field u-display-block u-width-100">
                                            </div>
                                            <div class="mc-field-group size1of2">
                                                <label for="mce-MMERGE4-state" class="h6 u-mt-0">State/Province/Region</label>
                                            <input type="text" value="" maxlength="20" name="MMERGE4[state]" id="mce-MMERGE4-state" class="form-field u-display-block u-width-100">
                                            </div>
                                            <div class="mc-field-group size1of2">
                                                <label for="mce-MMERGE4-zip" class="h6 u-mt-0">Postal / Zip Code</label>
                                                <input type="text" value="" maxlength="10" name="MMERGE4[zip]" id="mce-MMERGE4-zip" class="form-field u-display-block u-width-100">
                                            </div>
                                            <div class="mc-field-group size1of2">
                                                <label for="mce-MMERGE4-country" class="h6 u-mt-0">Country</label>
                                                <select name="MMERGE4[country]" id="mce-MMERGE4-country" class="form-field u-display-block u-width-100"><option value="164" selected>USA</option><option value="286">Aaland Islands</option><option value="274">Afghanistan</option><option value="2">Albania</option><option value="3">Algeria</option><option value="178">American Samoa</option><option value="4">Andorra</option><option value="5">Angola</option><option value="176">Anguilla</option><option value="175">Antigua And Barbuda</option><option value="6">Argentina</option><option value="7">Armenia</option><option value="179">Aruba</option><option value="8">Australia</option><option value="9">Austria</option><option value="10">Azerbaijan</option><option value="11">Bahamas</option><option value="12">Bahrain</option><option value="13">Bangladesh</option><option value="14">Barbados</option><option value="15">Belarus</option><option value="16">Belgium</option><option value="17">Belize</option><option value="18">Benin</option><option value="19">Bermuda</option><option value="20">Bhutan</option><option value="21">Bolivia</option><option value="325">Bonaire, Saint Eustatius and Saba</option><option value="22">Bosnia and Herzegovina</option><option value="23">Botswana</option><option value="181">Bouvet Island</option><option value="24">Brazil</option><option value="180">Brunei Darussalam</option><option value="25">Bulgaria</option><option value="26">Burkina Faso</option><option value="27">Burundi</option><option value="28">Cambodia</option><option value="29">Cameroon</option><option value="30">Canada</option><option value="31">Cape Verde</option><option value="32">Cayman Islands</option><option value="33">Central African Republic</option><option value="34">Chad</option><option value="35">Chile</option><option value="36">China</option><option value="185">Christmas Island</option><option value="37">Colombia</option><option value="204">Comoros</option><option value="38">Congo</option><option value="183">Cook Islands</option><option value="268">Costa Rica</option><option value="275">Cote D'Ivoire</option><option value="40">Croatia</option><option value="276">Cuba</option><option value="298">Curacao</option><option value="41">Cyprus</option><option value="42">Czech Republic</option><option value="318">Democratic Republic of the Congo</option><option value="43">Denmark</option><option value="44">Djibouti</option><option value="289">Dominica</option><option value="187">Dominican Republic</option><option value="45">Ecuador</option><option value="46">Egypt</option><option value="47">El Salvador</option><option value="48">Equatorial Guinea</option><option value="49">Eritrea</option><option value="50">Estonia</option><option value="51">Ethiopia</option><option value="189">Falkland Islands</option><option value="191">Faroe Islands</option><option value="52">Fiji</option><option value="53">Finland</option><option value="54">France</option><option value="193">French Guiana</option><option value="277">French Polynesia</option><option value="56">Gabon</option><option value="57">Gambia</option><option value="58">Georgia</option><option value="59">Germany</option><option value="60">Ghana</option><option value="194">Gibraltar</option><option value="61">Greece</option><option value="195">Greenland</option><option value="192">Grenada</option><option value="196">Guadeloupe</option><option value="62">Guam</option><option value="198">Guatemala</option><option value="270">Guernsey</option><option value="63">Guinea</option><option value="65">Guyana</option><option value="200">Haiti</option><option value="66">Honduras</option><option value="67">Hong Kong</option><option value="68">Hungary</option><option value="69">Iceland</option><option value="70">India</option><option value="71">Indonesia</option><option value="278">Iran</option><option value="279">Iraq</option><option value="74">Ireland</option><option value="323">Isle of Man</option><option value="75">Israel</option><option value="76">Italy</option><option value="202">Jamaica</option><option value="78">Japan</option><option value="288">Jersey  (Channel Islands)</option><option value="79">Jordan</option><option value="80">Kazakhstan</option><option value="81">Kenya</option><option value="203">Kiribati</option><option value="82">Kuwait</option><option value="83">Kyrgyzstan</option><option value="84">Lao People's Democratic Republic</option><option value="85">Latvia</option><option value="86">Lebanon</option><option value="87">Lesotho</option><option value="88">Liberia</option><option value="281">Libya</option><option value="90">Liechtenstein</option><option value="91">Lithuania</option><option value="92">Luxembourg</option><option value="208">Macau</option><option value="93">Macedonia</option><option value="94">Madagascar</option><option value="95">Malawi</option><option value="96">Malaysia</option><option value="97">Maldives</option><option value="98">Mali</option><option value="99">Malta</option><option value="207">Marshall Islands</option><option value="210">Martinique</option><option value="100">Mauritania</option><option value="212">Mauritius</option><option value="241">Mayotte</option><option value="101">Mexico</option><option value="102">Moldova, Republic of</option><option value="103">Monaco</option><option value="104">Mongolia</option><option value="290">Montenegro</option><option value="294">Montserrat</option><option value="105">Morocco</option><option value="106">Mozambique</option><option value="242">Myanmar</option><option value="107">Namibia</option><option value="108">Nepal</option><option value="109">Netherlands</option><option value="110">Netherlands Antilles</option><option value="213">New Caledonia</option><option value="111">New Zealand</option><option value="112">Nicaragua</option><option value="113">Niger</option><option value="114">Nigeria</option><option value="217">Niue</option><option value="214">Norfolk Island</option><option value="272">North Korea</option><option value="116">Norway</option><option value="117">Oman</option><option value="118">Pakistan</option><option value="222">Palau</option><option value="282">Palestine</option><option value="119">Panama</option><option value="219">Papua New Guinea</option><option value="120">Paraguay</option><option value="121">Peru</option><option value="122">Philippines</option><option value="221">Pitcairn</option><option value="123">Poland</option><option value="124">Portugal</option><option value="126">Qatar</option><option value="315">Republic of Kosovo</option><option value="127">Reunion</option><option value="128">Romania</option><option value="129">Russia</option><option value="130">Rwanda</option><option value="205">Saint Kitts and Nevis</option><option value="206">Saint Lucia</option><option value="324">Saint Martin</option><option value="237">Saint Vincent and the Grenadines</option><option value="132">Samoa (Independent)</option><option value="227">San Marino</option><option value="255">Sao Tome and Principe</option><option value="133">Saudi Arabia</option><option value="134">Senegal</option><option value="266">Serbia</option><option value="135">Seychelles</option><option value="136">Sierra Leone</option><option value="137">Singapore</option><option value="302">Sint Maarten</option><option value="138">Slovakia</option><option value="139">Slovenia</option><option value="223">Solomon Islands</option><option value="140">Somalia</option><option value="141">South Africa</option><option value="257">South Georgia and the South Sandwich Islands</option><option value="142">South Korea</option><option value="311">South Sudan</option><option value="143">Spain</option><option value="144">Sri Lanka</option><option value="293">Sudan</option><option value="146">Suriname</option><option value="225">Svalbard and Jan Mayen Islands</option><option value="147">Swaziland</option><option value="148">Sweden</option><option value="149">Switzerland</option><option value="285">Syria</option><option value="152">Taiwan</option><option value="260">Tajikistan</option><option value="153">Tanzania</option><option value="154">Thailand</option><option value="233">Timor-Leste</option><option value="155">Togo</option><option value="232">Tonga</option><option value="234">Trinidad and Tobago</option><option value="156">Tunisia</option><option value="157">Turkey</option><option value="158">Turkmenistan</option><option value="287">Turks &amp; Caicos Islands</option><option value="159">Uganda</option><option value="161">Ukraine</option><option value="162">United Arab Emirates</option><option value="262">United Kingdom</option><option value="163">Uruguay</option><option value="165">Uzbekistan</option><option value="239">Vanuatu</option><option value="166">Vatican City State (Holy See)</option><option value="167">Venezuela</option><option value="168">Vietnam</option><option value="169">Virgin Islands (British)</option><option value="238">Virgin Islands (U.S.)</option><option value="188">Western Sahara</option><option value="170">Yemen</option><option value="173">Zambia</option><option value="174">Zimbabwe</option></select>
                                            </div>
                                        </div>
                                        <div id="mce-responses" class="clear">
                                            <div class="response" id="mce-error-response" style="display:none"></div>
                                            <div class="response" id="mce-success-response" style="display:none"></div>
                                        </div>    
                                        <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                        <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_ad4ffc9caf6943d4a15bfaefb_ab79784775" tabindex="-1" value=""></div>
                                        <div class=""><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                                    
                                    </div>
                                </div>
                            </form>
                            </div>
                            <!--End mc_embed_signup-->
                        </div>

                        <address class="u-mt-6">
                            <span class="h6 u-display-block">113 Hester Street</span>
                            <span class="h6 u-mt-0 u-display-block">New York, NY 10002</span>
                        </address>
                    </div>

                </div>
                

            </div><!-- .footer__content -->

        </div><!-- .footer-row -->

	</footer>

</div><!-- #page -->

<?php wp_footer(); ?>

<?php if ( ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) || ( defined( 'WP_DEBUG' ) && WP_DEBUG )  ) : ?>

    <span class="media-size"></span>

<?php else : ?>

    <!--Google Analytics-->
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-99112296-1', 'auto');
        ga('send', 'pageview');

    </script>

<?php endif; ?>

</body>
</html>
