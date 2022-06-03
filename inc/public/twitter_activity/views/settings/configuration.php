<div class="form-group">
    <label for="facebook_client_id"><?php _e('Save log within (day):')?></label>
    <select class="form-control" name="twac_save_log">
        <?php for ( $i = 0; $i <= 365; $i++) {?>
        <option value="<?php _e( $i )?>" <?php _e( get_option('twac_save_log', 7) == $i ? "selected" : "" )?> ><?php _e( $i )?></option>
        <?php }?>
    </select>
    <span class="small text-warning"><?php _e("Set 0 to unlimited")?></span>
</div>

<div class="form-group">
    <label for="facebook_client_secret"><?php _e('Default to do')?></label>
    <div>
        <label class="i-checkbox i-checkbox--tick i-checkbox--brand m-r-10">
        	<input type="hidden" name="twac_status_like" value="0">
        	<input type="checkbox" name="twac_status_favorite" <?php _e( get_option('twac_status_favorite', 1) ? "checked" : "" ) ?> value="1"> <?php _e("Favorite")?>
        	<span></span>
        </label>
        <label class="i-checkbox i-checkbox--tick i-checkbox--brand m-r-10">
        	<input type="hidden" name="twac_status_reply" value="0">
        	<input type="checkbox" name="twac_status_reply" <?php _e( get_option('twac_status_reply', 1) ? "checked" : "" ) ?> value="1"> <?php _e("Reply")?>
        	<span></span>
        </label>
        <label class="i-checkbox i-checkbox--tick i-checkbox--brand m-r-10">
        	<input type="hidden" name="twac_status_retweet" value="0">
        	<input type="checkbox" name="twac_status_retweet" <?php _e( get_option('twac_status_retweet', 0) ? "checked" : "" ) ?> value="1"> <?php _e("Retweet")?>
        	<span></span>
        </label>
        <label class="i-checkbox i-checkbox--tick i-checkbox--brand m-r-10">
        	<input type="hidden" name="twac_status_follow" value="0">
        	<input type="checkbox" name="twac_status_follow" <?php _e( get_option('twac_status_follow', 0) ? "checked" : "" ) ?> value="1"> <?php _e("Follow")?>
        	<span></span>
        </label>
        <label class="i-checkbox i-checkbox--tick i-checkbox--brand m-r-10">
        	<input type="hidden" name="twac_status_unfollow" value="0">
        	<input type="checkbox" name="twac_status_unfollow" <?php _e( get_option('twac_status_unfollow', 0) ? "checked" : "" ) ?> value="1"> <?php _e("Unfollow")?>
        	<span></span>
        </label>
        <label class="i-checkbox i-checkbox--tick i-checkbox--brand m-r-10">
        	<input type="hidden" name="twac_status_direct" value="0">
        	<input type="checkbox" name="twac_status_direct" <?php _e( get_option('twac_status_direct', 0) ? "checked" : "" ) ?> value="1"> <?php _e("Welcome DM")?>
        	<span></span>
        </label>
  	</div>
</div>

