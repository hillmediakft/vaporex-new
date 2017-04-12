<div class="container">
	<div class="row"></div>
		<h1>Új jelszó</h1>

		<!-- echo out the system feedback (error and success messages) -->
		<?php $this->renderFeedbackMessages(); ?>

		<!-- new password form box -->
		<form method="post" action="<?php echo BASE_URL; ?>users/setnewpassword" name="new_password_form">
			<input type='hidden' name='user_name' value='<?php echo $user_name; ?>' />
			<input type='hidden' name='user_password_reset_hash' value='<?php echo $user_password_reset_hash; ?>' />
			
			<div class="form-group">
				<label for="reset_input_password_new" class="control-label">Új jelszó (legalább 6 karakter!)</label>
				<input id="reset_input_password_new" class="form-control input-xlarge" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />
			</div>
			<div class="form-group">
				<label for="reset_input_password_repeat" class="control-label">Új jelszó újra</label>
				<input id="reset_input_password_repeat" class="form-control input-xlarge" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />
			</div>
			
			<input type="submit"  class="btn btn-primary" name="submit_new_password" value="Elküld" />
		</form>

		<br />
		<a href="<?php echo URL; ?>users/login">Vissza a bejelentkező oldalra</a>
	</div>
</div>
