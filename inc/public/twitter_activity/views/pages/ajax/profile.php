<?php 
$account = $result->account;
$feed = $result->feed;
$activity = $result->activity;
$page = $result->maxId;

if($account && $activity){
	if( tw_get_setting("save_count", 0, $activity->id) ){
		$media_gained = $account->statuses_count - twac( $activity->settings, "media_count" );
		$follower_gained = $account->followers_count - twac( $activity->settings, "follower_count" );
		$following_gained = $account->friends_count - twac( $activity->settings, "following_count" );
	}else{
		$media_gained = 0;
		$follower_gained = 0;
		$following_gained = 0;
	}


	if($media_gained > 0){
		$media_gained = "+".$media_gained;
	}else if($media_gained < 0){
		$media_gained = $media_gained;
	}else{
		$media_gained = "";
	}

	if($follower_gained > 0){
		$follower_gained = "+".$follower_gained;
	}else if($follower_gained < 0){
		$follower_gained = $follower_gained;
	}else{
		$follower_gained = "";
	}

	if($following_gained > 0){
		$following_gained = "+".$following_gained;
	}else if($following_gained < 0){
		$following_gained = $following_gained;
	}else{
		$following_gained = "";
	}
}else{
	$media_gained = "";
	$follower_gained = "";
	$following_gained = "";
}

?>

<?php if($account && $activity){?>
<div class="col-md-12">
	
	<div class="tw-ac-profile-info row">
	
		<div class="col-md-6 m-b-25">
			<div class="fw-6 m-b-5"><?php _e( $account->name )?></div>
			<div class="m-b-5"><?php _e( $account->description )?></div>
			<div class=""><a href="<?php _e( $account->url )?>"><?php _e( $account->url )?></a></div>
		</div>
		<div class="col-md-6 tw-ac-profile-info-count">
			<div class="row">
				<div class="col m-b-30">
					<div class="item">
						<div class="num">
							<span class="text-info"><?php _e( $account->statuses_count )?></span>
							<span class="small <?php _e( stripos($media_gained, "+") === FALSE?"text-danger":"text-success" )?>"><?php _e( $media_gained )?></span>
						</div>
						<div class="text"><?php _e("Medias")?></div>
					</div>
				</div>
				<div class="col m-b-30">
					<div class="item">
						<div class="num">
							<span class="text-info"><?php _e( $account->followers_count )?></span>
							<span class="small <?php _e( stripos($follower_gained, "+") === FALSE?"text-danger":"text-success" )?>"><?php _e( $follower_gained )?></span>
						</div>
						<div class="text"><?php _e("Followers")?></div>
					</div>
				</div>
				<div class="col m-b-30">
					<div class="item">
						<div class="num">
							<span class="text-info"><?php _e( $account->friends_count )?></span>
							<span class="small <?php _e( stripos($following_gained, "+") === FALSE?"text-danger":"text-success" )?>"><?php _e( $following_gained )?></span>
						</div>
						<div class="text"><?php _e("Following")?></div>
					</div>
				</div>
			</div>
		</div>

	</div>

</div>
<?php }?>

<?php if( !empty($feed) ){ ?>

	<?php foreach ($feed as $row):?>

		<div class="text-center m-auto w-100">
			<div class="m-auto">
				<blockquote class="twitter-tweet"><p lang="en" dir="ltr">
			 		<a href="https://twitter.com/<?php _e($row->user->screen_name)?>/status/<?php _e( $row->id )?>?ref_src=twsrc%5Etfw"></a>
				</blockquote>
			</div>
		</div>

		<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

	<?php endforeach ?>

</div>

<?php }else{?>

	<?php if($account && $activity){?>
		<div class="empty m-t-100 m-b-100">
			<div class="icon"></div>
		</div>
	<?php }?>

<?php }?>

<div class="next-page" data-page="<?php _e( $page )?>" ></div>