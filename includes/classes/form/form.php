<?php

namespace New_User_Form_Elementor\Classes;

use Elementor\Widget_Base;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Plugin;
use New_User_Form_Elementor\Classes\Form\Field_Creation;
use New_User_Form_Elementor\Traits\User_Registration;

// Exit if accessed directly
if (!defined('ABSPATH')):
    exit;
endif;

class Form extends Widget_Base {

    use User_Registration;

    protected $page_id;

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

        $nuf_user_roles = [
            'subscriber' => __('Subscriber', 'new-user-form-elementor'),
            'contributor' => __('Contributor', 'new-user-form-elementor'),
            'author' => __('Author', 'new-user-form-elementor'),
            'editor' => __('Editor', 'new-user-form-elementor'),
            'administrator' => __('Administrator', 'new-user-form-elementor')
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
                    ],
                    [
                        'nuf_field_type' => 'user_password_confirm',
                        'nuf_field_label' => __('Confirm Password', 'new-user-form-elementor')
                    ]
                ]
            ]
        );

        $this->add_control(
            'show_labels',
            [
                'label' => __('Label', 'new-user-form-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'new-user-form-elementor'),
                'label_off' => __('Hide', 'new-user-form-elementor'),
                'return_value' => 'true',
                'default' => 'true',
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'registration_options',
            [
                'label' => __('Registration Options', 'new-user-form-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'nuf_user_role',
            [
                'label' => __('User Role', 'new-user-form-elementor'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'subscriber',
                'options' => $nuf_user_roles
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

        $this->add_responsive_control(
            'nuf_button_align',
            [
                'label' => __('Alignment', 'new-user-form-elementor'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => __('Left', 'new-user-form-elementor'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'new-user-form-elementor'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'end' => [
                        'title' => __('Right', 'new-user-form-elementor'),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'stretch' => [
                        'title' => __('Justified', 'new-user-form-elementor'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'default' => 'start',
                'prefix_class' => 'elementor%s-button-align-',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'nuf_form_styles',
            [
                'label' => __('Form', 'new-user-form-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'column_gap',
            [
                'label' => __('Columns Gap', 'new-user-form-elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 60,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-field-group' => 'padding-right: calc( {{SIZE}}{{UNIT}}/2 ); padding-left: calc( {{SIZE}}{{UNIT}}/2 );',
                    '{{WRAPPER}} .elementor-form-fields-wrapper' => 'margin-left: calc( -{{SIZE}}{{UNIT}}/2 ); margin-right: calc( -{{SIZE}}{{UNIT}}/2 );',
                ],
            ]
        );

        $this->add_control(
            'nuf_row_gap',
            [
                'label' => __('Rows Gap', 'new-user-form-elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 60,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .nuf-field-group' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'heading_label',
            [
                'label' => __('Label', 'new-user-form-elementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'label_spacing',
            [
                'label' => __('Spacing', 'new-user-form-elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 60,
                    ],
                ],
                'selectors' => [
                    'body.rtl {{WRAPPER}} .elementor-labels-inline .elementor-field-group > label' => 'padding-left: {{SIZE}}{{UNIT}};',
                    // for the label position = inline option
                    'body:not(.rtl) {{WRAPPER}} .elementor-labels-inline .elementor-field-group > label' => 'padding-right: {{SIZE}}{{UNIT}};',
                    // for the label position = inline option
                    'body {{WRAPPER}} .elementor-labels-above .elementor-field-group > label' => 'padding-bottom: {{SIZE}}{{UNIT}};',
                    // for the label position = above option
                ],
            ]
        );

        $this->add_control(
            'label_color',
            [
                'label' => __('Text Color', 'new-user-form-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-field-group > label, {{WRAPPER}} .elementor-field-subgroup label' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_3,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'label_typography',
                'selector' => '{{WRAPPER}} .elementor-field-group > label',
                'scheme' => Schemes\Typography::TYPOGRAPHY_3,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'nuf_field_styles',
            [
                'label' => __('Fields', 'new-user-form-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'field_text_color',
            [
                'label' => __('Text Color', 'new-user-form-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .nuf-field-group .nuf-field' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_3,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'field_typography',
                'selector' => '{{WRAPPER}} .nuf-field-group .nuf-field, {{WRAPPER}} .nuf-field-group label',
                'scheme' => Schemes\Typography::TYPOGRAPHY_3,
            ]
        );

        $this->add_control(
            'field_background_color',
            [
                'label' => __('Background Color', 'new-user-form-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .nuf-field' => 'background-color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'field_border_color',
            [
                'label' => __('Border Color', 'new-user-form-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .nuf-field-group .nuf-field' => 'border-color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'field_border_width',
            [
                'label' => __('Border Width', 'new-user-form-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'placeholder' => '1',
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .nuf-field-group .nuf-field' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'field_border_radius',
            [
                'label' => __('Border Radius', 'new-user-form-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .nuf-field-group .nuf-field' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'nuf_button_styles',
            [
                'label' => __('Buttons', 'new-user-form-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('tabs_button_style');

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => __('Normal', 'new-user-form-elementor'),
            ]
        );

        $this->add_control(
            'nuf_button_background_color',
            [
                'label' => __('Background Color', 'new-user-form-elementor'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_4,
                ],
                'selectors' => [
                    '{{WRAPPER}} .nuf-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'nuf_button_text_color',
            [
                'label' => __('Text Color', 'new-user-form-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .nuf-button' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .nuf-button svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'nuf_button_typography',
                'scheme' => Schemes\Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .nuf-button',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .nuf-button',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => __('Border Radius', 'new-user-form-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .nuf-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'button_text_padding',
            [
                'label' => __('Text Padding', 'new-user-form-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .nuf-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => __('Hover', 'new-user-form-elementor'),
            ]
        );

        $this->add_control(
            'button_background_hover_color',
            [
                'label' => __('Background Color', 'new-user-form-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .nuf-button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => __('Text Color', 'new-user-form-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .nuf-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
        
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
    ?>

        <form class="nuf-new-user-form" method="post" action="<?php echo admin_url('admin-ajax.php'); ?>" enctype="multipart/form-data">

        <div class="elementor-form-fields-wrapper elementor-labels-above">

            <?php 
                $this->render_fields();
                $this->render_button();
            ?>

        </div>
        
        </form>

    <?php
    }

    protected function render_fields(){

        $settings = $this->get_settings_for_display();
        $field_creation = new Field_Creation();

        if (Plugin::$instance->documents->get_current()):
            $this->page_id = Plugin::$instance->documents->get_current()->get_main_id();
        endif;
            
            foreach ($settings['nuf_field_list'] as $item_index => $item): 

                $fieldWidth = (('' !== $item['nuf_field_width']) ? $item['nuf_field_width'] : '100'); ?>
                
                    <div class="nuf-field-group elementor-field-group elementor-column elementor-col-<?php echo esc_attr($fieldWidth); ?>">

                        <?php if($settings['show_labels']):
                            echo ('<label>' . esc_html($item['nuf_field_label']) . '</label>' );
                         endif; 
                         ?>
                
                        <?php 
                        switch($item['nuf_field_type']):
                            case 'username':
                            case 'user_email':
                            case 'first_name':
                            case 'last_name':
                                echo $field_creation->create_text_field([
                                    'type' => $item['nuf_field_type'] === 'user_email' ? 'email' : 'text',
                                    'placeholder' => $item['nuf_field_placeholder'],
                                    'name' => $item['nuf_field_type']
                                ]);
                            break;
                            case 'user_password':
                            case 'user_password_confirm':
                                echo $field_creation->create_password_field([
                                    'placeholder' => $item['nuf_field_placeholder'],
                                    'name' => $item['nuf_field_type']
                                ]);
                            break;
                            case 'user_description':
                                echo $field_creation->create_textarea_field([
                                    'placeholder' => $item['nuf_field_placeholder'],
                                    'name' => $item['nuf_field_type']
                                ]);
                            break;
                        endswitch; ?>

                    </div>

        <?php
            endforeach;
        ?>

                <input type="hidden" name="action" value="nuf_register_user" />
                <?php wp_nonce_field('nuf_register_user', 'nuf_register_user_nonce'); ?>
                <input type="hidden" name="page_id" value="<?php echo esc_attr($this->page_id); ?>">
                <input type="hidden" name="widget_id" value="<?php echo esc_attr($this->get_id()); ?>">

        <?php

    }

    protected function render_button(){
        $settings = $this->get_settings_for_display();
        $buttonWidth = (('' !== $settings['nuf_button_width']) ? $settings['nuf_button_width'] : '100');
    ?>

        <div class="elementor-field-group elementor-field-type-submit elementor-column elementor-col-<?php echo esc_attr($buttonWidth); ?>">
            <button type="submit" class="nuf-button elementor-button">
                <span><?php echo esc_html($settings['nuf_submit_button_text']); ?></span>
            </button>
        </div>

    <?php
    }
}