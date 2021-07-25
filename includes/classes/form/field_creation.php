<?php

namespace New_User_Form_Elementor\Classes\Form;

class Field_Creation {

    public function create_text_field($field_attributes) {
        $field_type = esc_attr($field_attributes['type']);
        $field_placeholder = esc_attr($field_attributes['placeholder']);
        $field_name = esc_attr($field_attributes['name']);

        return '<input class="nuf-field" name="' . $field_name . '" type="' . $field_type . '" placeholder="' . $field_placeholder . '"/>';
    }

    public function create_password_field($field_attributes) {
        $field_placeholder = esc_attr($field_attributes['placeholder']);
        $field_name = esc_attr($field_attributes['name']);

        return '<input class="nuf-field" name="' . $field_name . '" type="password" placeholder="' . $field_placeholder . '"/>';
    }

    public function create_textarea_field($field_attributes) {
        $field_placeholder = esc_attr($field_attributes['placeholder']);
        $field_name = esc_attr($field_attributes['name']);

        return '<textarea class="nuf-field" name="' . $field_name . '" placeholder="' . $field_placeholder . '"></textarea>';
    }

}