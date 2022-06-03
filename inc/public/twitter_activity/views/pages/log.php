<div class="tw-ac-settings">
	<?php include "box/menu.php"?>

	<div class="tw-ac-log">
		
		<ul class="tw-ac-log-memu">
			
			<li><?php _e("Show:")?></li>
			<li class="<?php _e( segment(5)==""?"active":"" )?>" ><a href="<?php _e( get_module_url("page/log/".segment(4)) )?>" class="tw-ac-log-type" data-type=""><?php _e("All")?></a></li>
			<li class="<?php _e( segment(5)=="favorite"?"active":"" )?>" ><a href="<?php _e( get_module_url("page/log/".segment(4))."/favorite" )?>" class="tw-ac-log-type" data-type="favorite"><?php _e("Favorites")?></a></li>
			<li class="<?php _e( segment(5)=="reply"?"active":"" )?>" ><a href="<?php _e( get_module_url("page/log/".segment(4))."/reply" )?>" class="tw-ac-log-type" data-type="reply"><?php _e("Reply")?></a></li>
			<li class="<?php _e( segment(5)=="retweet"?"active":"" )?>" ><a href="<?php _e( get_module_url("page/log/".segment(4))."/retweet" )?>" class="tw-ac-log-type" data-type="retweet"><?php _e("Retweets")?></a></li>
			<li class="<?php _e( segment(5)=="follow"?"active":"" )?>" ><a href="<?php _e( get_module_url("page/log/".segment(4))."/follow" )?>" class="tw-ac-log-type" data-type="follow"><?php _e("Follows")?></a></li>
			<li class="<?php _e( segment(5)=="unfollow"?"active":"" )?>" ><a href="<?php _e( get_module_url("page/log/".segment(4))."/unfollow" )?>" class="tw-ac-log-type" data-type="unfollow"><?php _e("Unfollows")?></a></li>
			<li class="<?php _e( segment(5)=="direct"?"active":"" )?>" ><a href="<?php _e( get_module_url("page/log/".segment(4))."/direct" )?>" class="tw-ac-log-type" data-type="direct"><?php _e("Welcome DM")?></a></li>

		</ul>

		<div class="tw-ac-log-items row ajax-load-log" data-type="<?php _e( segment(5) )?>" data-id="<?php _e( segment(4) )?>" data-page="0" data-load-type="scroll" data-scroll=".twitter-activity.content-one-column">

			<div class="fa-5x m-auto m-t-100">
			  <i class="fas fa-spinner fa-spin text-info"></i>
			</div>

		</div>

	</div>


</div>