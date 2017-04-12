<?php 
use System\Libs\Config;
use System\Libs\Auth;
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
                <a href="admin/products">Termékek listája</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li><span>Termék kategóriák</span></li>
        </ul>
    </div>
    <!-- END PAGE TITLE & BREADCRUMB-->
    <!-- END PAGE HEADER-->

    <div class="margin-bottom-20"></div>

    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">

            <!-- echo out the system feedback (error and success messages) -->
            <div id="ajax_message"></div>
            <?php $this->renderFeedbackMessages(); ?>

            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet">
                <div class="portlet-title">
                    <div class="caption"><i class="fa fa-tag"></i> Termék kategóriák</div>

                    <div class="actions">
                        <a href="admin/products/category_insert" class="btn blue btn-sm"><i class="fa fa-plus"></i> Új kategória</a>
                    </div>

                </div>
                <div class="portlet-body">

                    <div class="col-md-7">

                        <table class="table table-striped table-bordered table-hover" id="product_category">
                            <thead>
                                <tr>
                                    <th style="width: 1%">Kép</th>
                                    <th>Kategória Név</th>
                                    <th>Szülő kat.</th>
                                    <th>Termékek</th>
                                    <th style="width: 1%"></th>
                                </tr>
                            </thead>
                            <tbody>


                                <?php foreach ($all_product_category as $value) { ?>

                                    <tr class="odd gradeX">
                                        <td>
                                            <img src="<?php echo $this->url_helper->thumbPath(Config::get('categoryphoto.upload_path') . $value['product_category_photo']); ?>" alt="" />
                                        </td>
                                        <td><?php echo $value['cat_name']; ?></td>
                                        <td><?php echo (isset($value['parent_name'])) ? $value['parent_name'] : '-';?></td>
                                        <?php
                                        // megszámoljuk, hogy az éppen aktuális kategóriának mennyi eleme van a products tábla product_category_id oszlopában
                                        $counter = 0;
                                        foreach ($category_counter as $v) {
                                            if ($value['cat_id'] == $v['product_category_id']) {
                                                $counter++;
                                            }
                                        }
                                        ?>
                                        <td><?php echo $counter; ?></td>

                                        <td>									
                                            <div class="actions">
                                                <div class="btn-group">
                                                    <a class="btn btn-sm grey-steel" href="#" data-toggle="dropdown">
                                                        <i class="fa fa-cogs"></i>

                                                    </a>
                                                    <ul class="dropdown-menu pull-right">
                                                        <?php if (Auth::hasAccess('product_category.update')) { ?>  
                                                            <li><a href="admin/products/category_update/<?php echo $value['cat_id']; ?>"><i class="fa fa-pencil"></i> Szerkeszt</a></li>
                                                        <?php } ?>
                                                        <?php if (Auth::hasAccess('product_category.delete')) { ?>
                                                            <li><a href="admin/products/category_delete/<?php echo $value['cat_id']; ?>" id="delete_product_category_<?php echo $value['cat_id']; ?>"><i class="fa fa-trash"></i> Törlés</a></li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>

                                <?php } ?>	

                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-5">
                        <h4><i class="fa fa-folder-o"></i> Termék kategóriák (termékek száma)</h4>
                        <div id="tree_1" class="tree-demo">
                            <?php echo $category_tree; ?>
                        </div>
                    </div>

                </div> <!-- END USER GROUPS PORTLET BODY-->
            </div> <!-- END USER GROUPS PORTLET-->

        </div> <!-- END COL-MD-12 -->


    </div> <!-- END ROW -->	
</div> <!-- END PAGE CONTENT-->