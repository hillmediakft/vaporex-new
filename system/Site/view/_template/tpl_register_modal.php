<div style="display:none;" class="modal fade" id="modal_register" tabindex="-1" role="dialog" aria-labelledby="modal_register_label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal_register_label">Regisztráció</h4>
                <p>Megrendelés elküldéséhez regisztráció szükséges!</p> 
            </div>

            <div class="modal-body">
                <div id="message_register"></div>
                <form action="" method="POST" id="register_form" name="register_form">	
                    <div class="control-group">
                        <label for="user_name" class="control-label">Felhasználó név</label>
                        <input type="text" name="user_name" placeholder="minimum hat karakter, ékezetek nélkül" class="form-control input-xlarge" />
                    </div>
                    <div class="control-group">
                        <label for="user_email" class="control-label">E-mail cím</label>
                        <input type="text" placeholder="" name="user_email" class="form-control input-xlarge" />
                    </div>
                    <div class="control-group">
                        <label for="password" class="control-label">Jelszó</label>
                        <input type="password" id="register_password" name="password" class="form-control input-xlarge"/>
                    </div>	
                    <div class="control-group">
                        <label for="password_again" class="control-label">Jelszó ismétlése</label>
                        <input type="password" name="password_again" class="form-control input-xlarge" />
                    </div>

                    <!-- Ezt majd css-ben kell eltüntetni!! -->
                    <!-- <input type="hidden"  name="security_name" />-->
                </form>	
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="register_submit">Regisztrálok</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Bezár</button>
            </div>

        </div>
    </div>
</div>