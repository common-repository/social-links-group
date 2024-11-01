<?php
$array_icons = array(0 => 'facebook', 1 => 'google-plus', 2 => 'pinterest',
    3 => 'linkedin', 4 => 'twitter', 5 => 'youtube', 6 => 'dribbble',
    7 => 'instagram', 8 => 'tumblr');

//$array_icons = array(0 => 'facebook', 1 => 'google-plus', 2 => 'pinterest',
//    3 => 'linkedin', 4 => 'twitter', 5 => 'youtube', 6 => 'dribbble',
//    7 => 'flickr', 8 => 'instagram', 9 => 'github', 10 => 'jsfiddle',
//    11 => 'stack-overflow', 12 => 'stumbleupon', 13 => 'tripadvisor', 14 => 'tumblr',
//    15 => 'vimeo', 16 => 'wordpress', 17 => 'codepen', 18 => 'stack-exchange');

$layout_dir = WSLG_PLUGIN_PATH . 'layout/';

$layouts = array();
if (is_dir($layout_dir)) {
       $layouts = scandir($layout_dir);
       if (!empty($layouts)) {
              array_shift($layouts);
              array_shift($layouts);
       }
}
?>

<?php
if (isset($_REQUEST['edit']) && $_REQUEST['edit'] != '') {
       $edit_field_data = array();
       $gid = $_REQUEST['edit'];
       $wlsg = get_option('wslg');
       if (isset($wlsg[$gid])) {
              $edit_field_data = $wlsg[$gid];
       }

       // delete_option('wslg');
//           echo '<pre>';
//           print_r($wlsg);
//           print_r($edit_field_data);
//           echo '</pre>';
       ?>
       <div class="wslg_group"><div class="row">
               <form  method="post" class="wslg_add_group" role="form">
                   <input type="hidden" name="txt_gid" id="txt_gid" value="<?php echo $gid; ?>">
                   <input type="hidden" name="<?php echo $gid . '[setting][enable]'; ?>"  value="yes">
                   <div class="col-md-6 position-static">
                       <div class="form-group clearfix">
                           <div class="col-sm-4 col-md-2"><label class="control-label " for=""><?php _e("Group Name:", 'menu-test'); ?></label>
                           </div>
                           <div class="col-sm-8  col-md-8">
                               <input type="text" name="<?php echo $gid . '[setting][group_name]'; ?>" value="<?php echo $edit_field_data['setting']['group_name']; ?>" class="form-control" id="txt_field_name" placeholder="Enter Group Name" size="20">
                           </div>

                       </div>
                       <div class="new_field_form clearfix" id="new_field_form">
                           <div class="col-md-4">
                               <label> Select icon</label>
                           </div>
                           <div class="col-md-4">
                               <label> Add link</label>
                           </div>
                           <div class="col-md-2">

                           </div>
                           <div class="col-md-4">
                               <select class="form-control" id="txt_social_icon" > 
                                   <option value="">Select icon</option>
                                   <?php
                                   foreach ($array_icons as $icon) {
                                          echo '<option value="' . $icon . '">' . $icon . '</option>';
                                   }
                                   ?>
                               </select>
                           </div>
                           <div class="col-md-4">
                               <input type="text" class="form-control" id="txt_social_link" placeholder="Enter Link" size="20">
                           </div>
                           <div class="col-md-2">
                               <a id="add_field_button_id" class="add_field_button wslgbutton btn button-primary"><?php esc_attr_e('Add Field') ?></a>
                           </div>
                       </div>
                       <div id="TextBoxContainer">
                           <?php
                           if (!empty($edit_field_data['icons'])) {
                                  foreach ($edit_field_data['icons'] as $key => $icon) {
                                         ?>
                                         <div class="wslg_social animated flipInX clearfix">
                                             <div class="col-md-2">
                                                 <label><?php echo $key; ?></label>
                                             </div>
                                             <div class="col-md-8">
                                                 <input type="tetx" class="form-control" name="<?php echo $gid . '[icons][' . $key . ']'; ?>" value="<?php echo $icon; ?>">
                                             </div>
                                             <a><span class="dashicons dashicons-dismiss"></span></a>
                                         </div>
                                         <?php
                                  }
                           }
                           ?>
                       </div>
                   </div>
                   <div class="col-md-5 border-left">
                       <div class="form-group clearfix">
                           <div class="col-sm-4 col-md-4"><label class="control-label " for=""><?php _e("Icon Type:", 'menu-test'); ?></label>
                           </div>
                           <div class="col-sm-8  col-md-6">
                               <select class="form-control" name="<?php echo $gid . '[setting][social_icon_type]'; ?>" id="txt_social_icon_type" > 
                                   <option value="fontawesome" <?php
                                   if ($edit_field_data['setting']['social_icon_type'] == 'fontawesome') {
                                          echo 'selected';
                                   }
                                   ?>>Font Awesome Icons</option>
                                   <option value="image"  <?php
                                   if ($edit_field_data['setting']['social_icon_type'] == 'image') {
                                          echo 'selected';
                                   }
                                   ?>>Icon Images</option>
                               </select> 
                           </div>

                       </div>
                       <div class="form-group clearfix icons_image">
                           <div class="col-sm-4 col-md-4"><label class="control-label " for=""><?php _e("Icon Layout:", 'menu-test'); ?></label>
                           </div>
                           <div class="col-sm-8  col-md-6">
                               <select class="form-control" name="<?php echo $gid . '[setting][social_icon_layout]'; ?>" id="txt_social_icon_type" > 
                                   <option value="">Select Icons Layout</option>
                                   <?php
                                   if (!empty($layouts)) {
                                          foreach ($layouts as $layout) {
                                                 ?>
                                                 <option value="<?php echo $layout; ?>" <?php
                                                 if ($edit_field_data['setting']['social_icon_layout'] == $layout) {
                                                        echo 'selected';
                                                 }
                                                 ?>><?php echo ucfirst(str_replace('_', ' ', $layout)); ?></option>
                                                         <?php
                                                  }
                                           }
                                           ?>
                               </select> 
                           </div>

                       </div>
                       <div class="form-group clearfix icons_font">
                           <div class="col-sm-4 col-md-4"><label class="control-label " for=""><?php _e("Background Color:", 'menu-test'); ?></label>
                           </div>
                           <div class="col-sm-8  col-md-6">
                               <input type="text" name="<?php echo $gid . '[setting][bg_color]'; ?>" class="form-control" id="txt_bg_color" placeholder="Enter Background Color" size="20" value="<?php echo $edit_field_data['setting']['bg_color']; ?>">
                           </div>

                       </div>
                       <div class="form-group clearfix icons_font">
                           <div class="col-sm-4 col-md-4"><label class="control-label " for=""><?php _e("Font Color:", 'menu-test'); ?></label>
                           </div>
                           <div class="col-sm-8  col-md-6">
                               <input type="text" name="<?php echo $gid . '[setting][f_color]'; ?>" class="form-control" id="txt_f_color" placeholder="Enter Font Color" size="20" value="<?php echo $edit_field_data['setting']['f_color']; ?>">
                           </div>

                       </div>
                       <div class="form-group clearfix  ">
                           <div class="col-sm-4 col-md-4"><label class="control-label " for=""><?php _e("Icons Size (<small>In px</small>): ", 'menu-test'); ?></label>
                           </div>
                           <div class="col-sm-8  col-md-6">
                               <input type="text" name="<?php echo $gid . '[setting][i_size]'; ?>" class="form-control" id="i_size" placeholder="Enter Icons Size" size="20" value="<?php echo $edit_field_data['setting']['i_size']; ?>">
                           </div>

                       </div>
                       <div class="form-group clearfix ">
                           <div class="col-sm-4 col-md-4"><label class="control-label " for=""><?php _e("Icons Space (<small>In px</small>):", 'menu-test'); ?></label>
                           </div>
                           <div class="col-sm-8  col-md-6">
                               <input type="text" name="<?php echo $gid . '[setting][txt_i_margin]'; ?>" class="form-control" id="txt_i_margin" placeholder="Enter Margin" size="20" value="<?php echo $edit_field_data['setting']['txt_i_margin']; ?>">
                           </div>

                       </div>
                       <div class="form-group clearfix ">
                           <div class="col-sm-4 col-md-4"><label class="control-label " for=""><?php _e("Direction:", 'menu-test'); ?></label>
                           </div>
                           <div class="col-sm-8  col-md-6">
                               <select class="form-control" name="<?php echo $gid . '[setting][s_direction]'; ?>" id="txt_s_direction"  >
                                   <option value="">Select icon</option>
                                   <option value="horizontal" <?php
                                   if ($edit_field_data['setting']['s_direction'] == 'horizontal') {
                                          echo 'selected';
                                   }
                                   ?>>Horizontal</option>
                                   <option value="vertical" <?php
                                   if ($edit_field_data['setting']['s_direction'] == 'vertical') {
                                          echo 'selected';
                                   }
                                   ?>>vertical</option>
                               </select>
                           </div>

                       </div>
                       <div class="form-group clearfix icons_font">
                           <div class="col-sm-4 col-md-4"><label class="control-label " for=""><?php _e("Border Radius  (<small>In px</small>):", 'menu-test'); ?></label>
                           </div>
                           <div class="col-sm-8  col-md-6">
                               <input type="text" name="<?php echo $gid . '[setting][b_radious]'; ?>" class="form-control" id="txt_b_radious" placeholder="Enter Border Radious" size="20" value="<?php echo $edit_field_data['setting']['b_radious']; ?>">
                           </div>

                       </div>
                       <div class="form-group clearfix">
                           <div class="col-sm-4 col-md-4"><label class="control-label " for=""><?php _e("Position:", 'menu-test'); ?></label>
                           </div>
                           <div class="col-sm-8  col-md-6">
                               <select class="form-control" name="<?php echo $gid . '[setting][i_position]'; ?>" id="txt_i_position"> 

                                   <option value="nfixed" <?php
                                   if ($edit_field_data['setting']['i_position'] == 'nfixed') {
                                          echo 'selected';
                                   }
                                   ?>>Not Fixed</option>
                                   <option value="lfixed"  <?php
                                   if ($edit_field_data['setting']['i_position'] == 'lfixed') {
                                          echo 'selected';
                                   }
                                   ?>>Left Fixed</option>
                                   <option value="rfixed"  <?php
                                   if ($edit_field_data['setting']['i_position'] == 'rfixed') {
                                          echo 'selected';
                                   }
                                   ?>>Right Fixed</option>
                               </select> 
                           </div>
                       </div>
                       <div class="form-group clearfix p_fixed">
                           <div class="col-sm-4 col-md-4"><label class="control-label " for=""><?php _e("Throught Site:", 'menu-test'); ?></label>
                           </div>
                           <div class="col-sm-8  col-md-6">
                               <input type="checkbox" name="<?php echo $gid . '[setting][t_site]'; ?>" class="form-control" id="txt_b_radious" size="20"  <?php
                               if ($edit_field_data['setting']['t_site'] == 'on') {
                                      echo 'checked';
                               }
                               ?>>
                           </div>
                       </div>
                   </div>
                   <div class="form-group">        
                       <div class="fixed_save_button">
                           <button type="submit" name="save_settings" class="btn wslgbutton button-primary"><?php esc_attr_e('Save Settings') ?></button>
                       </div>
                   </div>
               </form>
           </div>
       </div>
       <div class="wslg_group text-center priview">
           <span>Priview</span>
           <input type="text" readonly="readonly" name="generated_shortcode" class="text-center" id="generated_shortcode" value='<?php echo '[wslg id="' . $gid . '"]'; ?>'>
           <br>
           <div class="col-md-12 clearfix">
               <?php
               echo do_shortcode('[wslg id="' . $gid . '"]');
               ?>
           </div>     
       </div>
       <?php
} else {
       $gid = wslg_group_random_id();
       ?>
       <div class="wslg_group">
           <div class="row">
               <form  method="post" class="wslg_add_group" role="form">
                   <input type="hidden" name="txt_gid" id="txt_gid" value="<?php echo $gid; ?>">
                   <input type="hidden" name="<?php echo $gid . '[setting][enable]'; ?>"  value="yes">
                   <div class="col-md-6 position-static">
                       <div class="form-group clearfix">
                           <div class="col-sm-4 col-md-2"><label class="control-label " for=""><?php _e("Group Name:", 'menu-test'); ?></label>
                           </div>
                           <div class="col-sm-8  col-md-8">
                               <input type="text" name="<?php echo $gid . '[setting][group_name]'; ?>" class="form-control" id="txt_field_name" placeholder="Enter Group Name" size="20">
                           </div>

                       </div>
                       <div class="new_field_form clearfix" id="new_field_form">
                           <div class="col-md-4">
                               <label> Select icon</label>
                           </div>
                           <div class="col-md-4">
                               <label> Add link</label>
                           </div>
                           <div class="col-md-2">

                           </div>
                           <div class="col-md-4">
                               <select class="form-control" id="txt_social_icon" > 
                                   <option value="">Select icon</option>
                                   <?php
                                   foreach ($array_icons as $icon) {
                                          echo '<option value="' . $icon . '">' . $icon . '</option>';
                                   }
                                   ?>
                               </select>
                           </div>
                           <div class="col-md-4">
                               <input type="text" class="form-control" id="txt_social_link" placeholder="Enter Link" size="20">
                           </div>
                           <div class="col-md-2">
                               <a id="add_field_button_id" class="add_field_button wslgbutton btn button-primary"><?php esc_attr_e('Add Field') ?></a>
                           </div>
                       </div>
                       <div id="TextBoxContainer"></div>
                   </div>
                   <div class="col-md-5 border-left">
                       <div class="form-group clearfix">
                           <div class="col-sm-4 col-md-4"><label class="control-label " for=""><?php _e("Icon Type:", 'menu-test'); ?></label>
                           </div>
                           <div class="col-sm-8  col-md-6">
                               <select class="form-control" name="<?php echo $gid . '[setting][social_icon_type]'; ?>" id="txt_social_icon_type" > 
                                   <option value="fontawesome" selected>Font Awesome Icons</option>
                                   <option value="image">Icon Images</option>
                               </select>  </div>

                       </div>
                       <div class="form-group clearfix icons_image">
                           <div class="col-sm-4 col-md-4"><label class="control-label " for=""><?php _e("Icon Layout:", 'menu-test'); ?></label>
                           </div>
                           <div class="col-sm-8  col-md-6">
                               <select class="form-control" name="<?php echo $gid . '[setting][social_icon_layout]'; ?>" id="txt_social_icon_type" > 
                                   <?php
                                   if (!empty($layouts)) {
                                          foreach ($layouts as $layout) {
                                                 ?>
                                                 <option value="<?php echo $layout; ?>" ><?php echo ucfirst(str_replace('_', ' ', $layout)); ?></option>
                                                 <?php
                                          }
                                   }
                                   ?>
                               </select> 
                           </div>
                       </div>
                       <div class="form-group clearfix icons_font">
                           <div class="col-sm-4 col-md-4"><label class="control-label " for=""><?php _e("Background Color:", 'menu-test'); ?></label>
                           </div>
                           <div class="col-sm-8  col-md-6">
                               <input type="text" name="<?php echo $gid . '[setting][bg_color]'; ?>" class="form-control" id="txt_bg_color" placeholder="Enter Background Color" size="20">
                           </div>

                       </div>
                       <div class="form-group clearfix icons_font">
                           <div class="col-sm-4 col-md-4"><label class="control-label " for=""><?php _e("Font Color:", 'menu-test'); ?></label>
                           </div>
                           <div class="col-sm-8  col-md-6">
                               <input type="text" name="<?php echo $gid . '[setting][f_color]'; ?>" class="form-control" id="txt_f_color" placeholder="Enter Font Color" size="20">
                           </div>

                       </div>
                       <div class="form-group clearfix icons_image ">
                           <div class="col-sm-4 col-md-4"><label class="control-label " for=""><?php _e("Icons Size:", 'menu-test'); ?></label>
                           </div>
                           <div class="col-sm-8  col-md-6">
                               <input type="text" name="<?php echo $gid . '[setting][i_size]'; ?>" class="form-control" id="i_size" placeholder="Enter Icons Size" size="20">
                           </div>

                       </div>
                       <div class="form-group clearfix ">
                           <div class="col-sm-4 col-md-4"><label class="control-label " for=""><?php _e("Icons Space:", 'menu-test'); ?></label>
                           </div>
                           <div class="col-sm-8  col-md-6">
                               <input type="text" name="<?php echo $gid . '[setting][txt_i_margin]'; ?>" class="form-control" id="txt_i_margin" placeholder="Enter margin " size="20">
                           </div>

                       </div>
                       <div class="form-group clearfix ">
                           <div class="col-sm-4 col-md-4"><label class="control-label " for=""><?php _e("Direction:", 'menu-test'); ?></label>
                           </div>
                           <div class="col-sm-8  col-md-6">
                               <select class="form-control" name="<?php echo $gid . '[setting][s_direction]'; ?>" id="txt_s_direction" > 
                                   <option value="">Select icon</option>
                                   <option value="horizontal">Horizontal</option>
                                   <option value="vertical">vertical</option>
                               </select>
                           </div>

                       </div>
                       <div class="form-group clearfix icons_font">
                           <div class="col-sm-4 col-md-4"><label class="control-label " for=""><?php _e("Border Radious:", 'menu-test'); ?></label>
                           </div>
                           <div class="col-sm-8  col-md-6">
                               <input type="text" name="<?php echo $gid . '[setting][b_radious]'; ?>" class="form-control" id="txt_b_radious" placeholder="Enter Group Name" size="20">
                           </div>

                       </div>
                       <div class="form-group clearfix">
                           <div class="col-sm-4 col-md-4"><label class="control-label " for=""><?php _e("Position:", 'menu-test'); ?></label>
                           </div>
                           <div class="col-sm-8  col-md-6">
                               <select class="form-control" name="<?php echo $gid . '[setting][i_position]'; ?>" id="txt_i_position"> 
                                   <option value="nfixed">Not Fixed</option>
                                   <option value="lfixed">Left Fixed</option>
                                   <option value="rfixed">Right Fixed</option>
                               </select>  </div>

                       </div>
                       <div class="form-group clearfix p_fixed">
                           <div class="col-sm-4 col-md-4"><label class="control-label " for=""><?php _e("Throught Site:", 'menu-test'); ?></label>
                           </div>
                           <div class="col-sm-8  col-md-6">
                               <input type="checkbox" name="<?php echo $gid . '[setting][t_site]'; ?>" class="form-control" id="txt_b_radious" size="20">
                           </div>
                           <div class="col-sm-12 col-md-12">
                               <small> By checking this option you don't need to use shortcode. Social Icons will be display automatically throughout the site. </small>
                           </div>
                       </div>
                   </div>
                   <div class="form-group">        
                       <div class="fixed_save_button">
                           <button type="submit" name="save_settings" class="btn wslgbutton button-primary"><?php esc_attr_e('Save Settings') ?></button>
                       </div>
                   </div>
               </form>
           </div>
       </div>
       <?php
}
echo do_action('wslg_promotion');
?>