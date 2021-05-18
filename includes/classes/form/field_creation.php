<?php

namespace New_User_Form_Elementor\Classes\Form;

class Field_Creation {
    public function create_text_field($field_attributes) {
        return '<input type="' . $field_attributes['type'] . '"/>';
    }

    public function create_password_field() {
        return '<input type="password"/>';
    }

    public function create_textarea_field() {
        return '<textarea></textarea>';
    }
}
