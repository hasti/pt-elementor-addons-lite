<?php

namespace PT_Elementor_Addons_Lite\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Heading_Widget extends Widget_Base {

	public function get_name() {
		return 'heading_widget';
	}

	public function get_title() {
		return __( 'Heading Widget', 'pt-elementor-addons-lite' );
	}

	public function get_icon() {
		return 'eicon-t-letter';
	}

	public function get_categories() {
		return [ 'basic' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'pt-elementor-addons-lite' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'pt-elementor-addons-lite' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Default title', 'pt-elementor-addons-lite' ),
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		echo '<h2>' . $settings['title'] . '</h2>';
	}

	protected function _content_template() {
		?>
		<# var title = settings.title; #>
		<h2>{{{ title }}}</h2>
		<?php
	}
}
