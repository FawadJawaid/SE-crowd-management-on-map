<?php

class formAddUser extends CFormModel {
    
    public $name,
            $email,
            $password,
            $age,
            $gender,
            $icm_users_type_id;
    
    public function rules() {
        return array(
            array('name,email,password,age,gender,icm_users_type_id','required'),
            array('email','email'),
            array('name,email,password','length','max'=>45),
            array('age','numerical')
        );
    }
}
?>
