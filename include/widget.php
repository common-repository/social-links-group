<?php

// Creating the widget 
class wslg_widget extends WP_Widget {

       function __construct() {
              parent::__construct(
                      'wslg_widget', __('Social Links Widget', 'wslg_domain'), array('description' => __('Widget for Social Links group', 'wslg_domain'),)
              );
       }

       public function widget($args, $instance) {
              $title = apply_filters('widget_title', $instance['wslg_title']);
              $wslg_link_group = $instance['wslg_link_group'];
              $wslg_before_content = $instance['wslg_before_content'];
              $wslg_after_content = $instance['wslg_after_content'];

              echo $args['before_widget'];
              if (!empty($title))
                     echo $args['before_title'] . $title . $args['after_title'];

              echo "<p>" . $wslg_before_content . "<p><p>" . do_shortcode('[wslg id="' . $wslg_link_group . '"]') . "<p><p>" . $wslg_after_content . "<p>";

              echo $args['after_widget'];
       }

       public function form($instance) {
              $wlsg = array();
              if (get_option('wslg')) {
                     $wlsg = get_option('wslg');
              }

              if (isset($instance['wslg_title'])) {
                     $title = $instance['wslg_title'];
                     $link_group = $instance['link_group'];
                     $before_link_group = $instance['wslg_before_content'];
                     $after_link_group = $instance['wslg_after_content'];
              }
              ?>
              <p>
                  <label for="<?php echo $this->get_field_id('wslg_title'); ?>"><?php _e('Title:'); ?></label> 
                  <input class="widefat" id="<?php echo $this->get_field_id('wslg_title'); ?>" name="<?php echo $this->get_field_name('wslg_title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
              </p>
              <p>
                  <label for="<?php echo $this->get_field_id('wslg_link_group'); ?>"><?php _e('Select link Group:'); ?></label> <br>
                  <select class="widefat" name="<?php echo $this->get_field_name('wslg_link_group'); ?>" id="<?php echo $this->get_field_id('wslg_link_group'); ?>"  >
                      <option value="">Select Group</option>

                      <?php
                      if (!empty($wlsg['groups'])) {
                             foreach ($wlsg['groups'] as $key => $gid) {
                                    ?>
                                    <option value="<?php echo $gid; ?>"  <?php
                                    if ($link_group == '1') {
                                           echo 'selected';
                                    }
                                    ?>><?php echo $wlsg[$gid]['setting']['group_name']; ?></option>
                                            <?php
                                     }
                              }
                              ?>
                  </select>
              </p>
              <p>
                  <label for="<?php echo $this->get_field_id('wslg_before_content'); ?>"><?php _e('Subtitle Before link Icons:'); ?></label> <br>
                  <textarea name="<?php echo $this->get_field_name('wslg_before_content'); ?>" id="<?php echo $this->get_field_id('wslg_before_content'); ?>" rows="3" class="widefat"><?php echo esc_attr($before_link_group); ?></textarea>
              </p>
              <p>
                  <label for="<?php echo $this->get_field_id('wslg_after_content'); ?>"><?php _e('Subtitle After link Icons:'); ?></label> <br>
                  <textarea name="<?php echo $this->get_field_name('wslg_after_content'); ?>" id="<?php echo $this->get_field_id('wslg_after_content'); ?>" rows="3" class="widefat"><?php echo esc_attr($after_link_group); ?></textarea>
              </p>
              <?php
       }

       public function update($new_instance, $old_instance) {
              $instance = array();
              $instance['wslg_title'] = (!empty($new_instance['wslg_title']) ) ? strip_tags($new_instance['wslg_title']) : '';
              $instance['wslg_link_group'] = (!empty($new_instance['wslg_link_group']) ) ? strip_tags($new_instance['wslg_link_group']) : '';
              $instance['wslg_before_content'] = (!empty($new_instance['wslg_before_content']) ) ? strip_tags($new_instance['wslg_before_content']) : '';
              $instance['wslg_after_content'] = (!empty($new_instance['wslg_after_content']) ) ? strip_tags($new_instance['wslg_after_content']) : '';

              return $instance;
       }

}

function wslg_load_widget() {
       register_widget('wslg_widget');
}

add_action('widgets_init', 'wslg_load_widget');
?>
