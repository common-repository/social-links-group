<?php
/* * *********************** Hook to add before page ************************ */
add_action('wslg_admin_page', 'wslg_before_page', 0);

if (!function_exists('wslg_before_page')) {

       function wslg_before_page() {
              echo '<div class="wrap">';
       }

}

/* * *********************** Hook to add wslg page title ************************ */
add_action('wslg_admin_page', 'wslg_admin_page_title', 10);

if (!function_exists('wslg_admin_page_title')) {

       function wslg_admin_page_title() {
              $url = menu_page_url('WSLG_settings_menu', FALSE);
              echo '<h2 class="wslg_title">Social Link Group   <a href="' . $url . '&add" class="wslgbutton btn button-primary pull-right">Add New Group</a> <a href="' . $url . '" class="wslgbutton btn button-primary pull-right">List</a></h2>';
       }

}

/* * *********************** Hook to add wslg form ************************ */
add_action('wslg_admin_page', 'wslg_admin_screen', 20);
if (!function_exists('wslg_admin_screen')) {

       function wslg_admin_screen() {

              if (isset($_REQUEST['add'])) {
                     if ($_POST) {
                            $id = $_POST['txt_gid'];
                            $wslg = array();
                            if (get_option('wslg')) {
                                   $wslg = get_option('wslg');
                                   if (!isset($wslg['groups']) || empty($wslg['groups'])) {
                                          $wslg['groups'] = array();
                                          array_push($wslg['groups'], $id);
                                          $wslg[$id] = $_POST[$id];
                                          update_option('wslg', $wslg);
                                   } else {
                                          array_push($wslg['groups'], $id);
                                          $wslg[$id] = $_POST[$id];
                                          update_option('wslg', $wslg);
                                   }
                            } else {
                                   if (!isset($wslg['groups']) || empty($wslg['groups'])) {
                                          $wslg['groups'] = array();
                                          array_push($wslg['groups'], $id);
                                          $wslg[$id] = $_POST[$id];
                                          add_option('wslg', $wslg);
                                   }
                            }
                            $wslg = get_option('wslg');

                            redirect(menu_page_url('WSLG_settings_menu', FALSE) . '&edit=' . $id);
//                           redirect(menu_page_url('WSLG_settings_menu') . '&edit=' . $id);
                     }
                     load_template(WSLG_PLUGIN_DIR . '/template/form.php');
              } elseif (isset($_REQUEST['edit'])) {
                     if ($_POST) {
                            $wslg = get_option('wslg');
                            $id = $_POST['txt_gid'];
                            $wslg[$id] = $_POST[$id];
                            update_option('wslg', $wslg);
                     }
                     load_template(WSLG_PLUGIN_DIR . '/template/form.php');
              } elseif (isset($_REQUEST['del']) && $_REQUEST['del'] != '') {

                     $wslg = get_option('wslg');
                     $id = $_REQUEST['del'];

                     $f = array_flip($wslg['groups']);
                     $gid_k = $f[$id];
                     unset($wslg['groups'][$gid_k]);
                     unset($wslg[$id]);
                     $wslg[$id]['setting']['enable'] = 'yes';
                     update_option('wslg', $wslg);

                     redirect(menu_page_url('WSLG_settings_menu', FALSE));
              } else {
                     if (isset($_REQUEST['en']) && $_REQUEST['en'] != '') {
                            $wslg = get_option('wslg');
                            $id = $_REQUEST['en'];
                            $wslg[$id]['setting']['enable'] = 'yes';
                            update_option('wslg', $wslg);
                            redirect(menu_page_url('WSLG_settings_menu', FALSE));
                     }
                     if (isset($_REQUEST['ds']) && $_REQUEST['ds'] != '') {
                            $wslg = get_option('wslg');
                            $id = $_REQUEST['ds'];
                            $wslg[$id]['setting']['enable'] = 'no';
                            update_option('wslg', $wslg);
                            redirect(menu_page_url('WSLG_settings_menu', FALSE));
                     }
                     load_template(WSLG_PLUGIN_DIR . '/template/list.php');
              }
       }

}

