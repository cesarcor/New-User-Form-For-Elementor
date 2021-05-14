<?php

namespace New_User_Form_Elementor\Classes;

use Elementor\Widget_Base;
use Elementor\Repeater;

class Form extends Widget_Base {
    public function get_name() {
        return 'new-user-form';
    }

    public function get_title() {
        return __('New User Form', 'new-user-form-elementor');
    }

    public function get_categories() {
        return ['general'];
    }

    protected function _register_controls() {
        $fields_repeater = new Repeater();

        $nuf_field_type = [
            'username' => __('Username', 'new-user-form-elementor'),
            'user_email' => __('User Email', 'new-user-form-elementor'),
            'user_password' => __('User Password', 'new-user-form-elementor'),
            'user_password_confirm' => __('Password Confirmation', 'new-user-form-elementor'),
            'first_name' => __('First Name', 'new-user-form-elementor'),
            'last_name' => __('Last Name', 'new-user-form-elementor'),
            'user_description' => __('User Description', 'new-user-form-elementor')
        ];

        $this->start_controls_section(
            'nuf_fields_section',
            [
                'label' => __('Fields', 'new-user-form-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $fields_repeater->add_control(
            'nuf_field_type',
            [
                'label' => __('Field Type', 'new-user-form-elementor'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'first_name',
                'options' => $nuf_field_type
            ]
        );

        $fields_repeater->add_control(
            'nuf_field_label',
            [
                'label' => __('Field Label', 'new-user-form-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => ''
            ]
        );

        $this->add_control(
            'nuf_field_list',
            [
                'label' => __('Field List', 'new-user-form-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $fields_repeater->get_controls(),
                'default' => [
                    [
                        'nuf_field_type' => 'username',
                        'nuf_field_label' => __('Username', 'new-user-form-elementor')
                    ],
                    [
                        'nuf_field_type' => 'user_email',
                        'nuf_field_label' => __('Email', 'new-user-form-elementor')
                    ],
                    [
                        'nuf_field_type' => 'user_password',
                        'nuf_field_label' => __('Password', 'new-user-form-elementor')
                    ]
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

    ?>

    <form class="nuf-new-user-form">

    <div class="elementor-form-fields-wrapper elementor-labels-above">

        <?php foreach ($settings['nuf_field_list'] as $item_index => $item): ?>

        <label><?php echo $item['nuf_field_label'] ?></label>
        <input type='text'/>

        <?php endforeach; ?>

    </div>
    
    </form>

    <?php
    }
}