<div class="form-group m-b-0">
    <label for="facebook_client_secret"><?php _e('Default target')?></label>
    <div>
        <label class="i-checkbox i-checkbox--tick i-checkbox--brand m-r-10">
        	<input type="hidden" name="twac_targets_tag" value="0">
        	<input type="checkbox" name="twac_targets_tag" <?php _e( get_option('twac_targets_tag', 1) ? "checked" : "" ) ?> value="1"> <?php _e("Tags")?>
        	<span></span>
        </label>
        <label class="i-checkbox i-checkbox--tick i-checkbox--brand m-r-10">
        	<input type="hidden" name="twac_targets_location" value="0">
        	<input type="checkbox" name="twac_targets_location" <?php _e( get_option('twac_targets_location', 0) ? "checked" : "" ) ?> value="1"> <?php _e("Locations")?>
        	<span></span>
        </label>
  	</div>
  	<div class="row">
  		<div class="col">
  			<div class="form-group">
			    <label for="twac_targets_follower"><?php _e('Followers')?></label>
			    <select class="form-control" name="twac_targets_follower">
                    <option value="" <?php _e( get_option('twac_targets_follower', "")==""?"selected":"") ?> ><?php _e("-")?></option>
                    <option value="user" <?php _e( get_option('twac_targets_follower', "")=="user"?"selected":"") ?> ><?php _e("Usernames")?></option>
                    <option value="me" <?php _e( get_option('twac_targets_follower', "")=="me"?"selected":"") ?> ><?php _e("My account")?></option>
                    <option value="all" <?php _e( get_option('twac_targets_follower', "")=="all"?"selected":"") ?> ><?php _e("All")?></option>
                </select>
			</div>
  		</div>
  		<div class="col">
  			<div class="form-group">
			    <label for="twac_targets_following"><?php _e('Followings')?></label>
			    <select class="form-control" name="twac_targets_following">
                    <option value="" <?php _e( get_option('twac_targets_following', "")==""?"selected":"") ?> ><?php _e("-")?></option>
                    <option value="user" <?php _e( get_option('twac_targets_following', "")=="user"?"selected":"") ?> ><?php _e("Usernames")?></option>
                    <option value="me" <?php _e( get_option('twac_targets_following', "")=="me"?"selected":"") ?> ><?php _e("My feed")?></option>
                    <option value="all" <?php _e( get_option('twac_targets_following', "")=="all"?"selected":"") ?> ><?php _e("All")?></option>
                </select>
			</div>
  		</div>
  		<div class="col">
  			<div class="form-group">
			    <label for="twac_targets_retweeter"><?php _e('Retweets')?></label>
			    <select class="form-control" name="twac_targets_retweeter">
                    <option value="" <?php _e( get_option('twac_targets_retweeter', "")==""?"selected":"") ?> ><?php _e("-")?></option>
                    <option value="user" <?php _e( get_option('twac_targets_retweeter', "")=="user"?"selected":"") ?> ><?php _e("Username posts")?></option>
                    <option value="me" <?php _e( get_option('twac_targets_retweeter', "")=="me"?"selected":"") ?> ><?php _e("My posts")?></option>
                    <option value="all" <?php _e( get_option('twac_targets_retweeter', "")=="all"?"selected":"") ?> ><?php _e("All")?></option>
                </select>
			</div>
  		</div>
  	</div>
</div>