/* * *********************** Hook to add wslg field grid ************************ */
add_action('wslg_admin_page', 'wslg_admin_datagrid', 30);

if (!function_exists('wslg_admin_datagrid')) {

       function wslg_admin_datagrid() {
//              load_template(WSLG_PLUGIN_DIR . '/template/datagrid.php');
       }

}

/* * *********************** Hook to add close tag after page  ************************ */
add_action('wslg_admin_page', 'wslg_after_page', 100);

if (!function_exists('wslg_after_page')) {

       function wslg_after_page() {
              echo '</div>';
       }

}

/* * *********************** Success message on new field successful addition. ************************ */

function wslg_insert_success_msg() {
       ?>
       <div class="updated"><p><strong><?php _e('New field inserted.', 'menu-test'); ?></strong></p></div>
       <?php
       return;
}

/* * *********************** Error message to show when woocommerce is not installed in your website ************************ */

function wslg_error_notice() {
       ?>
       <div class="error notice">
           <p><?php _e(' In order to use <b>Custom Checkout Plugin</b>, You need to install <a href="https://wordpress.org/plugins/woocommerce/" alt="wocommerce">woocommerce</a> plugin.', 'wslg_plugin_textdomain'); ?></p>
       </div>
       <?php
}

/* * *********************** Message will display on uninstallation of your plugin ************************ */

function wslg_plugin_uninstall_notice() {
       ?>
       <div class="success notice">
           <p><?php _e('Social Links Group plugin uninstalled successfully.', 'wslg_plugin_textdomain'); ?></p>
       </div>
       <?php
}

/* * *********************** Message will display on activation of your plugin ************************ */

function wslg_plugin_activation_notice() {
       ?>
       <div class="success notice">
           <p><?php _e(' Social Links Group plugin activated successfully.', 'wslg_plugin_textdomain'); ?></p>
       </div>
       <?php
}

/* * *********************** Message will display on deactivation of your plugin ************************ */

function wslg_plugin_deactivation_notice() {
       ?>
       <div class="success notice">
           <p><?php _e(' Social Links Group  plugin deactivated successfully.', 'wslg_plugin_textdomain'); ?></p>
       </div>
       <?php
}

/* * *********************** get  plugin current page url ************************ */

function wslg_current_page_url() {
       $pageURL = 'http';
       if (isset($_SERVER["HTTPS"])) {
              if ($_SERVER["HTTPS"] == "on") {
                     $pageURL .= "s";
              }
       }
       $pageURL .= "://";
       if ($_SERVER["SERVER_PORT"] != "80") {
              $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
       } else {
              $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
       }
       return $pageURL;
}

/* * *********************** generate Reandom number  ************************ */

function wslg_group_random_id() {
       $random = uniqid('wslg');
       return $random;
}

/* * *********************** wsgl shortcode Function  ************************ */

add_shortcode('wslg', wslg_shortcode_function);

