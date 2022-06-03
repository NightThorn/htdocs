<?php
$a = false;
$status = 0;
$settings = [];
if($activity){
	$a = $activity->data;
	$settings = $activity->settings;
	$status = $activity->status;
}


$directs = twav($a, "directs");
$replies = twav($a, "replies");
$reposts = twav($a, "reposts");
$tags = twav($a, "tags");
$keywords = twav($a, "keywords");
$usernames = twav($a, "usernames");
$blacklist_tags = twav($a, "blacklist_tags");
$blacklist_usernames = twav($a, "blacklist_usernames");
$blacklist_keywords = twav($a, "blacklist_keywords");
$schedule_days = twav($a, "schedule_days");
$schedule_default="[
	[0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23],
	[0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23],
	[0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23],
	[0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23],
	[0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23],
	[0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23],
	[0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23]
]";

$slow_level = get_option('twac_speeds_level', 'slow');

$slow_speed = [
	get_option('twac_speeds_slow_favorite', 2),
	get_option('twac_speeds_slow_reply', 2),
	get_option('twac_speeds_slow_retweet', 2),
	get_option('twac_speeds_slow_follow', 2),
	get_option('twac_speeds_slow_unfollow', 2),
	get_option('twac_speeds_slow_direct', 2)
];

$normal_speed = [
	get_option('twac_speeds_normal_favorite', 4),
	get_option('twac_speeds_normal_reply', 4),
	get_option('twac_speeds_normal_retweet', 4),
	get_option('twac_speeds_normal_follow', 4),
	get_option('twac_speeds_normal_unfollow', 4),
	get_option('twac_speeds_normal_direct', 4)
];

$fast_speed = [
	get_option('twac_speeds_fast_favorite', 6),
	get_option('twac_speeds_fast_reply', 6),
	get_option('twac_speeds_fast_retweet', 6),
	get_option('twac_speeds_fast_follow', 6),
	get_option('twac_speeds_fast_unfollow', 6),
	get_option('twac_speeds_fast_direct', 6)
];

?>

<?php if(!$activity){?>
<script type="text/javascript">
$(function(){
	Twitter_activity.save_activity();
});	
</script>
<?php }?>

