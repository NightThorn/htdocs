<div class="tab-pane fade" id="v-pills-reply" role="tabpanel" aria-labelledby="v-pills-reply-tab">
	
	<div class="row">

		<div class="col-md-4 col-sm-6 m-b-25">
			<div class="tw-ac-option wrap-m">
				<div class="info wrap-c">
					<span class="p-r-5"><?php _e("Don't reply same users")?> </span>
					<i class="fa fa-question-circle" data-toggle="tooltip-custom" data-trigger="hover" data-placement="top" data-html="true" title="" data-original-title="<?php _e("When checking this box you will not reply more than one media of the same user.", false)?>"></i>
				</div>
				<div class="action wrap-c">
					<label class="i-checkbox i-checkbox--tick i-checkbox--brand p-l-17">
					<input type="checkbox" class="action-save" name="op_replies[dont_spam]" <?php twav($a, "op_replies", "dont_spam") ?> value="1"><span></span>
				</label>
				</div>
			</div>
		</div>

	</div>

	<div class="row m-b-25">

		<div class="col-md-12">
			<div class="tw-ac-option">
				<div class="info">
					<span class="p-r-5"><?php _e("Enter your reply")?> </span>
					<i class="fa fa-question-circle" data-toggle="tooltip-custom" data-trigger="hover" data-placement="top" data-html="true" title="" data-original-title="<?php _e("Add at least one reply if you are turned on replies in your to do section.", false)?>"></i>
					<div class="form-group">
						<textarea class="form-control form-add-reply post-message"></textarea>
					</div>
					<button type="button" class="btn btn-info btn-add-reply"><?php _e("Add new")?></button>
				</div>
			</div>
		</div>

	</div>

	<div class="m-b-0 list-add-reply">

		<div class="tw-ac-option-title text-info fs-18 m-b-25 wrap-m">
			<div class="wrap-c"><i class="far fa-reply-alt p-r-5"></i> <?php _e("Replies")?></div>
			<div class="wrap-c">
				<a href="javascript:void(0);" class="btn btn-label-danger btn-sm remove-all"><i class="far fa-trash-alt"></i> <?php _e("Delete all")?></a>
			</div>
		</div>

		<?php if(!empty($replies)){
		foreach ($replies as $reply) {
		?>
		<div>
			<div class="tw-ac-option-item-reply">
				<a href="javascript:void(0);" class="remove"><i class="fas fa-times-circle text-danger"></i></a> <?php echo nl2br($reply)?>
				<textarea class="d-none" name="replies[]"><?php echo $reply?></textarea>
			</div>
		</div>
		<?php }}else{?>
			<div class="empty small"></div>
		<?php }?>
		
	</div>

</div>