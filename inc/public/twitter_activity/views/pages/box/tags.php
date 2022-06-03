<div class="tab-pane fade" id="v-pills-tag" role="tabpanel" aria-labelledby="v-pills-tag-tab">
	
	<div class="row m-b-25">
		<div class="col-md-12">
			<div class="tab-content" id="myTabContent">
			  	<div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
			  		<div class="form-group">
			  			<textarea class="form-control form-add-tag-list" placeholder="<?php _e("Enter list hashtags separated by line breaks")?>"></textarea>
			  		</div>
			  		<button type="button" class="btn btn-info btn-add-tag-list"><?php _e("Add")?></button>
			  	</div>
			</div>
		</div>
	</div>	

	<div class="m-b-0 list-add-tag">

		<div class="tw-ac-option-title text-info fs-18 m-b-25 wrap-m">
			<div class="wrap-c"><i class="fas fa-hashtag p-r-5"></i> <?php _e("Tags")?></div>
			<div class="wrap-c">
				<a href="javascript:void(0);" class="btn btn-label-danger btn-sm remove-all"><i class="far fa-trash-alt"></i> <?php _e("Delete all")?></a>
			</div>
		</div>

		<?php if(!empty($tags)){
		foreach ($tags as $tag) {
		?>
			<div class="tw-ac-option-item-tag">
				<a href="javascript:void(0);" class="remove"><i class="fas fa-times-circle text-danger"></i></a> <a class="name" href="https://twitter.com/search?q=%23<?php _e( urlencode($tag) )?>" target="_blank"><?php echo $tag?></a>
				<input type="hidden" name="tags[]" value="<?php echo $tag?>">
			</div>
		<?php }}else{?>
			<div class="empty small"></div>
		<?php }?>

	</div>

</div>