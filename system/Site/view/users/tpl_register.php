<!-- CONTENT -->
<div id="content">
    <div class="container">
        <div id="main">



			<div class="row">
            

			<?php $this->renderFeedbackMessages(); ?>

			
	<h2>Regisztráció</h2>
	<!-- register form -->
	<form action="" method="POST" id="register_user" name="registerform">	

		<div class="form-group">
			<label for="name" class="control-label">Felhasználó név<span class="required">*</span></label>
			<input type="text" name="user_name" id="user_name" placeholder="minimum hat karakter, ékezetek nélkül" class="form-control input-xlarge" />
		</div>
		
	<!--
		<div class="form-group">
			<label for="last_name" class="control-label">Vezetéknév</label>
			<input type="text" name="first_name" id="last_name" placeholder="" class="form-control input-xlarge" />
		</div>
		<div class="form-group">
			<label for="first_name" class="control-label">Keresztnév</label>
			<input type="text" name="last_name" id="first_name" placeholder="" class="form-control input-xlarge" />
		</div>
	-->
		
		<div class="form-group">
			<label for="email" class="control-label">E-mail cím<span class="required">*</span></label>
			<input type="text" placeholder="" name="user_email" id="user_email" class="form-control input-xlarge" />
		</div>
		
		<div class="form-group">
			<label for="password" class="control-label">Jelszó<span class="required">*</span></label>
			<input type="password" id="password" name="password" class="form-control input-xlarge"/>
		</div>	
		<div class="form-group">
			<label for="password_again" class="control-label">Jelszó ismétlése<span class="required">*</span></label>
			<input type="password" name="password_again" id="password_again" class="form-control input-xlarge" />
		</div>

		<div class="checkbox">
			<label>	
				<input type="checkbox" value="1" name="user_newsletter" id="user_newsletter">
				Kérek hírlevelet
			</label>
		</div>

		<br />

		<!-- Ezt majd css-ben kell eltüntetni!! -->
		<input type="hidden"  name="security_name" />
		
		<input type="submit"  value="Elküld" class="btn btn-primary"/>

	</form>			
			
			
			
			
			</div> <!-- row vége -->
    
        </div>
    </div>

    <div class="bottom-wrapper">
        <div class="bottom container">
            <div class="bottom-inner row">
                <div class="item span4">
                    <div class="address decoration"></div>
                    <h2><a>Regisztrálj az oldalunkon</a></h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla accumsan dui ac nunc imperdiet rhoncus. Aenean vitae imperdiet lectus</p>
                    <a href="#" class="btn btn-primary">Regisztrálok</a>
                </div><!-- /.item -->

                <div class="item span4">
                    <div class="gps decoration"></div>
                    <h2><a>Figyeld a munkákat</a></h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla accumsan dui ac nunc imperdiet rhoncus. Aenean vitae imperdiet lectus</p>
                    <a href="#" class="btn btn-primary">Munkák</a>
                </div><!-- /.item -->

                <div class="item span4">
                    <div class="key decoration"></div>
                    <h2><a>Jelentkezz munkára</a></h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla accumsan dui ac nunc imperdiet rhoncus. Aenean vitae imperdiet lectus</p>
                    <a href="#" class="btn btn-primary">Jelentkezés</a>
                </div><!-- /.item -->
            </div><!-- /.bottom-inner -->
        </div><!-- /.bottom -->
    </div><!-- /.bottom-wrapper -->    </div><!-- /#content -->
</div><!-- /#wrapper-inner -->