function wslg_shortcode_function($atts) {
       $pull_atts = shortcode_atts(
               array(
           'id' => '',
               ), $atts, 'wslg');
       $gid = $pull_atts['id'];
       if (get_option('wslg')) {
              $wslg = get_option('wslg');
              // print_r($wslg);


              if ($wslg[$gid]['setting']['enable'] == 'yes' && !empty($wslg[$gid]['icons'])) {

                     $html = '<div id="' . $gid . '">';
                     if ($wslg[$gid]['setting']['social_icon_type'] == 'fontawesome') {
                            $html .= '<style> #' . $gid . ' a{';
                            $html .= 'background-color:' . $wslg[$gid]['setting']['bg_color'] . '!important;';
                            $html .= 'font-size:' . $wslg[$gid]['setting']['i_size'] . '!important;';
                            $html .= 'color:' . $wslg[$gid]['setting']['f_color'] . '!important;';
                            $html .= 'border-radius:' . $wslg[$gid]['setting']['b_radious'] . '!important;';
                            $html .= 'margin-right:5px;text-align: center;min-height: 30px!important;';
                            $html .= 'min-width:30px!important;';

                            if ($wslg[$gid]['setting']['s_direction'] == 'vertical') {
                                   $html .= 'display: inline-block;';
                            } else {
                                   $html .= 'display: inline-block;';
                            }
                            $html .= 'margin-right: ' . $wslg[$gid]['setting']['txt_i_margin'] . '!important;';
                            if ($wslg[$gid]['setting']['i_position'] == 'lfixed') {
                                   $html .= '} #' . $gid . '{   position: fixed;
    left: 0;
    top: 35%;
    z-index: 9999;';
                            } else if ($wslg[$gid]['setting']['i_position'] == 'rfixed') {
                                   $html .= '} #' . $gid . '{   position: fixed;
    right: 0;
    top: 35%;
    z-index: 9999;';
                            } else {
                                   $html .= '} #' . $gid . '{ margin-top:10px!important;margin-bottom:10px!important;';
                            }


                            $html .= '}</style>';

                            foreach ($wslg[$gid]['icons'] as $key => $val) {
                                   $html .= '<a href="' . $val . '" class=""><i class="fa fa-' . $key . '"></i></a>';
                            }
                     } else if ($wslg[$gid]['setting']['social_icon_type'] == 'image') {
                            $html .= '<style> #' . $gid . ' a{';
                            $html .= 'width: ' . $wslg[$gid]['setting']['i_size'] . ';clear: both;display: table;';
                            $html .= 'display: inline-block;';
                            $html .= 'margin-right: ' . $wslg[$gid]['setting']['txt_i_margin'] . ';';

                            if ($wslg[$gid]['setting']['s_direction'] == 'vertical') {
                                   $html .= 'display: block;';
                            } else {
                                   $html .= 'display: inline-block;';
                            }

                            if ($wslg[$gid]['setting']['i_position'] == 'lfixed') {
                                   $html .= '} #' . $gid . '{   position: fixed;
    left: 0;
    top: 35%;
    z-index: 9999;';
                            } else if ($wslg[$gid]['setting']['i_position'] == 'rfixed') {
                                   $html .= '} #' . $gid . '{   position: fixed;
    right: 0;
    top: 35%;
    z-index: 9999;';
                            } else {
                                   $html .= '} #' . $gid . '{ margin-top:10px!important;margin-bottom:10px!important;';
                            }

                            $html .= '}</style>';


                            $layout = $wslg[$gid]['setting']['social_icon_layout'];

                            $img = WSLG_plugin_url('/layout/' . $layout);

                            foreach ($wslg[$gid]['icons'] as $key => $val) {
                                   $html .= '<a href="' . $val . '" class=""><img class="img-responsive" src="' . $img . '/' . $key . '.png"></a>';
                            }
                     }
                     $html .= '</div>';
                     return $html;
              } else {
                     return '';
              }
       }
}

add_action('wp_head', 'add_content_after_header', 20);

function add_content_after_header() {

       $wslg = get_option('wslg');

       if (!empty($wslg['groups'])) {
              foreach ($wslg['groups'] as $grp) {
                     if ($wslg[$grp]['setting']['t_site'] == 'on') {
                            echo do_shortcode('[wslg id="' . $grp . '"]');
                     }
              }
       }
}

add_action('wslg_promotion', 'wslg_promotion_fucntion', 0);

function wslg_promotion_fucntion() {
       ?>
       <div class="wslg_promo text-center">
           <h2>Don't Forget to Rate Us!!. <a href="https://wordpress.org/support/view/plugin-reviews/social-links-group">Click Here</a></h2>
           <h2>Find Full Documentation for this plugin. <a href="http://plugins.auratechmind.net/social-links-group/">Click Here</a></h2>
           <h2>FindOut Our Other plugins. <a href="http://auratechmind.net/">Click Here</a></h2>
       </div>
       <?php
}


?>