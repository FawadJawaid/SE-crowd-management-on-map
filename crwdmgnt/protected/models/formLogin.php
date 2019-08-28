<?php

class formLogin extends CFormModel {

    public $email, $password ,$user_type,$rememberMe=false;
    private $_identity;

    public function rules() {
        return array(
            array('email,password', 'required'),
            array('email', 'email'),
            array('password', 'length', 'max' => 120),
            array('email', 'length', 'max' => 120),
            array('password','authenticate')
        );
    }

    public function authenticate($attribute, $params) {
        $this->_identity = new UserIdentity($this->email, $this->password);
        //echo $this->user_type;
        $this->_identity->user_type = $this->user_type;
        if (!$this->_identity->authenticate())
            $this->addError('password', 'Incorrect username or password.');
    }

    public function login() {
        if ($this->_identity === null) {
            $this->_identity = new UserIdentity($this->email, $this->password);
            $this->_identity->authenticate();
        }
        if ($this->_identity->errorCode === UserIdentity::ERROR_NONE) {
            $duration = $this->rememberMe ? 3600 * 24 * 30 : 0; // 30 days
            Yii::app()->user->login($this->_identity, $duration);
            return true;
        }
        else
            return false;
    }

}

?>
