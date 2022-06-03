<ul class="nav nav-tabs" role="tablist">
  	<li class="nav-item">
    	<a class="nav-link active" id="email-template-tab" data-toggle="tab" href="#email-template" role="tab" aria-controls="email-template" aria-selected="false"><?php _e("Email template")?></a>
  	</li>
</ul>
<div class="tab-content tab-border p-20">
  	<div class="tab-pane fade show active" id="email-template" role="tabpanel" aria-labelledby="email-template-tab">
  		<div class="alert alert-solid-brand">
			<?php _e("You can use following template tags within the message template:")?><br/>
			<?php _e("{website_name} - displays website_name")?><br/>
			<?php _e("{website_link} - get link website")?><br/>
			<?php _e("{invite_link} - get link invite to the team")?><br/>
		</div>

		<h5 class="fs-16 fw-4 text-info m-b-20"><i class="fas fa-caret-right"></i> <?php _e('Email invite team member')?></h5>
  		<div class="form-group">
	        <label for="email_invite_team_member_subject"><?php _e('Subject')?></label>
	        <input type="text" class="form-control" id="email_invite_team_member_subject" name="email_invite_team_member_subject" value="<?php _e( get_option('email_invite_team_member_subject', "Hello there! You received an invitation to join the team") )?>">
	  	</div>
	  	<div class="form-group">
	        <label for="email_invite_team_member_content"><?php _e('Content')?></label>
			<textarea class="form-control h-200" name="email_invite_team_member_content" id="email_invite_team_member_content"><?php _e( get_option('email_invite_team_member_content', "Hello there,  <br/><br/>You've been invited to join the team<br/><br/>Click here to join to the team {invite_link}<br/><br/>Thanks and Best Regards!"), false)?></textarea>
	  	</div>

	  	<button type="submit" class="btn btn-info"><?php _e('Submit')?></button>
  	</div>
</div>

<script type="text/javascript">
$(function(){
	Core.CKEditor("email_invite_team_member_content");
});
</script>