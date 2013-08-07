<?php

class FaceControl extends CFormModel{
	
	public $name, $age = 25;

	public function init(){
		$this->name = Yii::t('poll', 'Anonymous user');
	}

	public function rules(){
		return array(
				array('name, age', 'required'),
				array('name', 'length', 'min'=>3, 'max'=>25),
				array('age', 'numerical'),
			);
	}

	public function attributeLabels(){
		return array(
				'name' => Yii::t('poll', 'Your name'),
				'age' => Yii::t('poll', 'Your age'),
			);
	}
	
}

?>