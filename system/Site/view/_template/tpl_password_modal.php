<div style="display:none;" class="modal" id="modal_password" tabindex="-1" role="dialog" aria-labelledby="modal_password_label">
  <div class="modal-dialog" role="document">
	<div class="modal-content">

		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="modal_password_label">Új jelszó kérése</h4>
		</div>
		
		<div class="modal-body">
		
			<div id="message_password"></div>
			
			<form action="" method="POST" id="password_form" name="password_form">	
				<div class="control-group">
					<label for="user_email" class="control-label">E-mail cím</label>
					<input type="text" placeholder="" name="user_email" class="form-control input-xlarge" />
				</div>
			</form>	

		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-primary" id="password_submit">Új jelszó kérése</button>
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Bezár</button>
		</div>
			
	</div>
  </div>
</div>