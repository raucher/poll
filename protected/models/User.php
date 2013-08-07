<?php

/**
* 
*/
class User extends CActiveRecord{

	public static function model($className = __CLASS__){
		return parent::model($className);
	}

	public function tableName(){ return 'tbl_user'; }

	public function rules(){
		return array(
				array('name, age', 'required'),
				array('name', 'length', 'min'=>3, 'max'=>25),
				array('age', 'numerical'),
			);
	}
	public function attributeLabels(){}

	public function relations(){
		return array(
				'answers'=> array (self::HAS_MANY, 'UserAnswer', 'u_id'),
			);
	}

	public static function averageAge(){
		$sql = " SELECT AVG(age) FROM tbl_user ";
		return round(Yii::app()->db->createCommand($sql)->queryScalar());
	}
	public static function ageInterval($lowest, $highest){
		return self::model()->count('age BETWEEN ? AND ?', array($lowest, $highest));
	}
}

?>