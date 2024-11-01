<?php
$gid = $_REQUEST['edit'];
$wlsg = get_option('wslg');
$edit_field_data = $wlsg[$gid];
?>
<div class="">
    <table class="wslg wp-list-table widefat plugins ccf_checkout_fields ">
        <thead>
            <tr>
                <!--<th class="select_all"><input type="checkbox" style="margin-left:0px;" onclick="thwcfdSelectAllCheckoutFields(this)"/></th>-->
                <th  class="titledesc">
                    <label><?php _e("Group Name", 'menu-test'); ?> </label>
                </th>
                <th scope="row" class="titledesc">
                    <label> <?php _e("Shortcode", 'menu-test'); ?> </label>
                </th>
<!--                <th scope="row" class="titledesc">
                    <label> <?php // _e("Preview", 'menu-test');   ?> </label>
                </th>-->
                <th scope="row" class="titledesc">
                    <label> <?php _e("Enable", 'menu-test'); ?> </label>
                </th>
                <th scope="row" class="titledesc">
                    <label> <?php _e("Action", 'menu-test'); ?> </label>
                </th>
            </tr>
        </thead>
        <tbody class="ui-sortable">
            <?php
            if (!empty($wlsg['groups'])) {
                   foreach ($wlsg['groups'] as $key => $gid) {
                          ?> 
                          <tr valign="top">
                              <!--<td class="td_select" width="1%"><input type="checkbox" name="select_field"/></td>-->
                              <td scope="row" class="titledesc" width="20%">
                                  <label> <?php echo $wlsg[$gid]['setting']['group_name']; ?> </label>
                              </td>
                              <td class="forminp forminp-select " width="22%">
                                  <input type="text" readonly="readonly" value="<?php echo "[wslg id='" . $gid . "']"; ?>" class="w100">
                              </td>
              <!--                              <td class="forminp forminp-select">
                                  <label> 
                              <?php // echo do_shortcode('[wslg id="' . $gid . '"]'); ?>
                                  </label>
                              </td>-->
                              <td class="forminp forminp-select  " width="8%">
                                  <label>
                                      <?php echo ($wlsg[$gid]['setting']['enable'] == 'yes') ? '<a  href="' . wslg_current_page_url() . '&ds=' . $gid . '"><span class="dashicons dashicons-yes"></span></a>' : '<a  href="' . wslg_current_page_url() . '&en=' . $gid . '"><span class="dashicons dashicons-no"></span></a>'; ?></a></label>
                              </td>
                              <td class="forminp forminp-select action" width="10%">
                                  <label><a   href="<?php echo wslg_current_page_url() . "&edit=" . $gid; ?>"><span class="dashicons dashicons-edit"></span></a>
                                      <a onClick="javascript: return confirm('Please confirm deletion');"  href="<?php echo wslg_current_page_url() . "&del=" . $gid; ?>"><span class="dashicons dashicons-trash"></span></a>
                                      <!--<a onClick="return myconfirm();"  href="<?php echo wslg_current_page_url() . "&del=" . $gid; ?>"><span class="dashicons dashicons-trash"></span></a>-->
                                  </label>
                              </td>
                          </tr>
                          <?php
                   }
            }
            ?>
        </tbody>
    </table> 
</div>

<?php
echo do_action('wslg_promotion');
?>