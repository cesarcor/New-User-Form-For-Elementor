<?php

namespace New_User_Form_Elementor\Form;

use Elementor\Widget_Base;

class Form extends Widget_Base {
    
    public function get_name() {
        return 'new-user-form';
    }

    public function get_title() {
        return __('New User Form', 'new-user-form-elementor');
    }
}
