<?php 
if(!empty( $result )){
?>

	<?php 
		foreach ($result as $row) {
	?>
	<div class="tw-ac-option-item-list">
		<label class="i-checkbox i-checkbox--tick i-checkbox--brand m-b-0">
			<input type="checkbox" value="<?php _e($row->name)?>|<?php _e($row->screen_name)?>"> <a href="https://twitter.com/<?php _e($row->screen_name)?>" target="_blank"><img src="<?php _e( $row->profile_image_url_https )?>">  <?php _e($row->name)?></a><span></span>
		</label>
	</div>
	<?php }?>

	<div class="m-t-15">
		<button type="button" class="btn btn-info btn-add-username"><?php _e("Add")?></button>
	</div>

<?php }?>
