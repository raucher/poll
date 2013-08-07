<?php
/**
 *social.php
 *
 * @author Ovidiu Pop <matricks@webspider.ro>
 * @copyright 2011 Binary Technology
 * @license released under dual license BSD License and LGP License
 * @package social
 * @version 0.1
 */

class social extends CInputWidget
{
	public $networks = array();
	/**
	 * @var string buttons alignment - horizontal, vertical
	 */
	public $style='horizontal';//vertical
	/**
	 * @var array available social network buttons 
	 */
	public $networksDefault = array(
		'twitter'=>array(
			'data-via'=>'', //http://twitter.com/#!/YourPageAccount if exists else leave empty
			'width' => 120,
		), 
		'googleplusone'=>array(
			"size"=>"medium",
			"annotation"=>"bubble",
		), 
		'facebook'=>array(
			'href'=>'http://www.facebook.com/page',//asociate your page http://www.facebook.com/page 
			'action'=>'recommend',//recommend
			'colorscheme'=>'light',
			'width'=>'200',
			),
		'draugiem'=>array(
			'width' => 84,
			'height' => 20,
			'frameBorder' => 0,
			'title' => '',
			'url' => '',
			'titlePrefix' => '',
		), 
	);

	/**
	 * The extension initialisation
	 *
	 * @return nothing
	 */

	public function init()
	{
		self::filterParams();
		self::registerFiles();
		self::renderSocial();
	}
	
	private function filterParams(){
		foreach($this->networks as $k => $v){
			if(is_numeric($k)){
				unset($this->networks[$k]);
				$this->networks[$v] = array();
			}
		}
		foreach($this->networksDefault as $defKey => $defVal){
			if(array_key_exists($defKey, $this->networks)){
				$this->networks[$defKey] = array_merge($defVal, $this->networks[$defKey]);
			}
		}
	}

	/**
	 * Register assets file
	 *
	 * @return void
	 */
	private function registerFiles()
	{
		$assets = dirname(__FILE__).'/assets';
		$baseUrl = Yii::app()->assetManager->publish($assets);

		if(is_dir($assets)){
			Yii::app()->clientScript->registerCssFile($baseUrl . '/social.css');
		}else
			throw new Exception(Yii::t('social - Error: Couldn\'t find assets folder to publish.'));

		if(array_key_exists('googleplusone', $this->networks))
			Yii::app()->clientScript->registerScriptFile('https://apis.google.com/js/plusone.js?parsetags=explicit', CClientScript::POS_HEAD);
	}

	/**
	 * Render social extension
	 *
	 * @return nothing
	 */
	private function renderSocial(){
		$rendered = '';
		foreach($this->networks as $network => $params)
			$rendered .= $this->render($network, array('params' => $params), true);
		echo $this->render('social', array('rendered'=>$rendered));
	}
}

?>