<div class="form-group">
	<label class="fw-6"><?php _e('Default speed')?></label>
	<div class="form-group">
	    <label for="twac_speeds_level"><?php _e('Level')?></label>
	    <select class="form-control" name="twac_speeds_level">
            <option value="slow" <?php _e( get_option('twac_speeds_level', "slow")=="slow"?"selected":"") ?> ><?php _e("Slow")?></option>
            <option value="normal" <?php _e( get_option('twac_speeds_level', "normal")=="normal"?"selected":"") ?> ><?php _e("Normal")?></option>
            <option value="fast" <?php _e( get_option('twac_speeds_level', "fast")=="fast"?"selected":"") ?> ><?php _e("Fast")?></option>
        </select>
	</div>
	<label class="fw-6"><?php _e('Slow speed')?></label>
	<div class="row m-b-15">
		<div class="col">
			<label for="twac_speeds_slow_favorite"><?php _e('Favorite/hour')?></label>
		    <select class="form-control" name="twac_speeds_slow_favorite">
	            <?php for ( $i=1; $i <= 60; $i++ ) {?>
                <option value="<?php _e( $i ) ?>" <?php _e( get_option('twac_speeds_slow_favorite', 2)==$i?"selected":"" ) ?>><?php _e( $i )?></option>
                <?php }?>
	        </select>
		</div>
		<div class="col">
			<label for="twac_speeds_slow_comment"><?php _e('Reply/hour')?></label>
		    <select class="form-control" name="twac_speeds_slow_comment">
	            <?php for ( $i=1; $i <= 60; $i++ ) {?>
                <option value="<?php _e( $i ) ?>" <?php _e( get_option('twac_speeds_slow_comment', 2)==$i?"selected":"" ) ?>><?php _e( $i )?></option>
                <?php }?>
	        </select>
		</div>
		<div class="col">
			<label for="twac_speeds_slow_retweet"><?php _e('Retweet/hour')?></label>
		    <select class="form-control" name="twac_speeds_slow_retweet">
	            <?php for ( $i=1; $i <= 60; $i++ ) {?>
                <option value="<?php _e( $i ) ?>" <?php _e( get_option('twac_speeds_slow_retweet', 2)==$i?"selected":"" ) ?>><?php _e( $i )?></option>
                <?php }?>
	        </select>
		</div>
		<div class="col">
			<label for="twac_speeds_slow_follow"><?php _e('Follow/hour')?></label>
		    <select class="form-control" name="twac_speeds_slow_follow">
	            <?php for ( $i=1; $i <= 60; $i++ ) {?>
                <option value="<?php _e( $i ) ?>" <?php _e( get_option('twac_speeds_slow_follow', 2)==$i?"selected":"" ) ?>><?php _e( $i )?></option>
                <?php }?>
	        </select>
		</div>
		<div class="col">
			<label for="twac_speeds_slow_unfollow"><?php _e('Unfollow/hour')?></label>
		    <select class="form-control" name="twac_speeds_slow_unfollow">
	            <?php for ( $i=1; $i <= 60; $i++ ) {?>
                <option value="<?php _e( $i ) ?>" <?php _e( get_option('twac_speeds_slow_unfollow', 2)==$i?"selected":"" ) ?>><?php _e( $i )?></option>
                <?php }?>
	        </select>
		</div>
		<div class="col">
			<label for="twac_speeds_slow_direct"><?php _e('Welcom DM/hour')?></label>
		    <select class="form-control" name="twac_speeds_slow_direct">
	            <?php for ( $i=1; $i <= 60; $i++ ) {?>
                <option value="<?php _e( $i ) ?>" <?php _e( get_option('twac_speeds_slow_direct', 2)==$i?"selected":"" ) ?>><?php _e( $i )?></option>
                <?php }?>
	        </select>
		</div>
	</div>

	<label class="fw-6"><?php _e('Normal speed')?></label>
	<div class="row m-b-15">
		<div class="col">
			<label for="twac_speeds_normal_favorite"><?php _e('Favorite/hour')?></label>
		    <select class="form-control" name="twac_speeds_normal_favorite">
	            <?php for ( $i=1; $i <= 60; $i++ ) {?>
                <option value="<?php _e( $i ) ?>" <?php _e( get_option('twac_speeds_normal_favorite', 4)==$i?"selected":"" ) ?>><?php _e( $i )?></option>
                <?php }?>
	        </select>
		</div>
		<div class="col">
			<label for="twac_speeds_normal_comment"><?php _e('Reply/hour')?></label>
		    <select class="form-control" name="twac_speeds_normal_comment">
	            <?php for ( $i=1; $i <= 60; $i++ ) {?>
                <option value="<?php _e( $i ) ?>" <?php _e( get_option('twac_speeds_normal_comment', 4)==$i?"selected":"" ) ?>><?php _e( $i )?></option>
                <?php }?>
	        </select>
		</div>
		<div class="col">
			<label for="twac_speeds_normal_retweet"><?php _e('Retweet/hour')?></label>
		    <select class="form-control" name="twac_speeds_normal_retweet">
	            <?php for ( $i=1; $i <= 60; $i++ ) {?>
                <option value="<?php _e( $i ) ?>" <?php _e( get_option('twac_speeds_normal_retweet', 4)==$i?"selected":"" ) ?>><?php _e( $i )?></option>
                <?php }?>
	        </select>
		</div>
		<div class="col">
			<label for="twac_speeds_normal_follow"><?php _e('Follow/hour')?></label>
		    <select class="form-control" name="twac_speeds_normal_follow">
	            <?php for ( $i=1; $i <= 60; $i++ ) {?>
                <option value="<?php _e( $i ) ?>" <?php _e( get_option('twac_speeds_normal_follow', 4)==$i?"selected":"" ) ?>><?php _e( $i )?></option>
                <?php }?>
	        </select>
		</div>
		<div class="col">
			<label for="twac_speeds_normal_unfollow"><?php _e('Unfollow/hour')?></label>
		    <select class="form-control" name="twac_speeds_normal_unfollow">
	            <?php for ( $i=1; $i <= 60; $i++ ) {?>
                <option value="<?php _e( $i ) ?>" <?php _e( get_option('twac_speeds_normal_unfollow', 4)==$i?"selected":"" ) ?>><?php _e( $i )?></option>
                <?php }?>
	        </select>
		</div>
		<div class="col">
			<label for="twac_speeds_normal_direct"><?php _e('Welcom DM/hour')?></label>
		    <select class="form-control" name="twac_speeds_normal_direct">
	            <?php for ( $i=1; $i <= 60; $i++ ) {?>
                <option value="<?php _e( $i ) ?>" <?php _e( get_option('twac_speeds_normal_direct', 4)==$i?"selected":"" ) ?>><?php _e( $i )?></option>
                <?php }?>
	        </select>
		</div>
	</div>

	<label class="fw-6"><?php _e('Fast speed')?></label>
	<div class="row">
		<div class="col">
			<label for="twac_speeds_fast_favorite"><?php _e('Favorite/hour')?></label>
		    <select class="form-control" name="twac_speeds_fast_favorite">
	            <?php for ( $i=1; $i <= 60; $i++ ) {?>
                <option value="<?php _e( $i ) ?>" <?php _e( get_option('twac_speeds_fast_favorite', 6)==$i?"selected":"" ) ?>><?php _e( $i )?></option>
                <?php }?>
	        </select>
		</div>
		<div class="col">
			<label for="twac_speeds_fast_comment"><?php _e('Reply/hour')?></label>
		    <select class="form-control" name="twac_speeds_fast_comment">
	            <?php for ( $i=1; $i <= 60; $i++ ) {?>
                <option value="<?php _e( $i ) ?>" <?php _e( get_option('twac_speeds_fast_comment', 6)==$i?"selected":"" ) ?>><?php _e( $i )?></option>
                <?php }?>
	        </select>
		</div>
		<div class="col">
			<label for="twac_speeds_fast_retweet"><?php _e('Retweet/hour')?></label>
		    <select class="form-control" name="twac_speeds_fast_retweet">
	            <?php for ( $i=1; $i <= 60; $i++ ) {?>
                <option value="<?php _e( $i ) ?>" <?php _e( get_option('twac_speeds_fast_retweet', 6)==$i?"selected":"" ) ?>><?php _e( $i )?></option>
                <?php }?>
	        </select>
		</div>
		<div class="col">
			<label for="twac_speeds_fast_follow"><?php _e('Follow/hour')?></label>
		    <select class="form-control" name="twac_speeds_fast_follow">
	            <?php for ( $i=1; $i <= 60; $i++ ) {?>
                <option value="<?php _e( $i ) ?>" <?php _e( get_option('twac_speeds_fast_follow', 6)==$i?"selected":"" ) ?>><?php _e( $i )?></option>
                <?php }?>
	        </select>
		</div>
		<div class="col">
			<label for="twac_speeds_fast_unfollow"><?php _e('Unfollow/hour')?></label>
		    <select class="form-control" name="twac_speeds_fast_unfollow">
	            <?php for ( $i=1; $i <= 60; $i++ ) {?>
                <option value="<?php _e( $i ) ?>" <?php _e( get_option('twac_speeds_fast_unfollow', 6)==$i?"selected":"" ) ?>><?php _e( $i )?></option>
                <?php }?>
	        </select>
		</div>
		<div class="col">
			<label for="twac_speeds_fast_direct"><?php _e('Welcom DM/hour')?></label>
		    <select class="form-control" name="twac_speeds_fast_direct">
	            <?php for ( $i=1; $i <= 60; $i++ ) {?>
                <option value="<?php _e( $i ) ?>" <?php _e( get_option('twac_speeds_fast_direct', 6)==$i?"selected":"" ) ?>><?php _e( $i )?></option>
                <?php }?>
	        </select>
		</div>
	</div>
