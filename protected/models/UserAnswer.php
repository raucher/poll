<?php

/**
* 
*/
class UserAnswer extends CActiveRecord{
	
	public static function model($className = __CLASS__ ){
		return parent::model($className);
	}

	public function tableName(){ return 'tbl_user_answer'; }

	public function rules(){
		return array(
				array('av_id, u_id', 'required'),
				array('av_id', 'numerical'),
			);
	}

	public function relations(){
		return array(
				'user'          => array(self::BELONGS_TO, 'User', 'u_id'),
				'answerVariant' => array(self::BELONGS_TO, 'AnswerVariant', 'av_id'),
			);
	}
}

?>