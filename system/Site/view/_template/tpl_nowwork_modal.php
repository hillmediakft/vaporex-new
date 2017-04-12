<div style="display:none;" class="modal fade" id="modal_nowwork" tabindex="-1" role="dialog" aria-labelledby="modal_nowwork_label">
  <div class="modal-dialog" role="document">
	<div class="modal-content">

		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="modal_nowwork_label">Most akarok dolgozni!</h4>
		    <p>Lorem ipsum dolor sit amet...</p> 
        </div>
            		
		<div class="modal-body">
                     
			<div id="message_nowwork"></div>

			<form action="" method="POST" id="nowwork_form" name="nowwork_form">	
				
				<div class="control-group">
					<label for="from_name" class="control-label">Név</label>
					<input type="text" name="from_name" class="form-control input-xlarge" />
				</div>
				<div class="control-group">
					<label for="from_email" class="control-label">E-mail cím</label>
					<input type="text" name="from_email" class="form-control input-xlarge" />
				</div>
				<div class="control-group">
					<label for="from_telefon" class="control-label">Telefonszám</label>
					<input type="text" name="from_telefon" class="form-control input-xlarge" />
				</div>
				<div class="control-group">
					<label for="from_message" class="control-label">Üzenet</label>
                    <textarea name="from_message" class="form-control input-xlarge" ></textarea>
				</div>

				<!-- Ezt majd css-ben kell eltüntetni!! -->
				<!-- <input type="hidden"  name="security_name" />-->
			</form>	

		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-primary" id="nowwork_submit">Elküld</button>
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Bezár</button>
		</div>
			

	</div>
  </div>
</div>