</div>

<div class="form-group">
    <label><?php _e('Default replies')?></label>
    <div>
        <textarea class="form-control" name="twac_default_replies"><?php _e( get_option('twac_default_comments', "Made my day\nTotally rocks!\nVery nice\nVery sweet :)\nThis is great\nSo cool\nFascinating one\nNeat-o!\nGorgeous! Love it!\nThe cutest\nBreathtaking one\nThis is awesome :)\nOutstanding one!\nWhoopee!\nMy Goodness\nThis is awesome!") )?></textarea>

        <ul class="small m-t-5">
            <li><?php _e("Add multiple replies at the same time by using new line as delimiter. You also can use spintax spinning format in your replies")?></li>
        </ul>
    </div>
</div>

<div class="form-group">
    <label> <?php _e('Default direct messages')?></label>
    <div>
        <textarea class="form-control" rows="5" name="twac_default_directs"><?php _e( get_option('twac_default_directs', "Hello {username}, How are you?\nHi {username}, How are you today?\nHi {username}, Hey, how's it going?\nHello {username}, What's up?") )?></textarea>

        <ul class="small m-t-5">
            <li><?php _e("You can use following variables in the messages:")?></li>
            <li><?php _e("{username} Media owner's username")?></li>
            <li><?php _e("{full_name} Media owner's full name. If user's full name is not set, username will be used.")?></li>
        </ul>
    </div>
