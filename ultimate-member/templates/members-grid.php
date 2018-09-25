<div id="layout-modifier">
  <a href="#" id="list-layout" class="btn-layout"></a>
  <a href="#" id="grid-layout" class="btn-layout"></a>
</div>
<div class="clearfix"></div>

<?php if(isset($_GET['member']) && $_GET['member'] == 'true'){ ?>

  <div class="event__tabs-wrapper">
    <div class="nav nav-tabs" role="tablist">
      <a href="<?php echo add_query_arg('member', 'true', home_url('members')); ?>" class="events__heading nav-item nav-link active" id="nav-members" role="tab"><h2>MEMBERS</h2></a>
      <?php 
        if(isset($_GET['profile_type'])){
          $profile_type = $_GET['profile_type'];
          echo '<a href="' . esc_url(add_query_arg(array('profile_type' => rawurlencode($profile_type), 'um_search' => 1), home_url('members'))) . '" class="events__heading nav-item nav-link" id="nav-all" role="tab"><h2>ALL</h2></a>';
        }
        else{
          echo '<a href="' . home_url('members') . '" class="events__heading nav-item nav-link" id="nav-all" role="tab"><h2>ALL</h2></a>';
        }
      ?>
    </div>
  </div>

  <hr />

  <div class="tab-content">
    <div class="tab-pane fade show active" id="members" role="tab-panel" aria-labelledby="nav-members">
      <div class="um-members">
        <div class="um-gutter-sizer"></div>

        <?php 

          $i = 0; 

        foreach(um_members('users_per_page') as $member):
          $i++; 
          um_fetch_user($member); 
          if(!isset($_GET['profile_type']) || get_field('profile_type', 'user_' . um_user('ID')) == $profile_type): ?>
          <div class="um-member um-role-<?php echo um_user('role'); ?> <?php echo um_user('account_status'); ?>">

            <div class="member-block">
              <?php //member photo
                if($profile_photo):
                  $default_size = str_replace('px', '', UM()->options()->get('profile_photosize'));
                  $corner = UM()->options()->get('profile_photocorner'); ?>
              
                  <div class="um-member-photo radius-<?php echo $corner; ?>"><a href="<?php echo um_user_profile_url(); ?>" title="<?php echo esc_attr(um_user('organization')); ?>"><?php echo get_avatar(um_user('ID'), $default_size); ?></a></div>
              <?php endif; //end member photo ?>

              <div class="accr_member-block-info">
              <?php //member name 
                  $display_name = um_user('first_name') . ' ' . um_user('last_name');
                  if(um_user('organization') != ''){
                    $display_name = um_user('organization');
                  } 
                if($show_name): ?>
                  <div class="um-member-name"><a href="<?php echo um_user_profile_url(); ?>" title="<?php echo $display_name; ?>"><?php echo $display_name; ?></a></div>
              <?php endif; //end member name ?>

              <?php //member discipline
                if(!empty($show_userinfo)): ?>
                  <div class="um-member-meta-main">
                    <?php 
                      um_fetch_user($member);
                      foreach($reveal_fields as $key){
                        if($key){
                          $value = um_filtered_value($key);
                          if(!$value){ continue; } ?>
                  
                          <div class="um-member-metaline um-member-metaline-<?php echo $key; ?>"><span> <?php _e( $value, 'ultimate-member'); ?></span></div>

                    <?php }} //end foreach $reveal_fields ?>
                  </div><?php //end um-member-meta-main ?>
              <?php endif; //end member discipline ?>

              <?php //hover bio
                if($show_tagline && is_array( $tagline_fields)){
                  um_fetch_user($member);

                  foreach($tagline_fields as $key){
                    if($key /*&& um_filtered_value( $key )*/){
                      $value = um_filtered_value($key);
                      $value = strlen($value) > 245 ? substr($value, 0, 245) . '<a href="' . um_user_profile_url() . '"> [...] </a>' : $value;
                    if(!$value){ continue; } ?>
            
                    <div class="um-member-tagline um-member-tagline-<?php echo $key;?>">
                      <div class="um-member-name"><a href="<?php echo um_user_profile_url(); ?>" title="<?php echo $display_name; ?>"><?php echo $display_name; ?></a></div>
                      <?php _e( $value, 'ultimate-member'); ?>
                      <p class="read-more-about" style="font-weight:500;"><a href="<?php echo um_user_profile_url(); ?>">Read more about <?php echo $display_name; ?>...</a></p>
                    </div>

              <?php }} //end foreach, end if
                }//end hover bio ?>

              <?php //edit profile button
                if(UM()->roles()->um_current_user_can('edit', um_user('ID')) || UM()->roles()->um_user_can('can_edit_everyone')): ?>
                  <div class="um-members-edit-btn">
                    <a href="<?php echo um_edit_profile_url() ?>" class="um-edit-profile-btn um-button um-alt"><?php _e('Edit profile','ultimate-member') ?></a>
                  </div>
              <?php endif; //end edit profile button ?>

              </div><?php //end accr_member-block-info ?>
            </div><?php //end member block ?>
          </div><?php //end um-member ?>
          <?php endif; ?>
          <?php um_reset_user_clean(); endforeach; // end foreach um_members ?>
          <?php	um_reset_user(); ?>

          <div class="um-clear"></div>

        </div><!-- end um-members -->
      </div>
    </div><!-- end tab-content -->
<?php 
} //endif get member
else{ ?>
  <div class="event__tabs-wrapper">
    <div class="nav nav-tabs" role="tablist">
      <a href="<?php echo add_query_arg('member', 'true', home_url('members')); ?>" class="events__heading nav-item nav-link" id="nav-members" role="tab"><h2>MEMBERS</h2></a>
      <?php 
        if(isset($_GET['profile_type'])){
          $profile_type = $_GET['profile_type'];
          echo '<a href="' . esc_url(add_query_arg(array('profile_type' => rawurlencode($profile_type), 'um_search' => 1), home_url('members'))) . '" class="events__heading nav-item nav-link active" id="nav-all" role="tab"><h2>ALL</h2></a>';
        }
        else{
          echo '<a href="' . home_url('members') . '" class="events__heading nav-item nav-link active" id="nav-all" role="tab"><h2>ALL</h2></a>';
        }
      ?>
    </div>
  </div>

  <hr />

  <div class="tab-content">
    <div class="tab-pane fade show active" id="all" role="tab-panel" aria-labelledby="nav-all">
      <div class="um-members">
        <div class="um-gutter-sizer"></div>
        
        <?php 
          $i = 0; 
          foreach(um_members('users_per_page') as $member):
            $i++; 
            um_fetch_user($member); ?>
            
            <div class="um-member um-role-<?php echo um_user('role'); ?> <?php echo um_user('account_status'); ?>">

              <div class="member-block">
                <?php //member photo
                  if($profile_photo):
                    $default_size = str_replace('px', '', UM()->options()->get('profile_photosize'));
                    $corner = UM()->options()->get('profile_photocorner'); ?>
                
                    <div class="um-member-photo radius-<?php echo $corner; ?>"><a href="<?php echo um_user_profile_url(); ?>" title="<?php echo esc_attr(um_user('organization')); ?>"><?php echo get_avatar(um_user('ID'), $default_size); ?></a></div>
                <?php endif; //end member photo ?>

                <div class="accr_member-block-info">
                <?php //member name 
                    $display_name = um_user('first_name') . ' ' . um_user('last_name');
                    if(um_user('organization') != ''){
                      $display_name = um_user('organization');
                    } 
                  if($show_name): ?>
                    <div class="um-member-name"><a href="<?php echo um_user_profile_url(); ?>" title="<?php echo $display_name; ?>"><?php echo $display_name; ?></a></div>
                <?php endif; //end member name ?>

                <?php //member discipline
                  if(!empty($show_userinfo)): ?>
                    <div class="um-member-meta-main">
                      <?php 
                        um_fetch_user($member);
                        foreach($reveal_fields as $key){
                          if($key){
                            $value = um_filtered_value($key);
                            if(!$value){ continue; } ?>
                    
                            <div class="um-member-metaline um-member-metaline-<?php echo $key; ?>"><span> <?php _e( $value, 'ultimate-member'); ?></span></div>

                      <?php }} //end foreach $reveal_fields ?>
                    </div><?php //end um-member-meta-main ?>
                <?php endif; //end member discipline ?>

                <?php //hover bio
                  if($show_tagline && is_array( $tagline_fields)){
                    um_fetch_user($member);

                    foreach($tagline_fields as $key){
                      if($key /*&& um_filtered_value( $key )*/){
                        $value = um_filtered_value($key);
                        $value = strlen($value) > 245 ? substr($value, 0, 245) . '<a href="' . um_user_profile_url() . '"> [...]</a>' : $value;
                      if(!$value){ continue; } ?>
              
                      <div class="um-member-tagline um-member-tagline-<?php echo $key;?>">
                        <div class="um-member-name"><a href="<?php echo um_user_profile_url(); ?>" title="<?php echo $display_name; ?>"><?php echo $display_name; ?></a></div>
                        <?php _e( $value, 'ultimate-member'); ?>
                        <p class="read-more-about" style="font-weight:500;"><a href="<?php echo um_user_profile_url(); ?>">Read more about <?php echo $display_name; ?>...</a></p>
                      </div>

                <?php }} //end foreach, end if
                  }//end hover bio ?>

                <?php //edit profile button
                  if(UM()->roles()->um_current_user_can('edit', um_user('ID')) || UM()->roles()->um_user_can('can_edit_everyone')): ?>
                    <div class="um-members-edit-btn">
                      <a href="<?php echo um_edit_profile_url() ?>" class="um-edit-profile-btn um-button um-alt"><?php _e('Edit profile','ultimate-member') ?></a>
                    </div>
                <?php endif; //end edit profile button ?>
                </div><?php //end accr_member-block-info ?>
              </div><?php //end member block ?>

            </div><?php //end um-member ?>

        <?php um_reset_user_clean(); endforeach; // end foreach um_members ?>
        <?php	um_reset_user(); ?>

        <div class="um-clear"></div>

      </div><!-- end um-members -->
    </div>
  </div><!-- end tab-content -->

<?php
}