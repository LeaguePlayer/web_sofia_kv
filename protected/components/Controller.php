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


	//for seo
	public $meta_html;

	//for link in main menu
	public $action = null;

	public $cs;

	protected $forceCopyAssets = false;

	protected $assetsUrl;

	protected function preinit()
	{
		parent::preinit();
	}

	public function init(){
		parent::init();
		
		$cs = Yii::app()->clientScript;
		$cs->registerCoreScript('jquery');

		//Change theme
		Yii::app()->theme = 'sofia';

		if(Yii::app()->getRequest()->getParam('update_assets')) $this->forceCopyAssets = true;

		//Css initialize
		/*<link rel="stylesheet" href="<?=$this->themeUrl?>/css/ui-lightness/jquery-ui-1.10.3.custom.min.css" />
		<link rel="stylesheet" href="<?=$this->themeUrl?>/css/chosen.css" />
		<link rel="stylesheet" href="<?=$this->themeUrl?>/css/reset.css" />
		<link rel="stylesheet" href="<?=$this->themeUrl?>/css/buttons.css" />
		<link rel="stylesheet" href="<?=$this->themeUrl?>/css/style.css" />*/
		$cs->registerCssFile($this->getAssetsUrl().'/css/ui-lightness/jquery-ui-1.10.3.custom.min.css');
		$cs->registerCssFile($this->getAssetsUrl().'/css/reset.css');
		$cs->registerCssFile($this->getAssetsUrl().'/css/style.css?v=15');
		$cs->registerCssFile($this->getAssetsUrl().'/css/buttons.css');
		$cs->registerCssFile($this->getAssetsUrl().'/css/chosen.css');
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

/*	protected function beforeAction($action){

		return parent::beforeAction($action);
	}*/

	public function getAssetsUrl()
    {
    	
	    if(defined('YII_DEBUG') && YII_DEBUG){
	        $this->forceCopyAssets = true;
	    }
        if (Yii::app()->getRequest()->getParam('update_assets') || !isset($this->assetsUrl))
        {
            $assetsPath = Yii::getPathOfAlias('webroot.themes.'.Yii::app()->theme->name.'.assets');
            $this->assetsUrl = Yii::app()->assetManager->publish($assetsPath, false, -1, $this->forceCopyAssets);
        }
        return $this->assetsUrl;
    }

	public function beforeRender($view)
    {
    	//check active action for link on main menu
		$criteria = new CDbCriteria();
		$criteria->addCondition('active=1');
		$criteria->order = 'sort';

		$this->action = Action::model()->find($criteria);

        $this->renderPartial('//layouts/clips/_main_menu'); 

        return parent::beforeRender($view);
    }

    protected function addMetaTags($model, $other_title = ''){
    	//add seo meta tags
		if($model->asa('seo')){
			
			if($model->meta_title) $this->pageTitle = $model->meta_title;
			elseif($other_title) $this->pageTitle = $model->{$other_title};

			if($model->meta_keys) Yii::app()->clientScript->registerMetaTag($model->meta_keys, 'keys');
			if($model->meta_desc) Yii::app()->clientScript->registerMetaTag($model->meta_desc, 'description');

			if($model->meta_html) $this->meta_html = $model->meta_html;
			
    	}elseif($other_title){
    		
    	}
    }

}