<?php if(!empty($result)){
foreach ($result as $key => $row) {
	$data = json_decode($row->data);

	switch ($row->action) {
		case 'favorite':
			$link = "https://www.twitter.com/p/status/".$data->id;
			break;

		case 'reply':
			$link = "https://www.twitter.com/p/status/".$data->id;
			break;

		case 'retweet':
			$link = "https://www.twitter.com/p/status/".$data->id;
			break;

		case 'follow':
			$link = "https://www.twitter.com/".$data->username;
			break;

		case 'unfollow':
			$link = "https://www.twitter.com/".$data->username;
			break;

		case 'direct':
			$link = "https://www.twitter.com/".$data->username;
			break;

		default:
			$link = "https://www.twitter.com/";
			break;
	}
?>
<div class="col-md-4 col-sm-6 m-b-30">
	<div class="item">
		<div class="item-info">
			<div class="time"><?=time_elapsed_string($row->created)?></div>
			<div class="action">
				<div class="type"><?php _e( twaa( $row->action )->text )?></div>
				<div class="id"><?php _e( is_numeric( $data->id ) ? $data->username : $data->id )?></div>
			</div>
		</div>
		<a href="<?php _e( $link )?>" target="_blank">
			<div class="box-img">
				<img src="<?php _e( get_data($data, "image")?get_data($data, "image"):get_module_path($this, "assets/img/thumb.png") )?>">
				<div class="icon"><i class="<?php _e( twaa($row->action)->icon )?>"></i></div>
			</div>
		</a>
	</div>
</div>
<?php }}else{
	if($page == 0){
?>
<div class="empty m-t-100 m-b-100">
	<div class="icon"></div>
</div>
<?php }}?>