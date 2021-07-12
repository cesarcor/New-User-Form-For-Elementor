<?php

namespace New_User_Form_Elementor\Classes\Form;

class Field_Creation {

    public function create_text_field($field_attributes) {
        $field_type = esc_attr($field_attributes['type']);
        $placeholder = esc_attr($field_attributes['placeholder']);

        return '<input class="nuf-field" type="' . $field_type . '" placeholder="' . $placeholder . '"/>';
    }

    public function create_password_field($field_attributes) {
        $placeholder = esc_attr($field_attributes['placeholder']);

        return '<input class="nuf-field" type="password" placeholder= ' . $placeholder . '/>';
    }

    public function create_textarea_field($field_attributes) {
        $placeholder = esc_attr($field_attributes['placeholder']);

        return '<textarea class="nuf-field" placeholder="' . $placeholder . '"></textarea>';
    }

}