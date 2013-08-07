<?php
/**
 * Class AnswerVariant
 * Model to store answer variants
 *
 * @package poll
 * @author raucher <myplace4spam@gmail.com>
 */

class AnswerVariant extends CActiveRecord{

    public $is_custom = 0;

	public static function model($className = __CLASS__){
		return parent::model($className);
	}

	public function tableName(){ return 'tbl_answer_variant'; }

	public function rules(){
		return array(
				array('lv_text, ru_text, q_id', 'required'),
				array('is_custom', 'boolean'),
			);
	}

	public function relations(){
		return array(
				'customContent' => array(self::HAS_MANY, 'CustomContent', 'av_id',
										'condition' => "customContent.custom_content <> 'No Answer'",
										),
				'userAnswer'    => array(self::HAS_MANY, 'UserAnswer', 'av_id'),
				'answerCount'   => array(self::STAT, 'UserAnswer', 'av_id'),
				'question'      => array(self::BELONGS_TO, 'Question', 'q_id'),
			);
	}

	public function answerPercentage(){
		if (isset($this->answerCount))
			return round(($this->answerCount/(User::model()->count() + 39))*100, 2);
		else
			return false;
	}

    public function attributeLabels()
    {
        return array(
            'is_custom'=>'Custom',
            'ru_text'=>'RU content',
            'lv_text'=>'LV content',
        );
    }

}

?>