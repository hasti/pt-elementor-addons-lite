<?php

namespace PT_Elementor_Addons_Lite\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Icons;
use Elementor\Frontend;

if (!defined("ABSPATH")) {
    exit(); // Exit if accessed directly.
}

class Advance_Accordion extends Widget_Base
{
    public function get_name()
    {
        return "pr-advance-accordion";
    }

    public function get_title()
    {
        return __("Advance Accordion", "pt-elementor-addons-lite");
    }

    public function get_icon()
    {
        return "eicon-accordion";
    }

    public function get_categories()
    {
        return ["pt-addons-elementor"];
    }

    /**
     * Define our _register_controls settings.
     */
    protected function _register_controls()
    {
        /**
         * Advance Accordion Settings
         */

        $this->start_controls_section("pt_section_adv-accordion_settings", [
            "label" => esc_html__("General Settings", "elementor"),
        ]);

        $this->add_control("pt_adv_accordion_type", [
            "label" => esc_html__("Accordion Type", "elementor"),
            "type" => Controls_Manager::SELECT,
            "default" => "accordion",
            "label_block" => false,
            "options" => [
                "accordion" => esc_html__("Accordion", "elementor"),
                "toggle" => esc_html__("Toggle", "elementor"),
            ],
        ]);

        $this->add_control("pt_adv_accordion_icon_show", [
            "label" => esc_html__("Enable Toggle Icon", "elementor"),
            "type" => Controls_Manager::SWITCHER,
            "default" => "yes",
            "return_value" => "yes",
        ]);

        $this->add_control("pt_adv_accordion_icon", [
            "label" => esc_html__("Toggle Icon", "elementor"),
            "type" => Controls_Manager::ICON,
            "default" => "fa fa-angle-right",
            "include" => [
                "fa fa-angle-right",
                "fa fa-angle-double-right",
                "fa fa-chevron-right",
                "fa fa-chevron-circle-right",
                "fa fa-arrow-right",
                "fa fa-long-arrow-right",
                "fa fa-caret-right",
            ],
            "condition" => [
                "pt_adv_accordion_icon_show" => "yes",
            ],
        ]);

        $this->add_control("pt_adv_accordion_toggle_speed", [
            "label" => esc_html__("Toggle Speed (ms)", "elementor"),
            "type" => Controls_Manager::NUMBER,
            "label_block" => false,
            "default" => 300,
        ]);

        $this->end_controls_section();

        /**
         * Advance Accordion Content Settings
         */

        $this->start_controls_section(
            "pt_section_adv_accordion_content_settings",
            [
                "label" => esc_html__("Content Settings", "elementor"),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control("pt_adv_accordion_tab_icon_show", [
            "label" => esc_html__("Enable Title Icon", "elementor"),

            "type" => Controls_Manager::SWITCHER,

            "default" => "yes",

            "return_value" => "yes",
        ]);

        $repeater->add_control("pt_adv_accordion_tab_default_active", [
            "label" => esc_html__("Active as Default", "elementor"),

            "type" => \Elementor\Controls_Manager::SWITCHER,

            "label_on" => esc_html__("Active", "elementor"),

            "label_off" => esc_html__("Off", "elementor"),

            "return_value" => "yes",

            "default" => "no",
        ]);

        $this->add_control("pt_adv_accordion_tab_title_icon", [
            "label" => esc_html__("Icon", "elementor"),

            "type" => \Elementor\Controls_Manager::ICON,

            "default" => "fa fa-plus",

            "condition" => [
                "pt_adv_accordion_icon_show" => "yes",
            ],
        ]);

        // $repeater->add_control(

        //     'pt_adv_accordion_tab_title_icon',

        //     [

        //         'label' => esc_html__( 'Icon', 'elementor' ),

        //         'type' => \Elementor\Controls_Manager::ICONS,

        //         'default' => 'fas fa-plus',

        //             'condition' => [

        //             'pt_adv_accordion_tab_icon_show' => 'yes',

        //         ],

        //     ]

        // );

        //old icon cntrol

        $repeater->add_control("pt_adv_accordion_tab_title", [
            "label" => esc_html__("Tab Title", "elementor"),

            "type" => \Elementor\Controls_Manager::TEXT,

            "default" => esc_html__("Default Tab Title", "elementor"),

            "placeholder" => esc_html__("Type your title here", "elementor"),
        ]);

        $repeater->add_control("pt_adv_accordion_tab_content", [
            "label" => esc_html__("Description", "elementor"),

            "type" => \Elementor\Controls_Manager::WYSIWYG,

            "default" => esc_html__(
                "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, neque qui velit. Magni dolorum quidem ipsam eligendi, ",
                "elementor"
            ),

            "placeholder" => esc_html__(
                "Type your description here",
                "elementor"
            ),
        ]);

        //old elements replace with new elements

        $this->add_control("pt_adv_accordion_tab", [
            "label" => esc_html__("Repeater List", "plugin-name"),

            "type" => \Elementor\Controls_Manager::REPEATER,

            "fields" => $repeater->get_controls(),

            "default" => [
                [
                    "pt_adv_accordion_tab_title" => esc_html__(
                        "Tab Title #1",
                        "plugin-name"
                    ),

                    "pt_adv_accordion_tab_content" => esc_html__(
                        "Item content. Click the edit button to change this text.",
                        "plugin-name"
                    ),
                ],

                [
                    "pt_adv_accordion_tab_title" => esc_html__(
                        "Tab Title #2",
                        "plugin-name"
                    ),

                    "pt_adv_accordion_tab_content" => esc_html__(
                        "Item content. Click the edit button to change this text.",
                        "plugin-name"
                    ),
                ],

                [
                    "pt_adv_accordion_tab_title" => esc_html__(
                        "Tab Title #3",
                        "plugin-name"
                    ),

                    "pt_adv_accordion_tab_content" => esc_html__(
                        "Item content. Click the edit button to change this text.",
                        "plugin-name"
                    ),
                ],
            ],

            "title_field" => "{{{ pt_adv_accordion_tab_title }}}",
        ]);

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * Tab Style Advance Accordion Generel Style
         * -------------------------------------------
         */

        $this->start_controls_section(
            "pt_section_adv_accordion_style_settings",
            [
                "label" => esc_html__("General Style", "elementor"),

                "tab" => Controls_Manager::TAB_STYLE,
            ]
        );

        /*  Text alignment function added here  */

        /* text alignment function end here*/

        $this->add_responsive_control("pt_adv_accordion_padding", [
            "label" => esc_html__("Padding", "elementor"),

            "type" => Controls_Manager::DIMENSIONS,

            "size_units" => ["px", "em", "%"],

            "selectors" => [
                "{{WRAPPER}} .pt-adv-accordion" =>
                    "padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
            ],
        ]);

        $this->add_responsive_control("pt_adv_accordion_margin", [
            "label" => esc_html__("Margin", "elementor"),

            "type" => Controls_Manager::DIMENSIONS,

            "size_units" => ["px", "em", "%"],

            "selectors" => [
                "{{WRAPPER}} .pt-adv-accordion" =>
                    "margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
            ],
        ]);

        $this->add_group_control(Group_Control_Border::get_type(), [
            "name" => "pt_adv_accordion_border",

            "label" => esc_html__("Border", "elementor"),

            "selector" => "{{WRAPPER}} .pt-adv-accordion",
        ]);

        $this->add_responsive_control("pt_adv_accordion_border_radius", [
            "label" => esc_html__("Border Radius", "elementor"),

            "type" => Controls_Manager::DIMENSIONS,

            "size_units" => ["px", "em", "%"],

            "selectors" => [
                "{{WRAPPER}} .pt-adv-accordion" =>
                    "border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
            ],
        ]);

        $this->add_group_control(Group_Control_Box_Shadow::get_type(), [
            "name" => "pt_adv_accordion_box_shadow",

            "selector" => "{{WRAPPER}} .pt-adv-accordion",
        ]);

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * Tab Style Advance Accordion Content Style
         * -------------------------------------------
         */

        $this->start_controls_section(
            "pt_section_adv_accordions_tab_style_settings",
            [
                "label" => esc_html__("Tab Style", "elementor"),

                "tab" => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(Group_Control_Typography::get_type(), [
            "name" => "pt_adv_accordion_tab_title_typography",

            "selector" =>
                "{{WRAPPER}} .pt-adv-accordion .pt-accordion-list .pt-accordion-header",
        ]);

        $this->add_responsive_control("pt_adv_accordion_tab_icon_size", [
            "label" => __("Tab Icon Size", "elementor"),

            "type" => Controls_Manager::SLIDER,

            "default" => [
                "size" => 16,

                "unit" => "px",
            ],

            "size_units" => ["px"],

            "range" => [
                "px" => [
                    "min" => 0,

                    "max" => 100,

                    "step" => 1,
                ],
            ],

            "selectors" => [
                "{{WRAPPER}} .pt-adv-accordion .pt-accordion-list .pt-accordion-header .fa" =>
                    "font-size: {{SIZE}}{{UNIT}};",
            ],
        ]);

        $this->add_responsive_control("pt_adv_accordion_tab_icon_gap", [
            "label" => __("Icon Gap", "elementor"),

            "type" => Controls_Manager::SLIDER,

            "default" => [
                "size" => 10,

                "unit" => "px",
            ],

            "size_units" => ["px"],

            "range" => [
                "px" => [
                    "min" => 0,

                    "max" => 100,

                    "step" => 1,
                ],
            ],

            "selectors" => [
                "{{WRAPPER}} .pt-adv-accordion .pt-accordion-list .pt-accordion-header .fa" =>
                    "margin-right: {{SIZE}}{{UNIT}};",
            ],
        ]);

        $this->add_responsive_control("pt_adv_accordion_tab_padding", [
            "label" => esc_html__("Padding", "elementor"),

            "type" => Controls_Manager::DIMENSIONS,

            "size_units" => ["px", "em", "%"],

            "selectors" => [
                "{{WRAPPER}} .pt-adv-accordion .pt-accordion-list .pt-accordion-header" =>
                    "padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
            ],
        ]);

        $this->add_responsive_control("pt_adv_accordion_tab_margin", [
            "label" => esc_html__("Margin", "elementor"),

            "type" => Controls_Manager::DIMENSIONS,

            "size_units" => ["px", "em", "%"],

            "selectors" => [
                "{{WRAPPER}} .pt-adv-accordion .pt-accordion-list .pt-accordion-header" =>
                    "margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
            ],
        ]);

        $this->start_controls_tabs("pt_adv_accordion_header_tabs");

        // Normal State Tab

        $this->start_controls_tab("pt_adv_accordion_header_normal", [
            "label" => esc_html__("Normal", "elementor"),
        ]);

        $this->add_control("pt_adv_accordion_tab_color", [
            "label" => esc_html__("Tab Background Color", "elementor"),

            "type" => Controls_Manager::COLOR,

            "default" => "#f1f1f1",

            "selectors" => [
                "{{WRAPPER}} .pt-adv-accordion .pt-accordion-list .pt-accordion-header" =>
                    "background-color: {{VALUE}};",
            ],
        ]);

        $this->add_control("pt_adv_accordion_tab_text_color", [
            "label" => esc_html__("Text Color", "elementor"),

            "type" => Controls_Manager::COLOR,

            "default" => "#333",

            "selectors" => [
                "{{WRAPPER}} .pt-adv-accordion .pt-accordion-list .pt-accordion-header" =>
                    "color: {{VALUE}};",
            ],
        ]);

        $this->add_control("pt_adv_accordion_tab_icon_color", [
            "label" => esc_html__("Icon Color", "elementor"),

            "type" => Controls_Manager::COLOR,

            "default" => "#333",

            "selectors" => [
                "{{WRAPPER}} .pt-adv-accordion .pt-accordion-list .pt-accordion-header .fa" =>
                    "color: {{VALUE}};",
            ],

            "condition" => [
                "pt_adv_tabs_icon_show" => "yes",
            ],
        ]);

        $this->add_group_control(Group_Control_Border::get_type(), [
            "name" => "pt_adv_accordion_tab_border",

            "label" => esc_html__("Border", "elementor"),

            "selector" =>
                "{{WRAPPER}} .pt-adv-accordion .pt-accordion-list .pt-accordion-header",
        ]);

        $this->add_responsive_control("pt_adv_accordion_tab_border_radius", [
            "label" => esc_html__("Border Radius", "elementor"),

            "type" => Controls_Manager::DIMENSIONS,

            "size_units" => ["px", "em", "%"],

            "selectors" => [
                "{{WRAPPER}} .pt-adv-accordion .pt-accordion-list .pt-accordion-header" =>
                    "border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
            ],
        ]);

        $this->end_controls_tab();

        // Hover State Tab

        $this->start_controls_tab("pt_adv_accordion_header_hover", [
            "label" => esc_html__("Hover", "pt-addons-elementor"),
        ]);

        $this->add_control("pt_adv_accordion_tab_color_hover", [
            "label" => esc_html__("Tab Background Color", "elementor"),

            "type" => Controls_Manager::COLOR,

            "default" => "#414141",

            "selectors" => [
                "{{WRAPPER}} .pt-adv-accordion .pt-accordion-list .pt-accordion-header:hover" =>
                    "background-color: {{VALUE}};",
            ],
        ]);

        $this->add_control("pt_adv_accordion_tab_text_color_hover", [
            "label" => esc_html__("Text Color", "elementor"),

            "type" => Controls_Manager::COLOR,

            "default" => "#fff",

            "selectors" => [
                "{{WRAPPER}} .pt-adv-accordion .pt-accordion-list .pt-accordion-header:hover" =>
                    "color: {{VALUE}};",
            ],
        ]);

        $this->add_control("pt_adv_accordion_tab_icon_color_hover", [
            "label" => esc_html__("Icon Color", "elementor"),

            "type" => Controls_Manager::COLOR,

            "default" => "#fff",

            "selectors" => [
                "{{WRAPPER}} .pt-adv-accordion .pt-accordion-list .pt-accordion-header:hover .fa" =>
                    "color: {{VALUE}};",
            ],

            "condition" => [
                "pt_adv_accordion_toggle_icon_show" => "yes",
            ],
        ]);

        $this->add_group_control(Group_Control_Border::get_type(), [
            "name" => "pt_adv_accordion_tab_border_hover",

            "label" => esc_html__("Border", "elementor"),

            "selector" =>
                "{{WRAPPER}} .pt-adv-accordion .pt-accordion-list .pt-accordion-header:hover",
        ]);

        $this->add_responsive_control(
            "pt_adv_accordion_tab_border_radius_hover",
            [
                "label" => esc_html__("Border Radius", "elementor"),

                "type" => Controls_Manager::DIMENSIONS,

                "size_units" => ["px", "em", "%"],

                "selectors" => [
                    "{{WRAPPER}} .pt-adv-accordion .pt-accordion-list .pt-accordion-header:hover" =>
                        "border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
                ],
            ]
        );

        $this->end_controls_tab();

        // Active State Tab

        $this->start_controls_tab("pt_adv_accordion_header_active", [
            "label" => esc_html__("Active", "pt-addons-elementor"),
        ]);

        $this->add_control("pt_adv_accordion_tab_color_active", [
            "label" => esc_html__("Tab Background Color", "elementor"),

            "type" => Controls_Manager::COLOR,

            "default" => "#444",

            "selectors" => [
                "{{WRAPPER}} .pt-adv-accordion .pt-accordion-list .pt-accordion-header.active" =>
                    "background-color: {{VALUE}};",
            ],
        ]);

        $this->add_control("pt_adv_accordion_tab_text_color_active", [
            "label" => esc_html__("Text Color", "elementor"),

            "type" => Controls_Manager::COLOR,

            "default" => "#fff",

            "selectors" => [
                "{{WRAPPER}} .pt-adv-accordion .pt-accordion-list .pt-accordion-header.active" =>
                    "color: {{VALUE}};",
            ],
        ]);

        $this->add_control("pt_adv_accordion_tab_icon_color_active", [
            "label" => esc_html__("Icon Color", "elementor"),

            "type" => Controls_Manager::COLOR,

            "default" => "#fff",

            "selectors" => [
                "{{WRAPPER}} .pt-adv-accordion .pt-accordion-list .pt-accordion-header.active .fa" =>
                    "color: {{VALUE}};",
            ],

            "condition" => [
                "pt_adv_accordion_toggle_icon_show" => "yes",
            ],
        ]);

        $this->add_group_control(Group_Control_Border::get_type(), [
            "name" => "pt_adv_accordion_tab_border_active",

            "label" => esc_html__("Border", "elementor"),

            "selector" =>
                "{{WRAPPER}} .pt-adv-accordion .pt-accordion-list .pt-accordion-header.active",
        ]);

        $this->add_responsive_control(
            "pt_adv_accordion_tab_border_radius_active",
            [
                "label" => esc_html__("Border Radius", "elementor"),

                "type" => Controls_Manager::DIMENSIONS,

                "size_units" => ["px", "em", "%"],

                "selectors" => [
                    "{{WRAPPER}} .pt-adv-accordion .pt-accordion-list .pt-accordion-header.active" =>
                        "border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        /**
         * -------------------------------------------
         * Tab Style Advance Accordion Content Style
         * -------------------------------------------
         */

        $this->start_controls_section(
            "pt_section_adv_accordion_tab_content_style_settings",
            [
                "label" => esc_html__("Content Style", "elementor"),

                "tab" => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control("adv_accordion_content_bg_color", [
            "label" => esc_html__("Background Color", "elementor"),

            "type" => Controls_Manager::COLOR,

            "default" => "",

            "selectors" => [
                "{{WRAPPER}} .pt-adv-accordion .pt-accordion-list .pt-accordion-content" =>
                    "background-color: {{VALUE}};",
            ],
        ]);

        $this->add_control("adv_accordion_content_text_color", [
            "label" => esc_html__("Text Color", "elementor"),

            "type" => Controls_Manager::COLOR,

            "default" => "#333",

            "selectors" => [
                "{{WRAPPER}} .pt-adv-accordion .pt-accordion-list .pt-accordion-content" =>
                    "color: {{VALUE}};",
            ],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            "name" => "pt_adv_accordion_content_typography",

            "selector" =>
                "{{WRAPPER}} .pt-adv-accordion .pt-accordion-list .pt-accordion-content",
        ]);

        $this->add_responsive_control("pt_adv_accordion_content_padding", [
            "label" => esc_html__("Padding", "elementor"),

            "type" => Controls_Manager::DIMENSIONS,

            "size_units" => ["px", "em", "%"],

            "selectors" => [
                "{{WRAPPER}} .pt-adv-accordion .pt-accordion-list .pt-accordion-content" =>
                    "padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
            ],
        ]);

        $this->add_responsive_control("pt_adv_accordion_content_margin", [
            "label" => esc_html__("Margin", "elementor"),

            "type" => Controls_Manager::DIMENSIONS,

            "size_units" => ["px", "em", "%"],

            "selectors" => [
                "{{WRAPPER}} .pt-adv-accordion .pt-accordion-list .pt-accordion-content" =>
                    "margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
            ],
        ]);

        $this->add_group_control(Group_Control_Border::get_type(), [
            "name" => "pt_adv_accordion_content_border",

            "label" => esc_html__("Border", "elementor"),

            "selector" =>
                "{{WRAPPER}} .pt-adv-accordion .pt-accordion-list .pt-accordion-content",
        ]);

        $this->add_group_control(Group_Control_Box_Shadow::get_type(), [
            "name" => "pt_adv_accordion_content_shadow",

            "selector" =>
                "{{WRAPPER}} .pt-adv-accordion .pt-accordion-list .pt-accordion-content",

            "separator" => "before",
        ]);

        $this->end_controls_section();

        /**
         * Advance Accordion Caret Settings
         */

        $this->start_controls_section(
            "pt_section_adv_accordion_caret_settings",
            [
                "label" => esc_html__("Toggle Caret Style", "elementor"),

                "tab" => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control("pt_adv_accordion_tab_toggle_icon_size", [
            "label" => __("Icon Size", "elementor"),

            "type" => Controls_Manager::SLIDER,

            "default" => [
                "size" => 16,

                "unit" => "px",
            ],

            "size_units" => ["px"],

            "range" => [
                "px" => [
                    "min" => 0,

                    "max" => 100,

                    "step" => 1,
                ],
            ],

            "selectors" => [
                "{{WRAPPER}} .pt-adv-accordion .pt-accordion-list .pt-accordion-header .fa-toggle" =>
                    "font-size: {{SIZE}}{{UNIT}};",
            ],

            "condition" => [
                "pt_adv_accordion_icon_show" => "yes",
            ],
        ]);

        $this->add_control("pt_adv_tabs_tab_toggle_color", [
            "label" => esc_html__("Caret Color", "elementor"),

            "type" => Controls_Manager::COLOR,

            "default" => "#444",

            "selectors" => [
                "{{WRAPPER}} .pt-adv-accordion .pt-accordion-list .pt-accordion-header .fa-toggle" =>
                    "color: {{VALUE}};",
            ],

            "condition" => [
                "pt_adv_accordion_icon_show" => "yes",
            ],
        ]);

        $this->add_control("pt_adv_tabs_tab_toggle_active_color", [
            "label" => esc_html__("Caret Color (Active)", "elementor"),

            "type" => Controls_Manager::COLOR,

            "default" => "#fff",

            "selectors" => [
                "{{WRAPPER}} .pt-adv-accordion .pt-accordion-list .pt-accordion-header.active .fa-toggle" =>
                    "color: {{VALUE}};",

                "{{WRAPPER}} .pt-adv-accordion .pt-accordion-list:hover .pt-accordion-header .fa-toggle" =>
                    "color: {{VALUE}};",
            ],

            "condition" => [
                "pt_adv_accordion_icon_show" => "yes",
            ],
        ]);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings(); ?>







        <div class="pt-adv-accordion" id="pt-adv-accordion-<?php echo esc_attr(
            $this->get_id()
        ); ?>">



        <?php foreach ($settings["pt_adv_accordion_tab"] as $tab): ?>







                <div class="pt-accordion-list">



                    <div class="pt-accordion-header



            <?php if ($tab["pt_adv_accordion_tab_default_active"] == "yes"):
                echo " active-default";
            endif; ?>



            ">



                        <span>



            <?php if ($tab["pt_adv_accordion_tab_icon_show"] === "yes"): ?>



                                <div class="my-icon-wrapper">







                                </div>



                                <i class="<?php echo esc_attr(
                                    $settings["pt_adv_accordion_tab_title_icon"]
                                ); ?> fa"></i><?php endif; ?>
            <?php echo $tab["pt_adv_accordion_tab_title"]; ?>
                        </span>



            <?php if ($settings["pt_adv_accordion_icon_show"] === "yes"): ?>



                            <i class="<?php echo esc_attr(
                                $settings["pt_adv_accordion_icon"]
                            ); ?> fa-toggle"></i> <?php endif; ?>



                    </div>



                    <div class="pt-accordion-content



            <?php if ($tab["pt_adv_accordion_tab_default_active"] == "yes"):
                echo " active-default";
            endif; ?>



            ">



                        <p>



            <?php echo do_shortcode($tab["pt_adv_accordion_tab_content"]); ?>



                        </p>



                    </div>



                </div>



        <?php endforeach; ?>



        </div>



        <script>



            jQuery(document).ready(function ($) {



                var $ptAdvAccordion = $('#pt-adv-accordion-<?php echo esc_attr(
                    $this->get_id()
                ); ?>');



                var $ptAccordionList = $ptAdvAccordion.find('.pt-accordion-list');



                var $ptAccordionListHeader = $ptAdvAccordion.find('.pt-accordion-list .pt-accordion-header');



                var $ptAccordioncontent = $ptAdvAccordion.find('.pt-accordion-content');



                $ptAccordionList.each(function (i) {



                    if ($(this).find('.pt-accordion-header').hasClass('active-default')) {



                        $(this).find('.pt-accordion-header').addClass('active');



                        $(this).find('.pt-accordion-content').addClass('active').css('display', 'block').slideDown(<?php echo esc_attr(
                            $settings["pt_adv_accordion_toggle_speed"]
                        ); ?>);



                    }



                });



        <?php if ("accordion" == $settings["pt_adv_accordion_type"]): ?>



                    $ptAccordionListHeader.on('click', function () {



                        // Check if 'active' class is already exists



                        if ($(this).hasClass('active')) {



                            $(this).removeClass('active');



                            $(this).next('.pt-accordion-content').removeClass('active').slideUp(<?php echo esc_attr(
                                $settings["pt_adv_accordion_toggle_speed"]
                            ); ?>);



                        } else {



                            $ptAccordionListHeader.removeClass('active');



                            $ptAccordionListHeader.next('.pt-accordion-content').removeClass('active').slideUp(<?php echo esc_attr(
                                $settings["pt_adv_accordion_toggle_speed"]
                            ); ?>);



                            $(this).toggleClass('active');



                            $(this).next('.pt-accordion-content').slideToggle(<?php echo esc_attr(
                                $settings["pt_adv_accordion_toggle_speed"]
                            ); ?>, function () {



                                $(this).toggleClass('active');



                            });



                        }



                    });



        <?php endif; ?>



        <?php if ("toggle" == $settings["pt_adv_accordion_type"]): ?>



                    $ptAccordionListHeader.on('click', function () {



                        // Check if 'active' class is already exists



                        if ($(this).hasClass('active')) {



                            $(this).removeClass('active');



                            $(this).next('.pt-accordion-content').removeClass('active').slideUp(<?php echo esc_attr(
                                $settings["pt_adv_accordion_toggle_speed"]
                            ); ?>);



                        } else {



                            $(this).toggleClass('active');



                            $(this).next('.pt-accordion-content').slideToggle(<?php echo esc_attr(
                                $settings["pt_adv_accordion_toggle_speed"]
                            ); ?>, function () {



                                $(this).toggleClass('active');



                            });



                        }



                    });



        <?php endif; ?>



            });



        </script>



        <?php
    }

    // protected function content_template() {

    // }
}
