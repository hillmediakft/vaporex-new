<?php 
use System\Libs\Config;
?>
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
            <li>
                <a href="admin/products/categories">kategóriák listája</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li><span>Kategória módosítása</span></li>
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

            <form action="" method="POST" id="product_category_form" enctype="multipart/form-data">

                <!-- ÜZENETEK 2 -->
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span><!-- ide jön az üzenet--></span>
                </div>
                <div class="alert alert-success display-hide">
                    <button class="close" data-close="alert"></button>
                    <span><!-- ide jön az üzenet--></span>
                </div>	

                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet">

                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-film"></i> 
                            Kategória módosítása
                        </div>
                        <div class="actions">
                            <button class="btn green btn-sm" type="submit"><i class="fa fa-check"></i> Kategória módosítása</button>
                            <a href="admin/products/category" class="btn default btn-sm"><i class="fa fa-close"></i> Mégsem</a>
                            <!-- <button class="btn default btn-sm" name="cancel" type="button">Mégsem</button>-->
                        </div>
                    </div>

                    <div class="portlet-body">

                        <div class="margin-bottom-10"></div>

                        <div class="row">	
                            <div class="col-md-12">	
                                
                                
                                    <div id="product_category_image"></div>	

                                    <input type="hidden" name="img_url" id="OutputId" >

                                    <div class="margin-bottom-10"></div>

                                    <div class="clearfix"></div>
                                    <div class="alert alert-info">
                                        <i class="fa fa-info-circle"></i>
                                         Kép kiválasztásához kattintson a felső sarokban található zöld színű, nyilat ábrázoló ikonra. A képet mozgathatja, nagyíthatja és kicsinyítheti. Amikor a képet tetszés szerint beállította, kattintson a zöld körbevágás ikonra. <br>Amennyiben másik képet szeretne kiválasztani, kattintson a piros színű keresztre, majd ismét a zöld nyíl ikonra.
                                    </div>
                                    <div class="margin-bottom-10"></div> 

                                <!-- bootstrap file upload
                                <div class="form-group">
                                    <label class="control-label">Kategória kép</label>
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="<?php //echo Config::get('categoryphoto.upload_path') . $category_content[0]['product_category_photo']; ?>" alt=""/></div>
                                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                        <div>
                                            <span class="btn default btn-file"><span class="fileupload-new">Kiválasztás</span><span class="fileupload-exists">Módosít</span><input id="uploadprofile" class="img" type="file" name="upload_product_category_photo"></span>
                                            <a href="#" class="btn btn-warning fileupload-exists" data-dismiss="fileupload">Töröl</a>
                                        </div>
                                    </div>


                                    <div class="space10"></div>
                                    <div class="clearfix"></div>
                                    <div class="controls">
                                        <span class="label label-danger">INFO</span>
                                        <span>Kattintson a kiválasztás gombra! Ha másik képet szeretne kiválasztani, kattintson a módosít gombra! Ha mégsem kívánja a kiválasztott képet feltölteni, kattintson a töröl gombra!</span>
                                    </div>
                                    <div class="space10"></div>
                                    <div class="space10"></div>
                                </div>
                                 bootstrap file upload END -->									

                                <div class="form-group">
                                    <label for="product_category_name" class="control-label">Kategória neve <span class="required">*</span></label>
                                    <input type="text" name="product_category_name" id="product_category_name" value="<?php echo $category_content[0]['product_category_name'] ?>" class="form-control input-xlarge" />
                                </div>
                                

                                <div class="form-group">
                                    <label for="product_category_parent_id" class="control-label">Szülő kategória </label>
                                    <select name="product_category_parent_id" class="form-control input-xlarge">
                                        <option value="1">Termékek</option>
                                        <?php foreach ($product_category_list_with_path as $value) { ?>
                                            <option value="<?php echo $value['cat_id']; ?>">
                                                <?php
                                                echo $value['category_path'];
                                                ?>
                                            </option>
                                            <?php } ?>
                                    </select>
                                </div>   

                                <!-- régi kép neve-->
                                <input type="hidden" name="old_img" id="old_img" value="<?php echo Config::get('categoryphoto.upload_path') . $category_content[0]['product_category_photo']; ?>">
                                <!-- régi kategória neve-->
                                <input type="hidden" name="old_category" id="old_category" value="<?php echo $category_content[0]['product_category_name']; ?>">

                            </div>
                        </div>	

                    </div> <!-- END USER GROUPS PORTLET BODY-->
                </div> <!-- END USER GROUPS PORTLET-->

            </form>

        </div> <!-- END COL-MD-12 -->
    </div> <!-- END ROW -->	
</div> <!-- END PAGE CONTENT--> 