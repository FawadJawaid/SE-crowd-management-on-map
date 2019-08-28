<?php

class formAddEmailAlert extends CFormModel {
    
    public $alert_type,
            $icm_website_unq_id;
    
    public function rules() {
        return array(
            array('icm_website_unq_id,alert_type','required')
        );
    }
}
?>
