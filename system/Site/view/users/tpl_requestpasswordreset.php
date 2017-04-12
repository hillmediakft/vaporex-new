<div class="container">
	<div class="row">
		<div class="col-md-6">

			<h1>Új jelszó kérése</h1>

			<!-- echo out the system feedback (error and success messages) -->
			<?php $this->renderFeedbackMessages(); ?>

			<!-- request password reset form box -->
			<form method="post" action="<?php echo BASE_URL; ?>users/requestpasswordreset" name="password_reset_form">
				
				<div class="form-group">
					<label for="password_reset_input_username" class="control-label">
						Adja meg felhasználó nevét (majd kövesse az e-mail-ban kapott utasításokat)
					</label>
					<input id="password_reset_input_username" class="form-control input-xlarge" type="text" name="user_name" required />
				</div>
					<input type="submit" class="btn btn-primary" name="request_password_reset" value="Új jelszó kérés" />
			</form>
		</div>
	</div>
</div>
