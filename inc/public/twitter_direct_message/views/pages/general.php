<?php
if (!empty($result)) {
	$cursor_id = "";
	$viewer_id = segment(4);
	$items = array_reverse($result);
	$change_id = "";
	$account_id = segment(3);
	$thread_id = segment(4);
	$avaliable_type = array("text", "link", "media");
	$item_type = "text";
	$avatars = [$account->pid => BASE . $account->avatar];
?>

	<form action="<?php _e(get_module_url("send/" . $account_id . "/" . $thread_id)) ?>" method="POST" class="actionFormInbox">
		<div class="chatbox">
			<div class="cb-loading">
				<div class="stage">
					<div class="dot-elastic"></div>
				</div>
			</div>
			<div class="cb-body" data-cursor="<?php _e($cursor_id) ?>">
				<div class="cb-wrap-body">
					<?php if (!empty($items)) {
						foreach ($items as $item) {
							$check = 0;
					?>

							<?php if (in_array("text", $avaliable_type)) { ?>
								<div class="cb-item <?php _e($viewer_id == $item->message_create->target->recipient_id ? "right" : "left") ?> thread-item-<?php _e($item->id) ?>">
									<a href="<?php _e(get_module_url("delete_item/" . $account_id . "/" . $thread_id . "/" . $item->id)) ?>" class="cb-remove actionItem"><i class="ft-trash"></i></a>

									<div class="avatar">
										<?php if ($change_id != $item->message_create->target->recipient_id) { ?>
											<img src="<?php _e(get_module_path($this, "assets/img/thumb.png")) ?>">
										<?php } ?>
									</div>

									<div class="message">
										<?php _e(nl2br($item->message_create->message_data->text)) ?>
										<div class="time"><?php _e(datetime_show($item->created_timestamp / 1000)) ?> EST</div>
									</div>
								</div>
								<div class="clearfix"></div>
						<?php $change_id = $item->message_create->target->recipient_id;
							}
						} ?>
					<?php } ?>
				</div>
			</div>
			<div class="cb-footer">
				<div class="input-group">
					<textarea class="form-control input-message" name="message" placeholder="<?php _e("Message...") ?>"></textarea>
					<div class="input-group-addon">
						<button type="submit" class="btn btn-default btn-send text-info"><i class="fas fa-paper-plane"></i></button>
						<input type="hidden" class="form-control" name="ig_send_media" id="ig_send_media" value="">
						<a class="btn btn-send-media btnOpenFileManager text-success" data-id="ig_send_media" data-select="single" data-type="image" type="button"><i class="fas fa-photo-video"></i></a>
					</div>
				</div>
			</div>
		</div>
	</form>
	<script>
		var usertime = Intl.DateTimeFormat().resolvedOptions().timeZone;
		var timestamp = <?php $item->created_timestamp / 1000 ?>;
		
	</script>
	<script type="text/javascript">
		$(function() {
			Twitter_direct_message.chatbox("<?php _e($account_id) ?>", "<?php _e($thread_id) ?>");
		});
	</script>
<?php } else { ?>
	<div class="wrap-m h-100">
		<div class="empty">
			<div class="icon"></div>
		</div>
	</div>
<?php } ?>