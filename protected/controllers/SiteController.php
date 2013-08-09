<?php

class SiteController extends Controller
{
    public function filters(){
        return CMap::mergeArray(parent::filters(),array(
            array(
                'COutputCache',
                'duration'=>15*60, // 15 minutes
                'dependency'=>array( // Cache depends on this sql query
                    'class'=>'system.caching.dependencies.CDbCacheDependency',
                    'sql'=>'SELECT MAX(update_time) FROM tbl_question',
                ),
                'varyByParam'=>array('lang'), // Vary cache output by language
                'varyByExpression'=>"Yii::app()->user->hasState('demoUserId')", // Vary cache if in demo mode
                'requestTypes'=>array('GET'), // And by request type (important for index page form)
            ),
        ));
    }

    public function accessRules(){
        return array(
            array(
                'deny',
                'actions' => array('quiz'),
                'users'   => array('?'),
            ),
            array(
                'allow',
                'actions' => array('quiz'),
                'users'   => array('@'),
            ),
        );
    }

    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page'=>array(
                'class' => 'CViewAction',
            ),
        );
    }
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex(){
		$this->pageTitle = Yii::t('poll', 'Welcome');
		
		if(!isset($_GET['lang']))
			$this->redirect('lv/index');

		// Login Form
		$control = new FaceControl;
		if (isset($_POST['FaceControl'])) {
			
			$control->attributes = $_POST['FaceControl'];

			if($control->validate()){

				$gIdent = new GuestIdentity($control->name, 'jUnk_p@ssw0rd');

                // Avoid admin login as respondent and its logout from dashboard
				Yii::app()->user->checkAccess('admin') or $gIdent->authenticate();
				Yii::app()->user->setState('age', $control->age);
				
				$this->redirect($this->createUrl('site/quiz', array('lang' => $this->getLang())));
			}
		}
		$this->render('facecontrol_test', array('model'=> $control));
	}

	public function actionQuiz(){
		$this->pageTitle = Yii::t('poll', 'Poll');
		
		//$questions = Question::model()->with('customVariant', 'answerVariant')->findAll();
		$questions = Question::model()->with('everyVariant')->findAll();

		if(isset($_POST['UserAnswer'])){
			
			$transaction = Yii::app()->db->beginTransaction();
			
			$user = new User;
			$user->reg_date = new CDbExpression("date('now')");
			$user->name = Yii::app()->user->name;
			$user->age = Yii::app()->user->age;
			$valid = $user->save();
			
			foreach ($questions as $i => $junkValue) {
				
				if(isset($_POST['UserAnswer'][$i])){
					$uAnswer = new UserAnswer;
					$uAnswer->u_id = $user->id;
					$uAnswer->av_id = $_POST['UserAnswer'][$i]['av_id'];
					$valid = $uAnswer->save() && $valid;
				}
				if(!empty($_POST['CustomContent'][$i]['custom_content'])){
					$custom = new CustomContent;
					$custom->av_id = $uAnswer->av_id;
					$custom->custom_content = $_POST['CustomContent'][$i]['custom_content'];
					$valid = $custom->save() && $valid;
				}
			}
			if($valid){ 
				$transaction->commit();
				Yii::app()->request->redirect($this->createUrl('site/page', array(
                    'view'=>'thanks',
				    'lang' => $this->getLang()
                )));
			}
			else
				$transaction->rollback();

			Yii::app()->user->logout();
		}

		$this->render('quiz_test', array('questions'=>$questions));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->redirect(Yii::app()->homeUrl);
		}
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

}