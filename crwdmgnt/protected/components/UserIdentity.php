
<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 * 
 * 
 * 
 */
class UserIdentity extends CUserIdentity {

    private $_id, $_type;
    public $user_type; // user type 0- 1 admin , 2 staff , 3 -patient , 4- doctor

    /**
     * Authenticates a user.
     * @return boolean whether authentication succeeds.
     */

    public function authenticate() {
        $user = null;
        $user = Users::model()->find('LOWER(email)=?', array(strtolower($this->username)));             
        if ($user === null) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } else if (!($user->password == $this->password))
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else {
            $this->_id = $user->id;
            $this->setState("type", $user->icm_users_type_id);
            $this->errorCode = self::ERROR_NONE;
        }

        return $this->errorCode == self::ERROR_NONE;
    }

    /**
     * @return integer the ID of the user record
     */
    public function getId() {
        return $this->_id;
    }

}