<?php

class AdminController extends Controller{

	public $layout = '//layouts/admin';
    public $navMenu = true;

    public function actionLogin(){
        $this->pageTitle = Yii::t('poll', 'Login');
        $this->navMenu = false;

        if(Yii::app()->user->checkAccess('admin'))
            $this->redirect(array('admin/statistics'));
        
		$admin = new Admin;
		
		if(isset($_POST['Admin'])){
			$admin->attributes = $_POST['Admin'];

			if($admin->validate() && $admin->login()){
				Yii::app()->user->setFlash('loginOk', 'Your login operation is successful!');
				$this->redirect(array('statistics'));
			}
		}
		$this->render('admin_login_form', array('model' => $admin,));
	}

	public function actionStatistics(){
        $this->pageTitle = Yii::t('poll', 'Statistics');
		$userCount = User::model()->count();
		$questions = Question::model()
								->with('answerVariant.answerCount', 'customVariant.customContent')
								->findAll();

		$this->render('statistics', array(
									'questions' => $questions,
									'userCount' => $userCount,
									)
		);
	}

    public function actionAddQuestion(){
        $this->pageTitle = Yii::t('poll', 'Add Question');
        $question = new Question();
        $answer = new AnswerVariant();

        if(isset($_POST['Question'], $_POST['AnswerVariant']))
        {
            $question->attributes = $_POST['Question'];
            if($question->save())
            {
                $t = Yii::app()->db->beginTransaction();
                $valid = true;
                try
                {
                    foreach($_POST['AnswerVariant'] as $variant)
                    {
                        $newVariant = new AnswerVariant();
                        $newVariant->attributes = $variant;
                        $newVariant->q_id = $question->id;
                        $valid = $newVariant->save() && $valid;
                    }
                    if($valid)
                    {
                        $t->commit();
                        $this->redirect(array('managedata'));
                    }
                }
                catch (Exception $e)
                {
                    $t->rollback();
                }
            }
        }
        $this->render('addanswer', array(
                'question' => $question,
                'answer' => $answer,
            )
        );
    }

    public function actionChangeCredentials()
    {
        if(Yii::app()->user->hasState('demoUserId'))
            $this->redirect(array('statistics'));

        $admin = Admin::model()->findByAttributes(array(
            'id'=> (int) Yii::app()->user->getState('adminId'),
        ));

        if( isset($_POST['Admin']) )
        {
            $admin->scenario = 'changePass';
            $admin->attributes = $_POST['Admin'];
            if( $admin->validate() && $admin->saveNewCredentials() )
            {
                Yii::app()->user->setFlash('success', '<strong>Success: </strong> password changed!');
                $this->refresh();
            }
        }
        $this->render('changecredentials', array('admin'=>$admin));
    }

	public function actionManageData(){
        $this->pageTitle = Yii::t('poll', 'Manage Data');
		$dataProvider = new CActiveDataProvider('Question', array(
            'pagination'=>array(
                'pageSize'=>20,
            ),
        ));

        $this->render('manage_data', array(
			'dataProvider' => $dataProvider,
		));
	}

    public function actionUpdate($id)
    {
        $this->pageTitle = Yii::t('poll', 'Update Question');
        $model = $this->getModel($id);

        if(isset($_POST['Question'], $_POST['AnswerVariant']))
        {
            $model->attributes = $_POST['Question'];
            if($model->save())
            {
                $t = Yii::app()->db->beginTransaction();
                $valid = true;
                try
                {
                    foreach($model->everyVariant as $i => $variant)
                    {
                        $variant->attributes = $_POST['AnswerVariant'][$i];
                        $valid = $variant->save() && $valid;
                    }
                    if($valid)
                    {
                        $t->commit();
                        $this->redirect(array('managedata'));
                    }
                }
                catch (Exception $e)
                {
                    $t->rollback();
                }
            }
        }

        $this->render('update', array(
            'model'=>$model,
        ));
    }

    public function actionDelete($id)
    {
        $this->getModel($id)->delete();
        $this->redirect(array('managedata'));
    }

    public function actionLogout()
    {

        Yii::app()->user->logout();
        $this->redirect(array('admin/login'));
    }
    private function getModel($id)
    {
        return Question::model()->with('everyVariant')->findByPk($id);
    }

	public function accessRules(){
		return array(
				array(
                    'allow',
                    'roles' => array('admin'),
				),
                array(
                    'allow',
                    'actions' => array('login'),
                    'users' => array('*'),
                ),
				array(
                    'deny',
                    'users' => array('*'),
				),
			);
	}

}

?>