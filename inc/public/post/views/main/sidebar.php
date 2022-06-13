<div class="input-group box-search-one">
	<p>Select an Account or Group</p>
	<?php _e($block_group, false) ?>

	</span>
</div>

<div class="widget">

	<div class="widget-list search-list">
		<?php if (!empty($result)) { ?>

			<?php if (!empty($post)) { ?>

				<?php foreach ($result as $row) : ?>
					<?php if ($post->account_id == $row->id) { ?>
						<div class="widget-item widget-item-3 search-list" data-pid="<?php _e(get_data($row, 'pid')) ?>">

							<a href="#">
								<div class="icon"><img src="<?php _e(BASE . get_data($row, 'avatar')) ?>"></div>
								<div class="content content-2">
									<div class="title fw-4"><?php _e(get_data($row, 'name')) ?></div>
									<div class="desc"><?php _e(ucfirst($row->social_network . " " . __($row->category))) ?></div>
								</div>
							</a>

							<div class="widget-option">
								<label class="i-checkbox i-checkbox--tick i-checkbox--brand m-t-6">
									<input type="checkbox" name="account[]" class="check-item" checked="" value="<?php _e(get_data($row, 'social_network') . "__" . get_data($row, 'ids')) ?>">
									<span></span>
								</label>
							</div>
						</div>
					<?php } ?>

				<?php endforeach ?>

			<?php } else { ?>
				<?php foreach ($result as $row) : ?>
					<div class="widget-item widget-item-3 search-list" data-pid="<?php _e(get_data($row, 'pid')) ?>">


						<a href="#">
							<?php if ($row->social_network == "twitter") { ?>
								<i class=" fab fa-twitter" style="color: #00acee; font-size: x-large; border-radius: 10px; position: absolute; left: -10px; top: 0; z-index: 1;"></i>
							<?php } ?>
							<?php if ($row->social_network == "instagram") { ?>
								<i class=" fab fa-instagram" style="color: #ac2876; font-size: x-large; border-radius: 10px; position: absolute; left: -10px; top: 0; z-index: 1;"></i>
							<?php } ?>
							<?php if ($row->social_network == "reddit") { ?>
								<i class=" fab fa-reddit" style="color: #f25206; font-size: x-large; border-radius: 10px; position: absolute; left: -10px; top: 0; z-index: 1;"></i>
							<?php } ?>
							<?php if ($row->social_network == "facebook") { ?>
								<i class=" fab fa-facebook" style="color: #3b5998; font-size: x-large; border-radius: 10px;  position: absolute; left: -10px; top: 0; z-index: 1;"></i>
							<?php } ?>
							<?php if ($row->social_network == "linkedin") { ?>
								<i class=" fab fa-linkedin" style="color: #0d77b7; font-size: x-large; border-radius: 10px;  position: absolute; left: -10px; top: 0; z-index: 1;"></i>
							<?php } ?>
							<?php if ($row->social_network == "ggs") { ?>
								<img height="30" src="https://ggspace.nyc3.cdn.digitaloceanspaces.com/uploads/photos/2022/04/gg_a542a716a5e431dbeee72402d1fcdb0b.png" style="z-index: 1; position: absolute; left: -15px; top: 0;" class="mCS_img_loaded"> <?php } ?>

							<div class="icon"><img src="<?php _e(BASE . get_data($row, 'avatar')) ?>"></div>
							<div class="content content-2">
								<div class="title fw-4"><?php _e(get_data($row, 'name')) ?></div>
								<div class="desc"><?php _e(ucfirst($row->social_network . " " . __($row->category))) ?></div>
							</div>
						</a>

						<div class="widget-option">
							<label class="i-checkbox i-checkbox--tick i-checkbox--brand m-t-6">
								<input type="checkbox" name="account[]" class="check-item" value="<?php _e(get_data($row, 'social_network') . "__" . get_data($row, 'ids')) ?>">
								<span></span>
							</label>
						</div>
					</div>
				<?php endforeach ?>

			<?php } ?>

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