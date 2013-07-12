<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/simple';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	public $themeUrl;

	public function init(){
		parent::init();
		
	}

	//Get Clip
	public function getClip($name){
		if (isset($this->clips[$name])) return $this->clips[$name];
		return '';
	}

	//Check home page
	public function is_home(){
		return (Yii::app()->controller->getId().'/'.Yii::app()->controller->getAction()->getId()) == 'site/index';
	}

	protected function beforeAction($action){

		//Change theme
		Yii::app()->theme = 'sofia';
		$this->themeUrl = Yii::app()->theme->baseUrl;

		return parent::beforeAction($action);
	}

	public function beforeRender($view)
    {
        $this->renderPartial('//layouts/clips/_main_menu'); 

        return parent::beforeRender($view);
    }
}