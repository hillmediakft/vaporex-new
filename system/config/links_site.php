<?php 
/*
$link['select2'] = array(
	'css' => ADMIN_ASSETS . 'plugins/select2/css/select2.css',
	'js' => ADMIN_ASSETS . 'plugins/select2/js/select2.min.js'
);


$link['datatable'] = array(
	'css' => ADMIN_ASSETS . 'plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css',
	'js' => array(
		ADMIN_ASSETS . 'plugins/datatables/media/js/jquery.dataTables.min.js',
		ADMIN_ASSETS . 'plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js',
		ADMIN_JS . 'datatable.js'
	)
);

$link['bootbox'] = array(
	'js' => ADMIN_ASSETS . 'plugins/bootbox/bootbox.min.js'
);

$link['datepicker'] = array(
	'css' => ADMIN_ASSETS . 'plugins/bootstrap-datepicker/css/datepicker.css',
	'js' => array(
		ADMIN_ASSETS . 'plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
		ADMIN_ASSETS . 'plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.hu.js'
	)
);

$link['bootstrap-fileupload'] = array(
	'css' => ADMIN_ASSETS . 'plugins/bootstrap-fileupload/bootstrap-fileupload.css',
	'js' => ADMIN_ASSETS . 'plugins/bootstrap-fileupload/bootstrap-fileupload.js'
);

$link['ckeditor'] = array(
	'js' => ADMIN_ASSETS . 'plugins/ckeditor/ckeditor.js'
);

*/

// JQuery validation
$link['validation'] = array(
	'js' => array(
		SITE_ASSETS . 'vendors/jquery-validation/jquery.validate.js',
		SITE_ASSETS . 'vendors/jquery-validation/additional-methods.min.js',
		SITE_ASSETS . 'vendors/jquery-validation/localization/messages_hu.js'
	)
);

// Google Maps
$link['google-maps-site'] = array(
	'js' => array(
		'https://maps.googleapis.com/maps/api/js?key=AIzaSyDsyHr_ERbn8TBSwHRB1mWk28VDByR-oL0'
	) 
);

$link['multiselect'] = array(
	'css' => SITE_ASSETS . 'vendors/jquery-ui-multiselect/jquery.multiselect.css',
	'js' => SITE_ASSETS . 'vendors/jquery-ui-multiselect/jquery.multiselect.js'
);

$link['bootstrap-select'] = array(
	'css' => SITE_ASSETS . 'vendors/bootstrap-select/css/bootstrap-select.css',
	'js' => SITE_ASSETS . 'vendors/bootstrap-select/js/bootstrap-select.js'
);


return $link;
?>