<?php

namespace SeineElementorWidgets\Widgets\PageTitleBar;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class Widget_PageTitleBar extends Widget_Base
{

	public function get_name()
	{
		return 'bt-page-title-bar';
	}

	public function get_title()
	{
		return __('Page Title Bar', 'seine');
	}

	public function get_icon()
	{
		return 'eicon-posts-ticker';
	}

	public function get_categories()
	{
		return ['seine'];
	}

	protected function register_content_section_controls()
	{
	}

	protected function register_style_content_section_controls()
	{

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__('Content', 'seine'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'blurry_title_style',
			[
				'label' => __('Blurry Title', 'seine'),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'blurry_title_color',
			[
				'label' => __('Color', 'seine'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-page-title-bar--blurry-title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'blurry_title_typography',
				'label' => __('Blurry Title Typography', 'seine'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-page-title-bar--blurry-title',
			]
		);
		$this->add_control(
			'title_style',
			[
				'label' => __('Title', 'seine'),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __('Color', 'seine'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-page-title-bar--title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __('Title Typography', 'seine'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-page-title-bar--title',
			]
		);

		$this->add_control(
			'breadcrumb_style',
			[
				'label' => __('Breadcrumb', 'seine'),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'breadcrumb_color',
			[
				'label' => __('Color', 'seine'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-page-title-bar--breadcrumb' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'breadcrumb_typography',
				'label' => __('Breadcrumb Typography', 'seine'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-page-title-bar--breadcrumb',
			]
		);

		$this->end_controls_section();
	}

	protected function register_controls()
	{
		$this->register_content_section_controls();
		$this->register_style_content_section_controls();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$home_text = 'Home';
		$delimiter = '|';
?>
		<div class="bt-elwg-page-title-bar">

			<div class="bt-page-title-bar">
				<div class="bt-page-title-bar--blurry-title"><?php echo seine_page_title(); ?></div>
				<div class="bt-page-title-bar--infor">
					<div class="bt-page-title-bar--title"><?php echo seine_page_title(); ?></div>
					<div class="bt-page-title-bar--breadcrumb">
						<?php
						echo seine_page_breadcrumb($home_text, $delimiter);
						?>
					</div>
				</div>
			</div>
		</div>
<?php
	}

	protected function content_template()
	{
	}
}
