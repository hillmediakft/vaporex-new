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
                <a href="adminprojects">Gyakran ismételt kérdések listája</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <span>Gyakran ismételt kérdés részletek</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE TITLE & BREADCRUMB-->
    <!-- END PAGE HEADER-->

    <div class="margin-bottom-20"></div>

    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">

            <!-- echo out the system feedback (error and success messages) -->
            <?php $this->renderFeedbackMessages(); ?>			

            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet">

                <div class="portlet-title">
                    <div class="caption"><i class="fa fa-cogs"></i>Gyik részletek</div>
                        <div class="actions">
                            <a href="admin/gyik/update_gyik/<?php echo $gyik['gyik_id'];?>" class="btn green btn-sm"><i class="fa fa-pencil"></i> Gyik szerkesztése</a>
                            <a href="admin/gyik" class="btn default btn-sm"><i class="fa fa-close"></i> Vissza a Gyik listájához</a>
                            <!-- <button class="btn default btn-sm" name="cancel" type="button">Mégsem</button>-->
                        </div> 
                </div>

                <div class="portlet-body">
                    <div class="margin-bottom-10"></div>							
                    <div class="row">
                        <div class="col-md-6">		

                            <dl class="dl-horizontal">
                            	<dt style="font-size:100%; color:grey;">Azonosító szám:</dt>
                            	<dd>#<?php echo $gyik['gyik_id'];?></dd>
                            	<div style="border-top:1px solid #E5E5E5; margin: 8px 0px;"></div>
                                        
                            	<dt style="font-size:100%; color:grey;">Kategória:</dt>
                            	<dd><?php echo $gyik['gyik_category_name'];?></dd>
                            	<div style="border-top:1px solid #E5E5E5; margin: 8px 0px;"></div>                
                                        
                             	<dt style="font-size:100%; color:grey;">Megnevezés (magyar):</dt>
                            	<dd><?php echo $gyik['gyik_title'];?></dd>
                            	<div style="border-top:1px solid #E5E5E5; margin: 8px 0px;"></div>

                            	<dt style="font-size:100%; color:grey;">Leírás (magyar):</dt>
                            	<dd><?php echo $gyik['gyik_description'];?></dd>
                            	<div style="border-top:1px solid #E5E5E5; margin: 8px 0px;"></div>
                                        
                                     
                            	<dt style="font-size:100%; color:grey;">Státusz:</dt>
                            	<dd><?php echo ($gyik['gyik_status'] == 1) ? 'Aktív' : 'Inaktív';?></dd>
                            	<div style="border-top:1px solid #E5E5E5; margin: 8px 0px;"></div>
                                <dt style="font-size:100%; color:grey;">Létrehozás dátuma:</dt>
                            	<dd><?php echo date('Y-m-d H:i', $gyik['gyik_create_timestamp']); ?></dd>
                                        
                            	<div style="border-top:1px solid #E5E5E5; margin: 8px 0px;"></div>
                                <dt style="font-size:100%; color:grey;">Módosítás dátuma:</dt>
                            	<dd><?php echo ($gyik['gyik_update_timestamp'] == 0) ? 'Nem volt módosítva' : date('Y-m-d H:i', $gyik['gyik_update_timestamp']); ?></dd>

                            </dl>										
                        </div>
                    </div>	


                </div> <!-- END USER GROUPS PORTLET BODY-->
            </div> <!-- END USER GROUPS PORTLET-->
        </div> <!-- END COL-MD-12 -->
    </div> <!-- END ROW -->	
</div> <!-- END PAGE CONTENT-->