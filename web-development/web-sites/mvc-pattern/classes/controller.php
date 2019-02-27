<?php
class Controller{

	private $request = null;
	private $template = '';

	/**
	 * Konstruktor, erstellet den Controller.
	 *
	 * @param Array $request Array aus $_GET & $_POST.
	 */
	public function __construct($request){
		$this->request = $request;
		$this->template = !empty($request['view']) ? $request['view'] : 'default';
	}

	/**
	 * Methode zum anzeigen des Contents.
	 *
	 * @return String Content der Applikation.
	 */
	public function display(){
		$view = new View();
		switch($this->template){
			case 'entry':
				$view->setTemplate('entry');
				$entryid = $this->request['id'];
				$entry = Model::getEntry($entryid);
				$view->assign('title', $entry['title']);
				$view->assign('content', $entry['content']);
				break;

			case 'default':
			default:
				$entries = Model::getEntries();
				$view->setTemplate('default');
				$view->assign('entries', $entries);
		}
		return $view->loadTemplate();
	}
}
?>
