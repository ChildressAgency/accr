<div id="layout-modifier">
  <a href="#" id="list-layout" class="btn-layout"></a>
  <a href="#" id="grid-layout" class="btn-layout"></a>
</div>
<div class="clearfix"></div>

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
          
              <div class="um-member-photo radius-<?php echo $corner; ?>"><a href="<?php echo um_user_profile_url(); ?>" title="<?php echo esc_attr(um_user('display_name')); ?>"><?php echo get_avatar(um_user('ID'), $default_size); ?></a></div>
          <?php endif; //end member photo ?>

          <?php //member name 
            if($show_name): ?>
              <div class="um-member-name"><a href="<?php echo um_user_profile_url(); ?>" title="<?php echo esc_attr(um_user('display_name')); ?>"><?php echo um_user('display_name', 'html'); ?></a></div>
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
                  $value = strlen($value) > 245 ? substr($value, 0, 245) . '<a href="' . um_user_profile_url() . '">[...]</a>' : $value;
                if(!$value){ continue; } ?>
        
                <div class="um-member-tagline um-member-tagline-<?php echo $key;?>">
                  <div class="um-member-name"><a href="<?php echo um_user_profile_url(); ?>" title="<?php echo esc_attr(um_user('display_name')); ?>"><?php echo um_user('display_name', 'html'); ?></a></div>
                  <?php _e( $value, 'ultimate-member'); ?>
                </div>
          <?php }} //end foreach, end if
            }//end hover bio ?>
          <?php //edit profile button
            if(UM()->roles()->um_current_user_can('edit', um_user('ID')) || UM()->roles()->um_user_can('can_edit_everyone')): ?>
              <div class="um-members-edit-btn">
                <a href="<?php echo um_edit_profile_url() ?>" class="um-edit-profile-btn um-button um-alt"><?php _e('Edit profile','ultimate-member') ?></a>
              </div>
          <?php endif; //end edit profile button ?>
        </div><?php //end member block ?>

      </div><?php //end um-member ?>

  <?php um_reset_user_clean(); endforeach; // end foreach um_members ?>
				
	<?php	um_reset_user(); ?>

	<div class="um-clear"></div>

</div>
