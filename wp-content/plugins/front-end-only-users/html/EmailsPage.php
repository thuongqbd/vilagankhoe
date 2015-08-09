<?php 
	$Admin_Email = get_option("EWD_FEUP_Admin_Email");
	$Email_Subject = get_option("EWD_FEUP_Email_Subject");
	$Message_Body = get_option("EWD_FEUP_Message_Body");
	$Admin_Approval_Message_Body = get_option("EWD_FEUP_Admin_Approval_Message_Body");
	$Email_Field = get_option("EWD_FEUP_Email_Field");
?>
<div class="wrap">
<div id="icon-options-general" class="icon32"><br /></div><h2>Email Settings</h2>

<form method="post" action="admin.php?page=EWD-FEUP-options&DisplayPage=Emails&Action=EWD_FEUP_UpdateEmailSettings">
<table class="form-table">
<th scope="row">Email Field Name</th>
<td>
	<fieldset><legend class="screen-reader-text"><span>Email Field Name</span></legend>
	<label title='Email Field Name'><input type='text' name='email_field' value='<?php echo $Email_Field; ?>' /> </label><br />
	<p>The name of the field that should be used to send the e-mail to from your registration form.</p>
	</fieldset>
</td>
</tr>
<tr>
<th scope="row">"Send-From" Email Address</th>
<td>
	<fieldset><legend class="screen-reader-text"><span>Email Address</span></legend>
	<label title='Email Address'><input type='text' name='admin_email' value='<?php echo $Admin_Email; ?>' /> </label><br />
	<p>The email address that sign-up messages should be sent from.</p>
	</fieldset>
</td>
</tr>
<tr>
<th scope="row">Registration Message Body</th>
<td>
	<fieldset><legend class="screen-reader-text"><span>Message Body</span></legend>
	<label title='Message Body'></label><textarea class='ewd-feup-textarea' name='message_body'> <?php echo $Message_Body; ?></textarea><br />
	<p>What should be in the message sent to users upon registration? You can put [username], [password], or [join-date] to include the Username, Password or sign-up datetime for the user.</p>
	</fieldset>
</td>
</tr>
<tr>
<th scope="row">Admin Approval Message Body</th>
<td>
	<fieldset><legend class="screen-reader-text"><span>Admin Approval Message Body</span></legend>
	<label title='Admin Approval Message Body'></label><textarea class='ewd-feup-textarea' name='admin_approval_message_body'> <?php echo $Admin_Approval_Message_Body; ?></textarea><br />
	<p>What should be in the message sent to users when they are approved, assuming that the option has been selected? You can put [username] or [join-date] to include the Username or sign-up datetime for the user.</p>
	</fieldset>
</td>
</tr>
<tr>
<th scope="row">Email Subject</th>
<td>
	<fieldset><legend class="screen-reader-text"><span>Email Subject</span></legend>
	<label title='Email Subject'><input type='text' name='email_subject' value='<?php echo $Email_Subject; ?>' /> </label><br />
	<p>The subject of the sign-up e-mail message.</p>
	</fieldset>
</td>
</tr>
</table>

<p class="submit"><input type="submit" name="Options_Submit" id="submit" class="button button-primary" value="Save Changes"  /></p></form>

</div>