</div>

<div class="form-group">
    <label> <?php _e('Default keywords')?></label>
    <div>
        <textarea class="form-control" rows="5" name="twac_default_keywords"><?php _e( get_option('twac_default_keywords', "author\nvacation\ninstaart\nnature\ntasty\nmasterpiece\ncreative\nbestoftheday\npretty\nsiblings\nclouds\npage\nthrowbackthursday\ncuddle\ninstafollow\nlovely\nshoutout\ncute\ndraw") )?></textarea>
    </div>
</div>

<div class="form-group">
    <label> <?php _e('Default tags')?></label>
    <div>
        <textarea class="form-control" rows="5" name="twac_default_tags"><?php _e( get_option('twac_default_tags', "author\nvacation\ninstaart\nnature\ntasty\nmasterpiece\ncreative\nbestoftheday\npretty\nsiblings\nclouds\npage\nthrowbackthursday\ncuddle\ninstafollow\nlovely\nshoutout\ncute\ndraw") )?></textarea>
    </div>
</div>

<div class="form-group">
    <label> <?php _e('Default tags blacklist')?></label>
    <div>
        <textarea class="form-control" rows="5" name="twac_default_tags_blacklist"><?php _e( get_option('twac_default_tags_blacklist', "sex\nxxx\nfuckyou\nvideoxxx\nnude") )?></textarea>
    </div>
</div>

<div class="form-group">
    <label> <?php _e('Default keywords blacklist')?></label>
    <div>
        <textarea class="form-control" rows="5" name="twac_default_keywords_blacklist"><?php _e( get_option('twac_default_keywords_blacklist', "sex\nfuck now\nnude") )?></textarea>
    </div>
</div>