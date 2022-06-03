<?php if( $result ){?>
<div class="item item-none-with item-user">
	<div class="dropdown">
	  	<a href="javascript:void(0);" class="btn dropdown-toggle text-success p-t-13" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    	<span class="fas fa-users fs-18"></span>
	  	</a>
	  	<div class="dropdown-menu dropdown-menu-right dropdown-menu-fit dropdown-menu-anim dropdown-menu-top-unround p-0" aria-labelledby="dropdownMenuButton">

	  		<a class="dropdown-item actionItem" href="<?php _e( get_url("team/access") )?>" data-redirect=""><i class="fas fa-user"></i> <?php _e("My account")?></a>
  			<div class="dropdown-divider m-0"></div>
  			<?php foreach ($result as $key => $row): ?>
	    		<a class="dropdown-item actionItem" href="<?php _e( get_url("team/access/".$row->ids) )?>" data-redirect=""><i class="fas fa-users"></i> <?php _e( sprintf(__("%s Team"), $row->fullname) )?></a>
  			<?php endforeach ?>

	  	</div>
	</div>
</div> 
<?php }?>