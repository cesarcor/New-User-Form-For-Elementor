<?php

namespace New_User_Form_Elementor\Classes;

use Elementor\Widget_Base;
use Elementor\Repeater;
use New_User_Form_Elementor\Classes\Form\Field_Creation;

// Exit if accessed directly
if (!defined('ABSPATH')):
    exit;
endif;

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

        $nuf_field_widths = [
            '' => __('Default', 'new-user-form-elementor'),
            '100' => '100%',
            '80' => '80%',
            '75' => '75%',
            '66' => '66%',
            '60' => '60%',
            '50' => '50%',
            '40' => '40%',
            '33' => '33%',
            '25' => '25%',
            '20' => '20%',
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

        $fields_repeater->add_control(
            'nuf_field_placeholder',
            [
                'label' => __('Field Placeholder', 'new-user-form-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => ''
            ]
        );

        $fields_repeater->add_control(
            'nuf_field_width',
            [
                'label' => __('Field Width', 'new-user-form-elementor'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '100',
                'options' => $nuf_field_widths
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

        $this->start_controls_section(
            'nuf_button_section',
            [
                'label' => __('Submit Button', 'new-user-form-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'nuf_submit_button_text',
            [
                'label' => __('Button Text', 'new-user-form-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Register',
                'placeholder' => ''
            ]
        );

        $this->add_responsive_control(
            'nuf_button_width',
            [
                'label' => __('Column Width', 'new-user-form-elementor'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '100',
                'options' => $nuf_field_widths,
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
    $settings = $this->get_settings_for_display();
    $buttonWidth = (('' !== $settings['nuf_button_width']) ? $settings['nuf_button_width'] : '100');
    ?>

    <form class="nuf-new-user-form">

    <div class="elementor-form-fields-wrapper elementor-labels-above">

        <?php $this->render_fields(); ?>

        <div class="elementor-field-group elementor-field-type-submit elementor-column elementor-col-<?php echo esc_attr($buttonWidth); ?>">
            <button type="submit" class="nuf-button elementor-button" style="width:100%;">
                <span><?php echo esc_html($settings['nuf_submit_button_text']); ?></span>
            </button>
        </div>

    </div>
    
    </form>

    <?php
    }

    protected function render_fields(){

        $settings = $this->get_settings_for_display();
        $field_creation = new Field_Creation();
            
            foreach ($settings['nuf_field_list'] as $item_index => $item): 

                $fieldWidth = (('' !== $item['nuf_field_width']) ? $item['nuf_field_width'] : '100'); ?>
                
                    <div class="nuf-field-group elementor-field-group elementor-column elementor-col-<?php echo esc_attr($fieldWidth); ?>">

                        <label><?php echo $item['nuf_field_label'] ?></label>
                
                        <?php 
                        switch($item['nuf_field_type']):
                            case 'username':
                            case 'user_email':
                            case 'first_name':
                            case 'last_name':
                                echo $field_creation->create_text_field([
                                    'type' => $item['nuf_field_type'] === 'user_email' ? 'email' : 'text',
                                    'placeholder' => $item['nuf_field_placeholder']
                                ]);
                            break;
                            case 'user_password':
                            case 'user_password_confirm':
                                echo $field_creation->create_password_field([
                                    'placeholder' => $item['nuf_field_placeholder']
                                ]);
                            break;
                            case 'user_description':
                                echo $field_creation->create_textarea_field([
                                    'placeholder' => $item['nuf_field_placeholder']
                                    ]
                                );
                            break;
                        endswitch; ?>

                    </div>

        <?php
            endforeach;

    }
}