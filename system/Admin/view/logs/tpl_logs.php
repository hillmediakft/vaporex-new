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
                <span>Naplózás</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE TITLE & BREADCRUMB-->
    <!-- END PAGE HEADER-->

    <div class="margin-bottom-20"></div>

    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            <!-- ÜZENETEK -->
            <div id="ajax_message"></div>                       
            <?php $this->renderFeedbackMessages(); ?>               

            <form class="horizontal-form" id="logs_form" method="POST" action="">

                <div class="portlet">
                    <div class="portlet-title">
                        <div class="caption"><i class="fa fa-user"></i>Napló bejegyzések</div>

                        <div class="actions">

                            <div class="btn-group">
                                <a data-toggle="dropdown" class="btn btn-sm default">
                                    <i class="fa fa-wrench"></i> Eszközök <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li>
                                        <a id="print_logs"><i class="fa fa-print"></i> Nyomtat </a>
                                    </li>
                                    <li>
                                        <a id="export_logs"><i class="fa fa-file-excel-o"></i> Export CSV </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="portlet-body">

                        <!-- *************************** USERS TÁBLA *********************************** -->                        

                        <table class="table table-striped table-bordered table-hover" id="logs">
                            <thead>
                                <tr class="heading">
                                    <th>Dátum</th>
                                    <th>Felhasználó</th>
                                    <th>Művelet</th>
                                    <th>Bejegyzés</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($logs as $log) { ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $log['date']; ?></td>
                                        <td><?php echo $log['first_name'] . ' ' . $log['last_name']; ?></td>
                                        <td><?php
                                            if ($log['action'] == 'update') {
                                                echo '<span class="badge badge-info badge-sm">' . $log['action'] . '</span>';
                                            } elseif ($log['action'] == 'insert') {
                                                echo '<span class="badge badge-warning badge-sm">' . $log['action'] . '</span>';
                                            } elseif ($log['action'] == 'delete') {
                                                echo '<span class="badge badge-danger badge-sm">' . $log['action'] . '</span>';
                                            }

                                            elseif ($log['action'] == 'active') {
                                                echo '<span class="badge badge-warning badge-sm">' . $log['action'] . '</span>';
                                            } elseif ($log['action'] == 'inactive') {
                                                echo '<span class="badge badge-danger badge-sm">' . $log['action'] . '</span>';
                                            }




                                            ?></td>
                                        <td><?php echo $log['message']; ?></td>
                                    </tr>
                                <?php } ?>  
                            </tbody>
                        </table>    

                    </div>
                </div>
            </form>                 
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>

</div><!-- END PAGE CONTENT-->    