<?php if( !empty($result) && !empty($result->events) ){
	$cursor =  $result->cursor;
?>
	<?php foreach ($result->events as $row): ?>


		<div class="widget-item widget-item-3 search-list <?php _e( segment(4) == $row->id?"active":"" ) ?>" data-pid="<?php _e( $row->id )?>" data-cursor="<?php _e( $cursor )?>" data-account="<?php _e( segment(3) )?>">
			 <a href="<?php _e( get_module_url("index/".segment(3)."/".$row->id) )?>" class="actionItem" data-result="html" data-content="column-two" data-history="<?php _e( get_module_url("index/".segment(3)."/".$row->id) )?>" data-call-after="Layout.tooltip();">
                <div class="icon"><img src="<?php _e( $row->profile_image_url_https )?>"></div>
                <div class="content content-2">
                    <div class="title fw-4"><?php _e( $row->name?$row->name:$row->screen_name )?></div>
                    <div class="desc"><?php _e( $row->thread->text )?></div>
                </div>
            </a>
			
			<div class="widget-option">
				<label class="i-radio i-radio--tick i-radio--brand m-t-6">
					<input type="radio" name="account[]" class="check-item" <?php _e( segment(4) == $row->id?"checked":"" ) ?> value="<?php _e( $row->id )?>" >
					<span></span>
				</label>
			</div>
		</div>
	<?php endforeach ?>

<?php }else{?>
	<div class="empty small"></div>
<?php }?>