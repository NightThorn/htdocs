<div class="tab-pane fade" id="v-speed" role="tabpanel" aria-labelledby="v-speed-tab">
	
	<div class="row">

		<div class="col-md-4 col-sm-6 m-b-25">
			<div class="tw-ac-option wrap-m">
				<div class="info wrap-c">
					<span class="p-r-5"><?php _e("Activity speed")?> </span>
					<i class="fa fa-question-circle" data-toggle="tooltip-custom" data-trigger="hover" data-placement="top" data-html="true" title="" data-original-title="<?php _e("<b>Slow</b> — safe speed to do about<br/><br/><b>Normal</b> — smart speed to do about<br/><br/><b>Fast</b> — supreme speed to do about<br/><br/>Try to use <b>Slow</b> speed for the beginning and then change it to <b>Normal</b> or <b>Fast</b> after several days.", false)?>"></i>
				</div>
				<div class="action wrap-c">
					<select class="form-control speed-level" name="speeds[level]">
	  					<option <?php twav($a, "speeds", "level", "slow") ?> value="slow" data-speed="[<?php _e( implode(",", $slow_speed) )?>]"><?php _e("Slow")?></option>
						<option <?php twav($a, "speeds", "level", "normal") ?> value="normal" data-speed="[<?php _e( implode(",", $normal_speed) )?>]"><?php _e("Normal")?></option>
						<option <?php twav($a, "speeds", "level", "fast") ?> value="fast" data-speed="[<?php _e( implode(",", $fast_speed) )?>]"><?php _e("Fast")?></option>
						<option <?php twav($a, "speeds", "level", "") ?> value="" disabled="" class=""><?php _e("Custom")?></option>
	  				</select>
				</div>
			</div>
		</div>

		<div class="col-md-4 col-sm-6 m-b-25">
			<div class="tw-ac-option wrap-m">
				<div class="info wrap-c">
					<span class="p-r-5"><?php _e("Likes/hour")?> </span>
					<i class="fa fa-question-circle" data-toggle="tooltip-custom" data-trigger="hover" data-placement="top" data-html="true" title="" data-original-title="<?php _e("Number of like actions that your activity will try to post in an hour.<br/><br/>Allowed values: <b>1</b>-<b>60</b><br/><br/><span class='text-danger'>Use with caution!</span>", false)?>"></i>
				</div>
				<div class="action wrap-c">
					<input type="number" class="form-control item-speed action-save" name="speeds[favorite]" value="<?php twav($a, "speeds", "favorite")?>">
				</div>
			</div>
		</div>

		<div class="col-md-4 col-sm-6 m-b-25">
			<div class="tw-ac-option wrap-m">
				<div class="info wrap-c">
					<span class="p-r-5"><?php _e("Reply/hour")?> </span>
					<i class="fa fa-question-circle" data-toggle="tooltip-custom" data-trigger="hover" data-placement="top" data-html="true" title="" data-original-title="<?php _e("Number of reply actions that your activity will try to post in an hour.<br/><br/>Allowed values: <b>1</b>-<b>20</b><br/><br/><span class='text-danger'>Use with caution!</span>", false)?>"></i>
				</div>
				<div class="action wrap-c">
					<input type="number" class="form-control item-speed action-save" name="speeds[reply]" value="<?php twav($a, "speeds", "reply")?>">
				</div>
			</div>
		</div>

		<div class="col-md-4 col-sm-6 m-b-25">
			<div class="tw-ac-option wrap-m">
				<div class="info wrap-c">
					<span class="p-r-5"><?php _e("Retweets/day")?> </span>
					<i class="fa fa-question-circle" data-toggle="tooltip-custom" data-trigger="hover" data-placement="top" data-html="true" title="" data-original-title="<?php _e("Number of retweet actions that your activity will try to post in an hour.<br/><br/>Allowed values: <b>1</b>-<b>20</b><br/><br/><span class='text-danger'>Use with caution!</span>", false)?>"></i>
				</div>
				<div class="action wrap-c">
					<input type="number" class="form-control item-speed action-save" name="speeds[retweet]" value="<?php twav($a, "speeds", "retweet")?>">
				</div>
			</div>
		</div>

		<div class="col-md-4 col-sm-6 m-b-25">
			<div class="tw-ac-option wrap-m">
				<div class="info wrap-c">
					<span class="p-r-5"><?php _e("Follows/hour")?> </span>
					<i class="fa fa-question-circle" data-toggle="tooltip-custom" data-trigger="hover" data-placement="top" data-html="true" title="" data-original-title="<?php _e("Number of Follow actions that your activity will try to post in an hour.<br/><br/>Allowed values: <b>1</b>-<b>40</b><br/><br/><span class='text-danger'>Use with caution!</span>", false)?>"></i>
				</div>
				<div class="action wrap-c">
					<input type="number" class="form-control item-speed action-save" name="speeds[follow]" value="<?php twav($a, "speeds", "follow")?>">
				</div>
			</div>
		</div>

		<div class="col-md-4 col-sm-6 m-b-25">
			<div class="tw-ac-option wrap-m">
				<div class="info wrap-c">
					<span class="p-r-5"><?php _e("Unfollows/hour")?> </span>
					<i class="fa fa-question-circle" data-toggle="tooltip-custom" data-trigger="hover" data-placement="top" data-html="true" title="" data-original-title="<?php _e("Number of Unfollow actions that your activity will try to post in an hour.<br/><br/>Allowed values: <b>1</b>-<b>40</b><br/><br/><span class='danger'>Use with caution!</span>", false)?>"></i>
				</div>
				<div class="action wrap-c">
					<input type="number" class="form-control item-speed action-save" name="speeds[unfollow]" value="<?php twav($a, "speeds", "unfollow")?>">
				</div>
			</div>
		</div>

		<div class="col-md-4 col-sm-6 m-b-25">
			<div class="tw-ac-option wrap-m">
				<div class="info wrap-c">
					<span class="p-r-5"><?php _e("Welcome DM/hour")?> </span>
					<i class="fa fa-question-circle" data-toggle="tooltip-custom" data-trigger="hover" data-placement="top" data-html="true" title="" data-original-title="<?php _e("Number of Welcome DM actions that your activity will try to post in an hour.<br/><br/>Allowed values: <b>1</b>-<b>20</b><br/><br/><span class='text-danger'>Use with caution!</span>", false)?>"></i>
				</div>
				<div class="action wrap-c">
					<input type="number" class="form-control item-speed action-save" name="speeds[direct]" value="<?php twav($a, "speeds", "direct")?>">
				</div>
			</div>
		</div>
	</div>

</div>