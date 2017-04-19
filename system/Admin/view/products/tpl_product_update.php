<div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="admin/home">Kezdőoldal</a> 
                <i class="fa fa-angle-right"></i>
            </li>
            <li><span>Termék szerkesztése</span></li>
        </ul>
    </div>
    <!-- END PAGE TITLE & BREADCRUMB-->
    <!-- END PAGE HEADER-->

    <div class="margin-bottom-20"></div>

    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">

            <!-- ÜZENETEK -->
            <div id="ajax_message"></div> 
            <?php $this->renderFeedbackMessages(); ?>			

            <form action="" method="POST" id="update_product" enctype="multipart/form-data">	

                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet">

                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-cogs"></i>
                            Termék szerkesztése
                        </div>
                        <div class="actions">
                            <button class="btn green btn-sm" type="submit"><i class="fa fa-check"></i> Mentés</button>
                            <a class="btn default btn-sm" href="admin/products"><i class="fa fa-close"></i> Mégsem</a>
                            <!-- <button class="btn default btn-sm" name="cancel" type="button"><i class="fa fa-close"></i> Mégsem</button>-->
                        </div>
                    </div>
                    <div class="portlet-body">

                        <div class="margin-bottom-10"></div>

                        <div class="row">	
                            <div class="col-md-12">

                                <div id="product_image"></div>	

                                <input type="hidden" name="img_url" id="OutputId">

                                <input type="hidden" id="old_img"  value="<?php echo $this->getConfig('productphoto.upload_path') . $actual_product['product_photo']; ?>" name="old_img">

                                <div class="margin-bottom-10"></div>
                                
                                <div class="clearfix"></div>
                                <div class="alert alert-info">
                                    <i class="fa fa-info-circle"></i>
                                    Kép kiválasztásához kattintson a felső sarokban található zöld színű, nyilat ábrázoló ikonra. A képet mozgathatja, nagyíthatja és kicsinyítheti. Amikor a képet tetszés szerint beállította, kattintson a zöld körbevágás ikonra. <br>Amennyiben másik képet szeretne kiválasztani, kattintson a piros színű keresztre, majd ismét a zöld nyíl ikonra.
                                </div>
                                
                                <div class="margin-bottom-10"></div>



                                <!-- bootstrap file upload 
                                <div class="form-group">
                                    <label class="control-label">Termék kép</label>
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="<?php // echo Config::get('productphoto.upload_path') . $actual_product['product_photo'];  ?>" alt=""/></div>
                                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                        <div>
                                            <span class="btn default btn-file"><span class="fileupload-new">Kiválasztás</span><span class="fileupload-exists">Módosít</span><input id="uploadprofile" class="img" type="file" name="upload_product_photo"></span>
                                            <a href="#" class="btn btn-warning fileupload-exists" data-dismiss="fileupload">Töröl</a>
                                        </div>
                                    </div>

                                    <div class="space10"></div>
                                    <div class="clearfix"></div>
                                    <div class="controls">
                                        <span class="label label-danger">INFO</span>
                                        <span>Kattintson a kiválasztás gombra! Ha másik képet szeretne kiválasztani, kattintson a megjelenő módosít gombra! Ha mégsem kívánja a kiválasztott képet feltölteni, kattintson a töröl gombra!</span>
                                    </div>
                                    <div class="space10"></div>
                                    <div class="space10"></div>
                                </div>
                                 bootstrap file upload END -->                                    

                                <!-- TERMÉK MEGNEVEZÉSE -->	
                                <div class="form-group">
                                    <label for="product_title" class="control-label">Megnevezés<span class="required">*</span></label>
                                    <input type="text" name="product_title" id="product_title" class="form-control input-xlarge" value="<?php echo $actual_product['product_title']; ?>"/>
                                </div>

                                <!-- TERMÉK LEÍRÁSA -->	
                                <div class="form-group">
                                    <label for="product_description" class="control-label">Leírás</label>
                                    <textarea name="product_description" id="product_description" placeholder="" class="form-control input-xlarge" rows="10"><?php echo $actual_product['product_description']; ?></textarea>
                                </div>

                                <!-- TERMÉK KATEGÓRIA -->	
                                <div class="form-group">
                                    <label for="product_category_id" class="control-label">Kategória <span class="required">*</span></label>
                                    <select name="product_category_id" class="form-control input-xlarge">
                                        <option value="">Válasszon</option>
                                        <?php foreach ($product_category_list_with_path as $value) { ?>
                                            <?php
                                            // ha van alkategóriája ennek a ketagóriának, akkor nem jelenik meg
                                            if ($value['children'] === true) {
                                                continue;
                                            }
                                            ?>
                                            <option value="<?php echo $value['cat_id']; ?>" <?php echo ($actual_product['product_category_id'] == $value['cat_id']) ? 'selected' : ''; ?>>
                                                <?php echo $value['category_path']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <!-- TERMÉK ÁRA -->	
                                <div class="form-group">
                                    <label for="product_price" class="control-label">Egységár<span class="required">*</span></label>
                                    <input type="text" name="product_price" id="product_price" value="<?php echo $actual_product['product_price']; ?>" class="form-control input-xlarge" />
                                </div>

                                <!-- TERMÉK ÁFA -->	
                                <div class="form-group">
                                    <label for="product_tax" class="control-label">ÁFA kulcsa</label>
                                    <select name="product_tax" class="form-control input-xlarge">
                                        <option value="27" <?php echo ($actual_product['product_tax'] == 27) ? 'selected' : ''; ?>>27%</option>
                                        <option value="18" <?php echo ($actual_product['product_tax'] == 18) ? 'selected' : ''; ?>>18%</option>
                                        <option value="5" <?php echo ($actual_product['product_tax'] == 5) ? 'selected' : ''; ?>>5%</option>
                                        <option value="0" <?php echo ($actual_product['product_tax'] == 0) ? 'selected' : ''; ?>>0%</option>
                                    </select>
                                </div>  

                                <!-- TERMÉK STÁTUSZ -->	
                                <div class="form-group">
                                    <label for="product_status" class="control-label">Státusz</label>
                                    <select name="product_status" class="form-control input-xlarge">
                                        <option value="0" <?php echo ($actual_product['product_status'] == 0) ? 'selected' : ''; ?>>Inaktív</option>
                                        <option value="1" <?php echo ($actual_product['product_status'] == 1) ? 'selected' : ''; ?>>Aktív</option>

                                    </select>
                                </div>										

                            </div>
                        </div>	

                    </div> <!-- END USER GROUPS PORTLET BODY-->
                </div> <!-- END USER GROUPS PORTLET-->
            </form>


        </div> <!-- END COL-MD-12 -->
    </div> <!-- END ROW -->	
</div> <!-- END PAGE CONTENT-->    
