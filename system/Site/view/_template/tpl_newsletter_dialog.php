<!-- LOGIN REGISTER LINKS CONTENT -->
<div id="newsletter-dialog" class="mfp-with-anim mfp-hide mfp-dialog clearfix">
    <i class="fa fa-envelope dialog-icon"></i>
    <h3>Hírlevélre feliratkozás</h3>
<div id="message-newsletter"></div>
    <form class="dialog-form" id="newsletter-dialog-form">
        <div class="form-group">
            <label>E-mail</label>
            <input type="text" name="email" placeholder="email@domain.com" class="form-control">
        </div>
        <div class="form-group">
            <label>Név</label>
            <input type="text" name="name" placeholder="Név" class="form-control">
        </div>

        <!-- MEGYE MEGADÁSA -->	
        <div class="form-group">
            <label for="county" class="control-label">Megye <span class="required">*</span></label>
            <select name="county" id="county" class="form-control input-xlarge">
                <option value="">-- Válasszon --</option>
                <?php foreach ($county_list as $value) { ?>
                    <option value="<?php echo $value['county_id']; ?>"><?php echo $value['county_name']; ?></option>
                <?php } ?>
            </select>
        </div>

        <input type="submit" id="newsletter-submit" value="Küldés" class="btn btn-primary">
    </form>
    <div class="gap gap-top"></div>
    <p>A megadott e-mail címre küldünk egy visszaigazoló e-mail üzenetet. Az abban található linkre kattintva aktiválhatja a hírlevélre feliratkozást,</p>

</div>

