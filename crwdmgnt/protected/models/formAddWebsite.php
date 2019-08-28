<?php

class formAddWebsite extends CFormModel {

    public $unq_id,$web_url,$web_type;

    public function rules() {
        return array(
            array('unq_id,web_url,web_type', 'required'),
            array('email', 'email'),
            array('unq_id', 'length', 'max' => 100),
            array('web_url', 'url'),
            array('web_type','length','max' => 45)
        );
    }
}
?>
