<div class="modal fade" id="modal_login" tabindex="-1" role="dialog" aria-labelledby="modal_login_label">
  <div class="modal-dialog" role="document">
	<div class="modal-content">

		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="modal_login_label">Bejelentkezés</h4>
		</div>
		
		<div class="modal-body">
		
			<div id="message_login"></div>
			
			<form action="" method="POST" id="login_form" name="login_form">	
				<div class="control-group">
					<label for="user_name" class="control-label">Felhasználó név vagy E-mail cím</label>
					<input type="text" name="user_name" class="form-control input-xlarge" required />
				</div>

				<div class="control-group">
					<label for="user_password" class="control-label">Jelszó</label>
					<input type="password" name="user_password" class="form-control input-xlarge" required />
				</div>	
			</form>	

			<a href="javascript:;" title="Új jelszó kérése" id="new_pw_button">Elfelejtett jelszó!</a>
			
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-primary" id="login_submit">Bejelentkezés</button>
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Bezár</button>
		</div>
			
	</div>
  </div>
</div>