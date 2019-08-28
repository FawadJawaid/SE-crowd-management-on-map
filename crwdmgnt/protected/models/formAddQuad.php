<?php

class formAddQuad extends CFormModel {

    public $div_id;

    public function rules() {
        return array(
            array('div_id', 'required'),
        );
    }
}
?>
