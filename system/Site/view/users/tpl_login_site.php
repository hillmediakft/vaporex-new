<!-- CONTENT -->
<div id="content">
    <div class="container">
        <div id="main">



			<div class="row">
            
			<?php $this->renderFeedbackMessages(); ?>


			

	<h2>Bejelentkezés</h2>
	
	<!-- login form -->
	<form action="" method="POST" id="login_user" name="loginform">	

		<div class="form-group">
			<label for="name" class="control-label">Felhasználó név<span class="required">*</span></label>
			<input type="text" name="user_name" id="user_name" placeholder="minimum hat karakter, ékezetek nélkül" class="form-control input-xlarge" />
		</div>
		
		<div class="form-group">
			<label for="password" class="control-label">Jelszó<span class="required">*</span></label>
			<input type="password" id="user_password" name="user_password" class="form-control input-xlarge"/>
		</div>	
		
		<!-- Ezt majd css-ben kell eltüntetni!! -->
		<input type="hidden"  name="security_name" value="security_name" />
		
		<input type="submit"  name="login_site_user" value="Bejelentkezés" class="btn btn-primary"/>

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




















<div class="container">
	<div class="row">
		<div class="col-md-6">

			<!-- echo out the system feedback (error and success messages) -->
			<?php $this->renderFeedbackMessages(); ?>


				<h2>Bejelentkezés</h2>
				<!-- register form -->
				
					<form action="" method="POST" id="login_user" name="loginform">	
		
						<div class="form-group">
							<label for="name" class="control-label">Felhasználó név<span class="required">*</span></label>
							<input type="text" name="user_name" id="user_name" placeholder="minimum hat karakter, ékezetek nélkül" class="form-control input-xlarge" />
						</div>
						
						<div class="form-group">
							<label for="password" class="control-label">Jelszó<span class="required">*</span></label>
							<input type="password" id="user_password" name="user_password" class="form-control input-xlarge"/>
						</div>	
						
						<!-- Ezt majd css-ben kell eltüntetni!! -->
						<input type="hidden"  name="security_name" value="security_name" />
						
						<input type="submit"  name="login_site_user" value="Bejelentkezés" class="btn btn-primary"/>

					</form>
	<br /><br />

		</div>
	</div>
</div>