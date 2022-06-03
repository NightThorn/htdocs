<div class="tab-pane fade" id="v-pills-keyword" role="tabpanel" aria-labelledby="v-pills-keyword-tab">
	
	<div class="row m-b-25">
		<div class="col-md-12">
			<div class="tw-ac-tab-full">
				<div class="form-group">
		  			<textarea class="form-control form-add-keyword-list" placeholder="<?php _e("Enter list keyword separated by line breaks")?>"></textarea>
		  		</div>
		  		<button type="button" class="btn btn-info btn-add-keyword-list"><?php _e("Add")?></button>
		</div>
		</div>
	</div>	

	<div class="m-b-0 list-add-keyword">

		<div class="tw-ac-option-title text-info fs-18 m-b-25 wrap-m">
			<div class="wrap-c"><i class="fas fa-hashtag p-r-5"></i> <?php _e("Keywords")?></div>
			<div class="wrap-c">
				<a href="javascript:void(0);" class="btn btn-label-danger btn-sm remove-all"><i class="far fa-trash-alt"></i> <?php _e("Delete all")?></a>
			</div>
		</div>

		<?php if(!empty($keywords)){
		foreach ($keywords as $keyword) {
		?>
			<div class="tw-ac-option-item-keyword">
				<a href="javascript:void(0);" class="remove"><i class="fas fa-times-circle text-danger"></i></a> <a class="name" href="https://twitter.com/search?q=<?php echo urlencode($keyword)?>" target="_blank"><?php echo $keyword?></a>
				<input type="hidden" name="keywords[]" value="<?php echo $keyword?>">
			</div>
		<?php }}else{?>
			<div class="empty small"></div>
		<?php }?>

	</div>


</div>
