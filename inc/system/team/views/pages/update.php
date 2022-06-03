<?php
$CI = &get_instance();
$package_manager = $CI->package_manager;
$account_manager = $CI->account_manager;
?>

<div class="subheadline wrap-m">
	
	<div class="sh-main wrap-c">
		<div class="sh-title text-info fs-18 fw-5"><i class="far fa-edit"></i> <?php _e('Member')?></div>
	</div>
	<div class="sh-toolbar wrap-c">
		<div class="btn-group" role="group">
	    	<a 
	    		class="btn btn-label-info actionItem" 
	    		data-result="html" 
	    		data-content="column-two"
	    		data-history="<?php _e( get_module_url() )?>" 
	    		data-call-after="Layout.inactive_subsidebar();" 
	    		href="<?php _e( get_module_url() )?>"
	    	>
	    		<i class="fas fa-chevron-left"></i> <?php _e('Back')?>
	    	</a>
		</div>
	</div>

</div>

<div class="m-t-10">
	<form class="actionForm" action="<?php _e( get_module_url( 'save/'.segment(4) ) )?>" data-redirect="<?php _e( get_module_url() )?>">
		
		<div class="row">
			<div class="col-md-6">
				<form>
					
				  	<?php if(empty($result)){?>
			  		<div class="form-group">
				    	<label for="proxy"><?php _e('Email')?></label>
				    	<input type="text" class="form-control" id="email" name="email" value="<?php _e( get_data($result, 'email') )?>">
				    	<div class="small m-t-5">
				    		<div class="text-info"><?php _e("Enter email of member you want invite to send request join to your team")?></div>
				    	</div>
				  	</div>
				  	<?php }?>
				  	
				  	<div class="form-group">
				    	<label for="packages"><?php _e('Permissions')?></label>
				    	<div>
				    		
				    		<?php if($package_manager){?>
							<div class="row">
								
								<div class="col-md-12">

									<div class="row">
										<div class="col-md-6">
											<ul class="list-group">
											  	<li class="list-group-item d-flex justify-content-between align-items-center">
											    	<span class="fw-6"><?php _e("Modules")?></span>
											  	</li>
											  	<?php 
												foreach ($package_manager as $key => $row): 
													$id_enable = $row['id']."_enable";
												?>

												<?php if( isset( $full_permissions->$id_enable ) && $id_enable != "post_enable" ){?>
											  	<li class="list-group-item d-flex justify-content-between align-items-center">
											    	<span><i class="<?php _e( $row['icon'] )?>"></i> <?php _e( $row['name'] )?></span>
											    	<label class="i-checkbox i-checkbox--tick i-checkbox--brand p-l-0">
														<input type="checkbox" name="permissions[<?php _e( $id_enable)?>]" <?php _e( isset( $result[$id_enable] ) ?"checked":"" )?> value="1">
														<span></span>
													</label>
											  	</li>
											  	<?php }?>

												<?php endforeach ?>
											</ul>
										</div>
										<div class="col-md-6">
											<ul class="list-group">
												<li class="list-group-item d-flex justify-content-between align-items-center">
											    	<span class="fw-6"><?php _e("Account manager")?></span>
											  	</li>
											  	<?php
												if(!empty($account_manager)){
													foreach ($account_manager as $key => $name) {
														$id_enable = "am_".$key;
												?>

												<?php if( isset( $full_permissions->$id_enable )){?>
											  	<li class="list-group-item d-flex justify-content-between align-items-center">
											    	<span><i class="far fa-user-circle"></i> <?php _e( $name )?></span>
											    	<label class="i-checkbox i-checkbox--tick i-checkbox--brand p-l-0">
														<input type="checkbox" name="permissions[am_<?php _e($key)?>]" <?php _e( isset( $result[$id_enable] ) ?"checked":"" )?> value="1"> 
														<span></span>
													</label>
											  	</li>
											  	<?php }?>


											  	<?php }}?>
											</ul>
										</div>
									</div>
									
								</div>

							</div>
							<?php }?>


				    	</div>
				  	</div>
				  	<button type="submit" class="btn btn-primary"><?php _e('Submit')?></button>
				</form>
			</div>
		</div>

	</form>

</div>