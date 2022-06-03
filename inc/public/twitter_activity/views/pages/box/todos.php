<div class="tasks">
	<div class="title fw-6 text-info"><?php _e("Select what you want to do")?></div>
	<div class="item-task wrap-m">
		<div class="wrap-c">
			<label class="i-switch i-switch--outline i-switch--info m-t-6 m-r-6">
				<input type="checkbox" name="todos[favorite]" class="action-save" data-type="like" <?php twav($a, "todos", "favorite") ?> value="1">
				<span></span>
			</label>
			<div class="name fs-16">
				<?php _e("Like")?>
				<i class="fa fa-question-circle" data-toggle="tooltip-custom" data-trigger="hover" data-placement="top" data-html="true" title="" data-original-title="<?php _e("Turn this switch on to automate your Likes activity.<br/><br/> The counter shows how many medias you've liked since your last activity start.", false)?>"></i>

				<?php if( $activity && tw_get_setting("favorite_block", "", $activity->id) ){?>
				<i class="fas fa-exclamation-circle text-warning" data-toggle="tooltip" data-trigger="hover" data-placement="top" title="" data-original-title="<?php _e( tw_get_setting("favorite_block", "", $activity->id) )?>"></i>
				<?php }?>
			</div>
		</div>
		<div class="wrap-c fs-18 fw-6">
			<?php _e( twac( $settings, "favorite" ) )?>
		</div>
	</div>
	<div class="item-task wrap-m">
		<div class="wrap-c">
			<label class="i-switch i-switch--outline i-switch--info m-t-6 m-r-6">
				<input type="checkbox" name="todos[reply]" class="action-save" data-type="reply" <?php twav($a, "todos", "reply") ?> value="1">
				<span></span>
			</label>
			<div class="name fs-16">
				<?php _e("Reply")?>
				<i class="fa fa-question-circle" data-toggle="tooltip-custom" data-trigger="hover" data-placement="top" data-html="true" title="" data-original-title="<?php _e("Turn this switch on to automate your replies activity.<br/><br/> The counter shows how many tweets you've replied since your last activity start.", false)?>"></i>
				<?php if( $activity && tw_get_setting("reply_block", "", $activity->id) ){?>
				<i class="fas fa-exclamation-circle text-warning" data-toggle="tooltip" data-trigger="hover" data-placement="top" title="" data-original-title="<?php _e( tw_get_setting("reply_block", "", $activity->id) )?>"></i>
				<?php }?>
			</div>
		</div>
		<div class="wrap-c fs-18 fw-6">
			<?php _e( twac( $settings, "reply" ) )?>
		</div>
	</div>
	<div class="item-task wrap-m">
		<div class="wrap-c">
			<label class="i-switch i-switch--outline i-switch--info m-t-6 m-r-6">
				<input type="checkbox" name="todos[retweet]" class="action-save" data-type="retweet" <?php twav($a, "todos", "retweet") ?> value="1">
				<span></span>
			</label>
			<div class="name fs-16">
				<?php _e("Retweet")?>
				<i class="fa fa-question-circle" data-toggle="tooltip-custom" data-trigger="hover" data-placement="top" data-html="true" title="" data-original-title="<?php _e("Turn this switch on to automate your retweets activity.<br/><br/> The counter shows how many tweets you've retweeted since your last activity start.", false)?>"></i>
				<?php if( $activity && tw_get_setting("retweet_block", "", $activity->id) ){?>
				<i class="fas fa-exclamation-circle text-warning" data-toggle="tooltip" data-trigger="hover" data-placement="top" title="" data-original-title="<?php _e( tw_get_setting("retweet_block", "", $activity->id) )?>"></i>
				<?php }?>
			</div>
		</div>
		<div class="wrap-c fs-18 fw-6">
			<?php _e( twac( $settings, "retweet" ) )?>
		</div>
	</div>
	<div class="item-task wrap-m">
		<div class="wrap-c">
			<label class="i-switch i-switch--outline i-switch--info m-t-6 m-r-6">
				<input type="checkbox" name="todos[follow]" class="action-save" data-type="follow" <?php twav($a, "todos", "follow") ?> value="1">
				<span></span>
			</label>
			<div class="name fs-16">
				<?php _e("Follow")?>
				<i class="fa fa-question-circle" data-toggle="tooltip-custom" data-trigger="hover" data-placement="top" data-html="true" title="" data-original-title="<?php _e("Turn this switch on to automate your follows activity.<br/><br/> The counter shows how many users you've followed since your last activity start.", false)?>"></i>
				<?php if( $activity && tw_get_setting("follow_block", "", $activity->id) ){?>
				<i class="fas fa-exclamation-circle text-warning" data-toggle="tooltip" data-trigger="hover" data-placement="top" title="" data-original-title="<?php _e( tw_get_setting("follow_block", "", $activity->id) )?>"></i>
				<?php }?>
			</div>
		</div>
		<div class="wrap-c fs-18 fw-6">
			<?php _e( twac( $settings, "follow" ) )?>
		</div>
	</div>
	<div class="item-task wrap-m">
		<div class="wrap-c">
			<label class="i-switch i-switch--outline i-switch--info m-t-6 m-r-6">
				<input type="checkbox" name="todos[unfollow]" class="action-save" data-type="unfollow" <?php twav($a, "todos", "unfollow") ?> value="1">
				<span></span>
			</label>
			<div class="name fs-16">
				<?php _e("Unfollow")?>
				<i class="fa fa-question-circle" data-toggle="tooltip-custom" data-trigger="hover" data-placement="top" data-html="true" title="" data-original-title="<?php _e("Turn this switch on to automate your unfollows activity.<br/><br/> The counter shows how many users you've unfollowed since your last activity start.", false)?>"></i>
				<?php if( $activity && tw_get_setting("unfollow_block", "", $activity->id) ){?>
				<i class="fas fa-exclamation-circle text-warning" data-toggle="tooltip" data-trigger="hover" data-placement="top" title="" data-original-title="<?php _e( tw_get_setting("unfollow_block", "", $activity->id) )?>"></i>
				<?php }?>
			</div>
		</div>
		<div class="wrap-c fs-18 fw-6">
			<?php _e( twac( $settings, "unfollow" ) )?>
		</div>
	</div>
	<div class="item-task wrap-m">
		<div class="wrap-c">
			<label class="i-switch i-switch--outline i-switch--info m-t-6 m-r-6">
				<input type="checkbox" name="todos[direct]" class="action-save" data-type="direct" <?php twav($a, "todos", "direct") ?> value="1">
				<span></span>
			</label>
			<div class="name fs-16">
				<?php _e("Welcome DM")?>
				<i class="fa fa-question-circle" data-toggle="tooltip-custom" data-trigger="hover" data-placement="top" data-html="true" title="" data-original-title="<?php _e("Turn this switch on to automate your direct messages activity.<br/><br/> The counter shows how many users you've sent direct message since your last activity start.", false)?>"></i>
				<?php if( $activity && tw_get_setting("direct_block", "", $activity->id) ){?>
				<i class="fas fa-exclamation-circle text-warning" data-toggle="tooltip" data-trigger="hover" data-placement="top" title="" data-original-title="<?php _e( tw_get_setting("direct_block", "", $activity->id) )?>"></i>
				<?php }?>
			</div>
		</div>
		<div class="wrap-c fs-18 fw-6">
			<?php _e( twac( $settings, "direct" ) )?>
		</div>
	</div>
</div>