<?php

/**
 * Class CustomContent
 * Model for custom content
 *
 * @package poll
 * @author raucher <myplace4spam@gmail.com>
 */
class CustomContent extends CActiveRecord{
	
	public static function model($className = __CLASS__){
		return parent::model($className);
	}

	public function tableName(){ return 'tbl_custom_content'; }

	public function rules(){
		return array(
					array('av_id, custom_content', 'required'),
					array('custom_content', 'filter', 'filter'=>array(new CHtmlPurifier, 'purify')),
				);
	}

	public function relations(){
		return array(
				'answerVariant' => array(self::BELONGS_TO, 'AnswerVariant', 'av_id'),
			);
	}
	
	public function primaryKey(){
		return array('av_id', 'custom_content');
	}
}

?>