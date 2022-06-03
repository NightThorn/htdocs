<div class="tab-pane fade" id="v-pills-filter" role="tabpanel" aria-labelledby="v-pills-filter-tab">
	
	<div class="row">

		<div class="col-md-4 col-sm-6 m-b-25">
			<div class="tw-ac-option wrap-m">
				<div class="info wrap-c">
					<span class="p-r-5"><?php _e("Media age")?> </span>
					<i class="fa fa-question-circle" data-toggle="tooltip-custom" data-trigger="hover" data-placement="top" data-html="true" title="" data-original-title="<?php _e("This setting will help you to choose an age of media you want to interact with. From the newest one to the oldest.", false)?>"></i>
				</div>
				<div class="action wrap-c">
					<select class="form-control action-save" name="filters[media_age]">
					<option <?php twav($a, "filters", "media_age", "") ?> value=""><?php _e("Any")?></option>
  					<option <?php twav($a, "filters", "media_age", "new") ?> value="new"><?php _e("Newest")?></option>
					<option <?php twav($a, "filters", "media_age", "1h") ?> value="1h"><?php _e("1 Hour")?></option>
					<option <?php twav($a, "filters", "media_age", "12h") ?> value="12h"><?php _e("12 hours")?></option>
					<option <?php twav($a, "filters", "media_age", "1d") ?> value="1d"><?php _e("1 day")?></option>
					<option <?php twav($a, "filters", "media_age", "3d") ?> value="3d"><?php _e("3 days")?></option>
					<option <?php twav($a, "filters", "media_age", "1w") ?> value="1w"><?php _e("1 week")?></option>
					<option <?php twav($a, "filters", "media_age", "2w") ?> value="2w"><?php _e("2 weeks")?></option>
					<option <?php twav($a, "filters", "media_age", "1m") ?> value="1m"><?php _e("1 month")?></option>
  				</select>
				</div>

			</div>
		</div>

		<div class="col-md-4 col-sm-6 m-b-25">
			<div class="tw-ac-option wrap-m">
				<div class="info wrap-c">
					<span class="p-r-5"><?php _e("Min. likes filter")?> </span>
					<i class="fa fa-question-circle" data-toggle="tooltip-custom" data-trigger="hover" data-placement="top" data-html="true" title="" data-original-title="<?php _e("Interact only with media that have minimum selected amount of likes.<br/><br/>Use it along with <b>Max. favorites filter</b> to set desired range of media popularity.<br/><br/>Recommended value: 0.<br/><br/>Set to zero to disable this filter.", false)?>"></i>
				</div>
				<div class="action wrap-c">
					<input type="number" class="form-control action-save" name="filters[min_favorite]" value="<?php twav($a, "filters", "min_favorite")?>">
				</div>
			</div>
		</div>

		<div class="col-md-4 col-sm-6 m-b-25">
			<div class="tw-ac-option wrap-m">
				<div class="info wrap-c">
					<span class="p-r-5"><?php _e("Max. likes filter")?> </span>
					<i class="fa fa-question-circle" data-toggle="tooltip-custom" data-trigger="hover" data-placement="top" data-html="true" title="" data-original-title="<?php _e("Interact only with media that have maximum selected amount of likes.<br/><br/>Use it along with <b>Min. favorites filter</b> to set desired range of media popularity.<br/><br/>Recommended values: 50-100.<br/><br/>Set to zero to disable this filter.", false)?>"></i>
				</div>
				<div class="action wrap-c">
					<input type="number" class="form-control action-save" name="filters[max_favorite]" value="<?php twav($a, "filters", "max_favorite")?>">
				</div>
			</div>
		</div>

		<div class="col-md-4 col-sm-6 m-b-25">
			<div class="tw-ac-option wrap-m">
				<div class="info wrap-c">
					<span class="p-r-5"><?php _e("Min. retweets filter")?> </span>
					<i class="fa fa-question-circle" data-toggle="tooltip-custom" data-trigger="hover" data-placement="top" data-html="true" title="" data-original-title="<?php _e("Interact only with media that have minimum selected amount of retweets.<br/><br/>Use it along with <b>Max. retweets filter</b> to set desired range of media popularity.<br/><br/>Recommended value: 0.<br/><br/>Set to zero to disable this filter.", false)?>"></i>
				</div>
				<div class="action wrap-c">
					<input type="number" class="form-control action-save" name="filters[min_retweet]" value="<?php twav($a, "filters", "min_retweet")?>">
				</div>
			</div>
		</div>

		<div class="col-md-4 col-sm-6 m-b-25">
			<div class="tw-ac-option wrap-m">
				<div class="info wrap-c">
					<span class="p-r-5"><?php _e("Max. retweets filter")?> </span>
					<i class="fa fa-question-circle" data-toggle="tooltip-custom" data-trigger="hover" data-placement="top" data-html="true" title="" data-original-title="<?php _e("Interact only with media that have maximum selected amount of retweets.<br/><br/>Use it along with <b>Min. retweets filter</b> to set desired range of media popularity.<br/><br/>Recommended values: 20-50.<br/><br/>Set to zero to disable this filter.", false)?>"></i>
				</div>
				<div class="action wrap-c">
					<input type="number" class="form-control action-save" name="filters[max_retweet]" value="<?php twav($a, "filters", "max_retweet")?>">
				</div>
			</div>
		</div>

		<div class="col-md-4 col-sm-6 m-b-25">
			<div class="tw-ac-option wrap-m">
				<div class="info wrap-c">
					<span class="p-r-5"><?php _e("Min. followers filter")?> </span>
					<i class="fa fa-question-circle" data-toggle="tooltip-custom" data-trigger="hover" data-placement="top" data-html="true" title="" data-original-title="<?php _e("Interact only with users that have minimum selected amount of followers.<br/><br/>Use it along with <b>Max. followers filter</b> to set desired range of users popularity.<br/><br/>Recommended values: 0-50.<br/><br/>Set to zero to disable this filter.", false)?>"></i>
				</div>
				<div class="action wrap-c">
					<input type="number" class="form-control action-save" name="filters[min_follower]" value="<?php twav($a, "filters", "min_follower")?>">
				</div>
			</div>
		</div>

		<div class="col-md-4 col-sm-6 m-b-25">
			<div class="tw-ac-option wrap-m">
				<div class="info wrap-c">
					<span class="p-r-5"><?php _e("Max. followers filter")?> </span>
					<i class="fa fa-question-circle" data-toggle="tooltip-custom" data-trigger="hover" data-placement="top" data-html="true" title="" data-original-title="<?php _e("Interact only with users that have maximum selected amount of followers.<br/><br/>Use it along with <b>Min. followers filter</b> to set desired range of users popularity.<br/><br/>Recommended values: 500-1000.<br/><br/>Set to zero to disable this filter.", false)?>"></i>
				</div>
				<div class="action wrap-c">
					<input type="number" class="form-control action-save" name="filters[max_follower]" value="<?php twav($a, "filters", "max_follower")?>">
				</div>
			</div>
		</div>

		<div class="col-md-4 col-sm-6 m-b-25">
			<div class="tw-ac-option wrap-m">
				<div class="info wrap-c">
					<span class="p-r-5"><?php _e("Min. followings filter")?> </span>
					<i class="fa fa-question-circle" data-toggle="tooltip-custom" data-trigger="hover" data-placement="top" data-html="true" title="" data-original-title="<?php _e("Interact only with users that have minimum selected amount of followings.<br/><br/>Use it along with <b>Max. followings filter</b> to set desired range of users popularity.<br/><br/>Recommended values: 50-100.<br/><br/>Set to zero to disable this filter.", false)?>"></i>
				</div>
				<div class="action wrap-c">
					<input type="number" class="form-control action-save" name="filters[min_following]" value="<?php twav($a, "filters", "min_following")?>">
				</div>
			</div>
		</div>

		<div class="col-md-4 col-sm-6 m-b-25">
			<div class="tw-ac-option wrap-m">
				<div class="info wrap-c">
					<span class="p-r-5"><?php _e("Max. followings filter")?> </span>
					<i class="fa fa-question-circle" data-toggle="tooltip-custom" data-trigger="hover" data-placement="top" data-html="true" title="" data-original-title="<?php _e("Interact only with users that have maximum selected amount of followings.<br/><br/>Use it along with <b>Min. followings filter</b> to set desired range of users popularity.<br/><br/>Recommended values: 300-500.<br/><br/>Set to zero to disable this filter.", false)?>"></i>
				</div>
				<div class="action wrap-c">
					<input type="number" class="form-control action-save" name="filters[max_following]" value="<?php twav($a, "filters", "max_following")?>">
				</div>
			</div>
		</div>

		<div class="col-md-4 col-sm-6 m-b-25">
			<div class="tw-ac-option wrap-m">
				<div class="info wrap-c">
					<span class="p-r-5"><?php _e("User profile filter")?> </span>
					<i class="fa fa-question-circle" data-toggle="tooltip-custom" data-trigger="hover" data-placement="top" data-html="true" title="" data-original-title="<?php _e("This filter will help you to avoid inappropriate and unwanted users and their media during your activity:<br/><br/><b>Off</b> — Filter is turned off.<br/><br/><b>Low</b> — Excludes users who have no avatar or have no posted media.<br/><br/><b>Medium</b> — Excludes users who have no avatar, have less than 10 posted media or have no name in the profile.<br/><br/><b>High</b> — Excludes users who have no avatar, have less than 30 posted media, have no name in the profile or have no bio.", false)?>"></i>
				</div>
				<div class="action wrap-c">
					<select class="form-control action-save" name="filters[user_profile]">
  					<option <?php twav($a, "filters", "user_profile", "") ?> value=""><?php _e("Off")?></option>
					<option <?php twav($a, "filters", "user_profile", "low") ?> value="low"><?php _e("Low")?></option>
					<option <?php twav($a, "filters", "user_profile", "medium") ?> value="medium"><?php _e("Medium")?></option>
					<option <?php twav($a, "filters", "user_profile", "high") ?> value="high"><?php _e("High")?></option>
  				</select>
				</div>
			</div>
		</div>

	</div>

</div>	