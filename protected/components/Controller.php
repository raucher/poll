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
	//public $layout='//layouts/column1';
	public $layout='//layouts/quiz_main';
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

	public function getLang(){
		$languages = Yii::app()->params['languages'];
		
		if(isset($_GET['lang']) && in_array( $_GET['lang'], $languages, true))
			return $_GET['lang'];
		else
			return 'lv';
	}

	public function init(){
		Yii::app()->language = $this->getLang();
		parent::init();
	}
	public function tr($message='', $category=''){
		return Yii::t($category, $message);
	}

    public function filters()
    {
        return array(
            'accessControl',
            'setDemoFlash',
        );
    }

    public function filterSetDemoFlash($fChain)
    {
        if(Yii::app()->user->hasState('demoUserId'))
        {
            Yii::app()->user->setFlash('warning',
                '<strong>You are in Demo Mode!</strong>
                 You can administrate site within the dashboard and changes will be applied to
                 frontend until you log off!');
        }
        $fChain->run();
    }

}