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
            <li><span>Oldal szerkesztése</span></li>
        </ul>
    </div>
    <!-- END PAGE TITLE & BREADCRUMB-->
    <!-- END PAGE HEADER-->

    <div class="margin-bottom-20"></div>
	
	<!-- BEGIN PAGE CONTENT-->
	<div class="row">
		<div class="col-md-12">
            <form action="" id="page_update_form" name="update_page_form" method='POST'>

				<!-- BEGIN EXAMPLE TABLE PORTLET-->
				<div class="portlet">

                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-cogs"></i> 
                            <?php echo $page['title'];?> oldal szerkesztése
                        </div>
                        <div class="actions">
                            <button class="btn green btn-sm" type="submit" name="submit_update_page"><i class="fa fa-check"></i> Mentés</button>
                            <a class="btn default btn-sm" href="admin/pages"><i class="fa fa-close"></i> Mégsem</a>
                        </div>							
                    </div>                        
                                    
				    <div class="portlet-body">
                        <input type="hidden" name="page_id" id="page_id" value="<?php echo $page['id'] ?>">

                        <div class="form-group">
                            <label for="page_title">Az oldal neve</label>	
                            <input type='text' name='page_title' class='form-control' value="<?php echo $page['title'] ?>" disabled=''>
                        </div>

                        <div class="form-group">
                            <label for="page_metatitle">Az oldal címe</label>   
                            <input type='text' name='page_metatitle' class='form-control' value="<?php echo $page['metatitle'] ?>"/>
                        </div>

                        <div class="form-group">
                            <label for="page_metadescription">Az oldal leírása</label>  
                            <input type='text' name='page_metadescription' class='form-control' value="<?php echo $page['metadescription'] ?>">
                        </div>

                        <div class="form-group">
                            <label for="page_metakeywords">Kulcsszavak</label>
                            <input type='text' name='page_metakeywords' class='form-control' value="<?php echo $page['metakeywords'] ?>">
                        </div>

                        <?php if ($page['body_edit'] == 1) { ?>
                        <div class="form-group">
                            <label for="page_body">Tartalom</label>
                            <textarea type="text" name="page_body" class="form-control"><?php echo $page['body'] ?></textarea>
                        </div>
                        <?php } ?>

				    </div> <!-- END USER GROUPS PORTLET BODY-->

				</div> <!-- END USER GROUPS PORTLET-->
            </form>									
		</div> <!-- END COL-MD-12 -->
	</div> <!-- END ROW -->	
</div> <!-- END PAGE CONTENT-->