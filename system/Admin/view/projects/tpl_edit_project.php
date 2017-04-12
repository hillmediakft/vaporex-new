<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">
            Referencia <small>módosítása</small>
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="admin/home">Kezdőoldal</a> 
                    <i class="fa fa-angle-right"></i>
                </li>
                <li><a href="#">Referencia módosítása</a></li>
            </ul>
        </div>
        <!-- END PAGE TITLE & BREADCRUMB-->
        <!-- END PAGE HEADER-->


        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">

                <div class="row">
                    <div class="col-lg-12 margin-bottom-20">
                        <a class ='btn btn-default' href='admin/references'><i class='fa fa-arrow-left'></i>  Vissza a referenciákhoz</a>
                    </div>
                </div>	

                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet">

                    <div class="portlet-body">



                        <form action='' name='update_reference_form' id='new_reference_form' method='POST'>

                            <div class="form-group">
                                <label for="reference_title">IMDb id</label>	
                                <input type="text" name="reference_title" class="form-control input-large" value="<?php echo $data_arr[0]['reference_title']; ?>"/>
                            </div>
                            <div class="form-group">
                                <label for="reference_imdb_id">IMDb id</label>	
                                <input type="text" name="reference_imdb_id" class="form-control input-large" value="<?php echo $data_arr[0]['reference_imdb_id']; ?>"/>
                            </div>



                            <input class="btn green submit" type="submit" name="submit_update_reference" value="Mentés">

                        </form>									

                    </div> <!-- END USER GROUPS PORTLET BODY-->
                </div> <!-- END USER GROUPS PORTLET-->
            </div> <!-- END COL-MD-12 -->
        </div> <!-- END ROW -->	
    </div> <!-- END PAGE CONTENT-->    
</div> <!-- END PAGE CONTENT WRAPPER -->
</div> <!-- END CONTAINER -->