<?php if (!empty($groups)) { ?>
	<button style="width: 100%;" type="button" class="btn dropdown-toggle btn-label-info" data-toggle="dropdown"><i class="fas fa-users"></i> Social Groups</button>
	<div class="dropdown-menu dropdown-menu-right dropdown-menu-fit dropdown-menu-anim dropdown-menu-top-unround">
		<?php foreach ($groups as $key => $row) : ?>
			<a href="javascript:void(0);" class="dropdown-item action-groups" data-item='<?php _e(get_data($row, "data")) ?>'><i class="fas fa-caret-right"></i> <?php _e(get_data($row, "name")) ?></a>
		<?php endforeach ?>
	</div>
<?php } ?>