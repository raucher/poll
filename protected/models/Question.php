<?php

/**
 * Class Question
 * Model for questions and aggregated data belonging to them
 *
 * @package poll
 * @author raucher <myplace4spam@gmail.com>
 */
class Question extends CActiveRecord{

    public function behaviors()
    {
        return array(
            'timestampBehavior'=>array(
                'class'=>'zii.behaviors.CTimestampBehavior',
                'setUpdateOnCreate'=>true, // Fills update_time field when new record is created
            ),
        );
    }

	public static function model($className = __CLASS__){
		return parent::model($className); 
	}

	public function tableName(){ return 'tbl_question'; }

	public function rules(){
		return array(
				array('lv_text, ru_text', 'required'),
			);
	}

	public function relations(){
		return array(
				'answerVariant' => array(self::HAS_MANY, 'AnswerVariant', 'q_id',
											'condition' => 'answerVariant.is_custom=0',
											'together' => false,
										),
				'customVariant' => array(self::HAS_MANY, 'AnswerVariant', 'q_id',
											'condition' => 'customVariant.is_custom=1',
											'together' => false,
										),
				'everyVariant' => array(self::HAS_MANY, 'AnswerVariant', 'q_id'),
			);
	}

    public function attributeLabels()
    {
        return array(
            'ru_text'=>'RU content',
            'lv_text'=>'LV content',
        );
    }

    protected function afterDelete()
    {
        // TODO: delete unnecessary joined tables
    }
}


?>