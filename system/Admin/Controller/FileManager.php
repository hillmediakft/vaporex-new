<?php
namespace System\Admin\Controller;
use System\Core\AdminController;
use System\Core\View;
use System\Libs\Auth;

class FileManager extends AdminController {

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		Auth::hasAccess('filemanager.index', $this->request->get_httpreferer());

		$view = new View();
		
		$data['title'] = 'Fájlkezelő oldal';
		$data['description'] = 'Fájlkezelő oldal description';
		
		//$view->add_link('js', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js');
		//$view->add_link('css', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css');
		$view->add_links(array('jquery-ui-elfinder', 'elfinder', 'filemanager'));
		$view->render('file_manager/tpl_file_manager', $data);
	}
}
?>