<div class="tw-ac-settings">
	<?php include "box/menu.php"?>

	<form class="tw-ac-body save-action" action="<?php _e( get_module_url("save/".segment(4)) )?>" data-hide-overplay="false" method="POST">
		
		<div class="tw-ac-main">
			
			<div class="row">
				
				<div class="col-md-4">
					
					<div class="control">
						
						<div class="loading text-center wrap-c">
								<?php if(isset($activity->status) && $activity->status == "1"){?>
								<i class="tw-ac-status started far fa-clock text-info pe-spin m-auto fs-100"></i>
								<i class="tw-ac-status stopped far fa-stop-circle text-danger m-auto fs-100 d-none"></i>
								<?php }else{?>
								<i class="tw-ac-status started far fa-clock text-info pe-spin m-auto fs-100 d-none"></i>
								<i class="tw-ac-status stopped far fa-stop-circle text-danger m-auto fs-100"></i>
								<?php }?>
							
						</div>
						<div class="info">
							<div class="item-info wrap-m">
								<div class="wrap-c"><?php _e("Status")?></div>
								<?php if(isset($activity->status) && $activity->status == "1"){?>
								<span class="tw-ac-status started badge badge-success"><?php _e("Started")?></span>
								<span class="tw-ac-status stopped badge badge-danger d-none"><?php _e("Stopped")?></span>
								<span class="tw-ac-status none badge badge-dark d-none"><?php _e("No time")?></span>
								<?php }else if(isset($activity->status) && $activity->status == "0"){?>
								<span class="tw-ac-status started badge badge-success d-none"><?php _e("Started")?></span>
								<span class="tw-ac-status stopped badge badge-danger"><?php _e("Stopped")?></span>
								<span class="tw-ac-status none badge badge-dark d-none"><?php _e("No time")?></span>
								<?php }else{?>
								<span class="tw-ac-status started badge badge-success d-none"><?php _e("Started")?></span>
								<span class="tw-ac-status stopped badge badge-danger d-none"><?php _e("Stopped")?></span>
								<span class="tw-ac-status none badge badge-dark"><?php _e("No time")?></span>
								<?php }?>
							</div>							
							<div class="item-info wrap-m">
								<div class="wrap-c"><?php _e("Started on")?></div>
								<div class="wrap-c"><?php _e( (isset($activity->changed) && $activity->status != "")?datetime_show( $activity->changed ):_e("--") )?></div>
							</div>							
						</div>

						<div class="action">
							<div class="btn-group btn-group-block" role="group">
							  	<a href="<?php _e( get_module_url("start/".segment("4")) )?>" class="btn btn-secondary tw-ac-btn-start <?php _e($status==1?"d-none":"")?>"><?php _e("Start")?></a>
							  	<a href="<?php _e( get_module_url("stop/".segment("4")) )?>" class="btn btn-label-danger tw-ac-btn-stop <?php _e($status!=1?"d-none":"")?>"><?php _e("Stop")?></a>
							  	<div class="btn-group" role="group">
								    <a href="javascript:void(0);" class="btn btn-secondary open_schedule_days" data-toggle="tooltip" data-target="#schedule_days" data-placement="top" title="" data-ortwinal-title="<?php _e('Schedule')?>">
								      	<i class="far fa-calendar-alt"></i>
								    </a>
							  	</div>
							</div>
						</div>
					</div>

				</div>
				<div class="col-md-4">
					<?php include "box/todos.php"?>
				</div>
				<div class="col-md-4 recent-activity-wrap">
					<?php include "box/recent_activity.php"?>
				</div>

			</div>

		</div>

		<div class="tw-ac-options">
			
			<div class="tw-ac-tab nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
			  	<a class="active" id="v-targeting-tab" data-toggle="pill" href="#v-targeting" role="tab" aria-controls="v-targeting" aria-selected="true"><i class="fas fa-bullseye"></i> <?php _e("Targeting")?></a>
			  	<a id="v-speed-tab" data-toggle="pill" href="#v-speed" role="tab" aria-controls="v-speed" aria-selected="false"><i class="fas fa-running"></i> <?php _e("Speed")?></a>
			  	<a id="v-pills-filter-tab"  data-toggle="pill" href="#v-pills-filter" role="tab" aria-controls="v-pills-filter" aria-selected="false"><i class="fas fa-filter"></i> <?php _e("Filters")?></a>
			  	<a id="v-pills-reply-tab" data-type="reply" data-toggle="pill" href="#v-pills-reply" role="tab" aria-controls="v-pills-reply" aria-selected="false"><i class="fas fa-reply"></i> <?php _e("Replies")?></a>
			  	<a id="v-pills-follow-tab" data-type="follow" data-toggle="pill" href="#v-pills-follow" role="tab" aria-controls="v-pills-follow" aria-selected="false"><i class="fas fa-user-plus"></i> <?php _e("Follow")?></a>
			  	<a id="v-pills-unfollow-tab" data-type="unfollow" data-toggle="pill" href="#v-pills-unfollow" role="tab" aria-controls="v-pills-unfollow" aria-selected="false"><i class="fas fa-user-minus"></i> <?php _e("Unfollow")?></a>
			  	<a id="v-pills-direct-tab" data-type="direct" data-toggle="pill" href="#v-pills-direct" role="tab" aria-controls="v-pills-direct" aria-selected="false"><i class="fas fa-inbox"></i> <?php _e("Welcome DM")?></a>
			  	<a id="v-pills-tag-tab" data-toggle="pill" href="#v-pills-tag" role="tab" aria-controls="v-pills-tag" aria-selected="false"><i class="fas fa-hashtag"></i> <?php _e("Tags")?></a>
			  	<a id="v-pills-keyword-tab" data-toggle="pill" href="#v-pills-keyword" role="tab" aria-controls="v-pills-keyword" aria-selected="false"><i class="far fa-file-alt"></i> <?php _e("Keywords")?></a>
			  	<a id="v-pills-usernames-tb" data-toggle="pill" href="#v-pills-username" role="tab" aria-controls="v-pills-username" aria-selected="false"><i class="fas fa-user"></i> <?php _e("Usernames")?></a>
			  	<a id="v-pills-blacklist-tab" data-toggle="pill" href="#v-pills-blacklist" role="tab" aria-controls="v-pills-blacklist" aria-selected="false"><i class="fas fa-ban"></i> <?php _e("Blacklist")?></a>
			  	<a id="v-pills-auto-stop-tab" data-toggle="pill" href="#v-pills-auto-stop" role="tab" aria-controls="v-pills-auto-stop" aria-selected="false"><i class="far fa-stop-circle"></i> <?php _e("Auto stop")?></a>
			</div>

			<div class="tw-ac-content">
				<div class="tab-content p-t-25" id="v-pills-tabContent">
					<?php include "box/targets.php"?>
					<?php include "box/speeds.php"?>
					<?php include "box/filters.php"?>
					<?php include "box/replies.php"?>
					<?php include "box/follows.php"?>
					<?php include "box/unfollows.php"?>
					<?php include "box/directs.php"?>
					<?php include "box/tags.php"?>
					<?php include "box/keywords.php"?>
					<?php include "box/usernames.php"?>
					<?php include "box/blacklists.php"?>
				  	<?php include "box/stops.php"?>
				</div>
			</div>

			<div class="clearfix"></div>
		</div>

		<?php include "box/schedule_days.php"?>

	</form>

</div>