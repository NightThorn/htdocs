<div class="widget">

	<div class="widget-list search-list">
		<?php if (!empty($result)) { ?>



			<?php foreach ($result as $row) : ?>
				<div onclick='load("<?php echo $row->pid; ?>" , "<?php echo $row->social_network; ?>" )' class="widget-item widget-item-3 search-list">
					<a href="#">
						<div class="icon"><img src="<?php _e(BASE . get_data($row, 'avatar')) ?>"></div>
						<div class="content content-2">
							<div class="title fw-4"><?php _e(get_data($row, 'name')) ?></div>
							<div class="desc"><?php _e(ucfirst($row->social_network . " " . __($row->category))) ?></div>
						</div>
					</a>

					<div style="display: none;" class="widget-option">
						<label class="i-checkbox i-checkbox--tick i-checkbox--brand m-t-6">
							<input type="radio" name="account[]" class="check-item" <?php _e(segment(3) == "" ? "checked" : "") ?> value="">
							<span></span>
						</label>
					</div>
				</div>
			<?php endforeach ?>


		<?php } else { ?>
			<div class="empty small"></div>
			<div class="text-center">
				<a class="btn btn-info" href="<?php _e(get_url("account_manager")) ?>">
					<i class="fas fa-plus-square"></i> <?php _e("Add account") ?>
				</a>
			</div>
		<?php } ?>
	</div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
	function load($pi, $cherry) {
		console.log($pi, $cherry);
		$.ajax({
			url: "<?php echo site_url('dashboard/block_report'); ?>",
			method: "POST",
			data: {
				id: $pi,
				social: $cherry
			},
			success: function(data) {
				console.log(data)
				$(".column-two").empty().append(data);

			},
			error: function() {
				alert("Something went wrong. Please try again later.");
			}
		});
	}

	function twitter($id, $act, $text) {

		$.ajax({
			url: "<?php echo site_url('dashboard/twitter'); ?>",
			method: "POST",
			data: {
				id: $id,
				act: $act,
				text: $text
			},
			success: function(data) {
				console.log(data)

			},
			error: function() {
				alert("Something went wrong. Please try again later.");
			}
		});
	}

	function commenttoggle($id) {

		var x = document.getElementById("comment_" + $id);
		if (x.style.display === "none") {
			x.style.display = "flex";
		} else {
			x.style.display = "none";

		}
	}
</script>