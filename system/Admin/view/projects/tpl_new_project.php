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
            <li><span>Referencia hozzáadása</span></li>
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

            <form action="" method="POST" id="new_project" enctype="multipart/form-data">	

                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet">

                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-cogs"></i>
                            Referencia hozzáadása
                        </div>
                        <div class="actions">
                            <button class="btn green btn-sm" type="submit"><i class="fa fa-check"></i> Mentés</button>
                            <a class="btn default btn-sm" href="admin/projects"><i class="fa fa-close"></i> Mégsem</a>
                            <!-- <button class="btn default btn-sm" name="cancel" type="button"><i class="fa fa-close"></i> Mégsem</button>-->
                        </div>
                    </div>
                    <div class="portlet-body">

                        <div class="margin-bottom-10"></div>

                        <div class="row">	
                            <div class="col-md-12">


                                <div class="tabbable-custom ">
                                    <ul class="nav nav-tabs ">
                                        <li class="active">
                                            <a href="#tab_1_1" data-toggle="tab">
                                                Kép feltöltése </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_2" data-toggle="tab">
                                                Elnevezés és leírás </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_4" data-toggle="tab">
                                                Kategória és státusz </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content"> 
                                        
                                <!-- ÜZENET DOBOZOK -->
                                <div class="alert alert-danger display-hide">
                                    <button class="close" data-close="alert"></button>
                                    <span><!-- ide jön az üzenet--></span>
                                </div>
                                <div class="alert alert-success display-hide">
                                    <button class="close" data-close="alert"></button>
                                    <span><!-- ide jön az üzenet--></span>
                                </div>
                                        
                                        
                                        <div class="tab-pane active" id="tab_1_1">


                                            <h4>Kezdő kép kiválasztása </h4>   

                                            <div id="project_image"></div>	

                                            <input type="hidden" name="img_url" id="OutputId" >

                                            <div class="margin-bottom-10"></div>

                                            <div class="clearfix"></div>
                                            <div class="alert alert-info">
                                                <i class="fa fa-info-circle"></i>
                                                Kép kiválasztásához kattintson a felső sarokban található zöld színű, nyilat ábrázoló ikonra. A képet mozgathatja, nagyíthatja és kicsinyítheti. Amikor a képet tetszés szerint beállította, kattintson a zöld körbevágás ikonra. <br>Amennyiben másik képet szeretne kiválasztani, kattintson a piros színű keresztre, majd ismét a zöld nyíl ikonra.
                                            </div>
                                            
                                            <div class="margin-bottom-10"></div>      

                                        </div> <!-- end of tab_1_1 -->

                                        <div class="tab-pane" id="tab_1_2">
                                            <div class="well well-sm">Magyar nyelvű elemek</div>
                                            <!-- TERMÉK MEGNEVEZÉSE -->	
                                            <div class="form-group">
                                                <label for="project_title" class="control-label">Megnevezés <span class="required">*</span></label>
                                                <input type="text" name="project_title" id="project_title" placeholder="" class="form-control" />
                                            </div>
                                            <!-- PROJECT LEÍRÁSA -->	
                                            <div class="form-group">
                                                <label for="project_description" class="control-label">Leírás</label>
                                                <textarea name="project_description" id="project_description" placeholder="" class="form-control input-xlarge" rows="10"></textarea>

                                            </div>

                                        </div>


                                        <div class="tab-pane" id="tab_1_4">
                                            <!-- TERMÉK KATEGÓRIA -->	
                                            <div class="form-group">
                                                <label for="project_category_id" class="control-label">Kategória <span class="required">*</span></label>
                                                <select name="project_category_id" class="form-control input-xlarge">
                                                    <option value="">Válasszon</option>
                                                    <?php foreach ($project_category_list as $value) { ?>
                                                        <option value="<?php echo $value['project_category_id']; ?>">
                                                            <?php
                                                            echo $value['project_category_name'];
                                                            ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <!-- TERMÉK STÁTUSZ -->	
                                            <div class="form-group">
                                                <label for="project_status" class="control-label">Státusz</label>
                                                <select name="project_status" class="form-control input-xlarge">
                                                    <option value="0">Inaktív</option>
                                                    <option value="1" selected>Aktív</option>
                                                    <option value="2">Kiemelt</option>
                                                </select>
                                            </div>	
                                        </div>



                                    </div> <!-- tab content end -->    

                                </div> <!-- end of tabbable-custom -->
                            </div>
                        </div>

                    </div> <!-- END PORTLET BODY-->
                </div> <!-- END PORTLET-->
            </form>


        </div> <!-- END COL-MD-12 -->
    </div> <!-- END ROW -->	
</div> <!-- END PAGE CONTENT--> 