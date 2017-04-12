<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <!-- 
        <h3 class="page-title">
                Munka <small>hozzáadása</small>
        </h3>
        -->

        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="admin/home">Kezdőoldal</a> 
                    <i class="fa fa-angle-right"></i>
                </li>
                <li><span>Gyakori kérdés hozzáadása</span></li>
            </ul>
        </div>

        <!-- END PAGE TITLE & BREADCRUMB-->
        <!-- END PAGE HEADER-->

        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">

                <!-- ÜZENETEK -->
                <div id="message"></div> 
                <?php $this->renderFeedbackMessages(); ?>			

                <form action="" method="POST" id="new_gyik" enctype="multipart/form-data">	



                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet">

                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-cogs"></i>
                                Gyakori kérdés hozzáadása
                            </div>
                            <div class="actions">
                                <button class="btn green btn-sm" type="submit"><i class="fa fa-check"></i> Mentés</button>
                                <a class="btn default btn-sm" href="admin/gyik"><i class="fa fa-close"></i> Mégsem</a>
                                <!-- <button class="btn default btn-sm" name="cancel" type="button"><i class="fa fa-close"></i> Mégsem</button>-->
                            </div>
                        </div>
                        <div class="portlet-body">

                            <div class="space10"></div>							
                            <div class="row">	
                                <div class="col-md-12">

                                    <!-- ÜZENET DOBOZOK -->
                                    <div class="alert alert-danger display-hide">
                                        <button class="close" data-close="alert"></button>
                                        <span><!-- ide jön az üzenet--></span>
                                    </div>
                                    <div class="alert alert-success display-hide">
                                        <button class="close" data-close="alert"></button>
                                        <span><!-- ide jön az üzenet--></span>
                                    </div>




                                    <!-- TERMÉK MEGNEVEZÉSE -->	
                                    <div class="form-group">
                                        <label for="gyik_title" class="control-label">Kérdés <span class="required">*</span></label>
                                        <input type="text" name="gyik_title" id="gyik_title" placeholder="" class="form-control" />
                                    </div>
                                    <!-- MUNKA LEÍRÁSA -->	
                                    <div class="form-group">
                                        <label for="gyik_description" class="control-label">Válasz</label>
                                        <textarea name="gyik_description" id="gyik_description" placeholder="" class="form-control input-xlarge" rows="10"></textarea>

                                    </div>

                                    <!-- TERMÉK KATEGÓRIA -->	
                                    <div class="form-group">
                                        <label for="gyik_category_id" class="control-label">Kategória <span class="required">*</span></label>
                                        <select name="gyik_category_id" class="form-control input-xlarge">
                                            <option value="">Válasszon</option>
                                            <?php foreach ($gyik_category_list as $value) { ?>
                                                <option value="<?php echo $value['gyik_category_id']; ?>">
                                                    <?php
                                                    echo $value['gyik_category_name'];
                                                    ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <!-- TERMÉK STÁTUSZ -->	
                                    <div class="form-group">
                                        <label for="gyik_status" class="control-label">Státusz</label>
                                        <select name="gyik_status" class="form-control input-xlarge">
                                            <option value="0">Inaktív</option>
                                            <option value="1" selected>Aktív</option>
                                        </select>
                                    </div>	
                                </div>
                            </div>

                        </div> <!-- END PORTLET BODY-->
                    </div> <!-- END PORTLET-->
                </form>


            </div> <!-- END COL-MD-12 -->
        </div> <!-- END ROW -->	
    </div> <!-- END PAGE CONTENT-->    
</div> <!-- END PAGE CONTENT WRAPPER -->
</div><!-- END CONTAINER -->