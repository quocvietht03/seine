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
		$this->start_controls_section(
			'section_content',
			[
				'label' => __('Content', 'seine'),
			]
		);
		$this->add_control(
			'custom_title_blurry',
			[
				'label' => __('Custom Title Blurry', 'seine'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => '',
			]
		);
		$this->end_controls_section();
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
			'title_blurry_style',
			[
				'label' => __('Title Blurry', 'seine'),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'title_blurry_color',
			[
				'label' => __('Color', 'seine'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-page-titlebar--title-blurry' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_blurry_typography',
				'label' => __('Blurry Title Typography', 'seine'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-page-titlebar--title-blurry',
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
					'{{WRAPPER}} .bt-page-titlebar--title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __('Title Typography', 'seine'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-page-titlebar--title',
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
					'{{WRAPPER}} .bt-page-titlebar--breadcrumb' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'breadcrumb_typography',
				'label' => __('Breadcrumb Typography', 'seine'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-page-titlebar--breadcrumb',
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
		<div class="bt-elwg-page-titlebar">

			<div class="bt-page-titlebar">
				<?php if (!empty($settings['custom_title_blurry'])) { ?>
					<div class="bt-page-titlebar--title-blurry"><?php echo esc_html($settings['custom_title_blurry']); ?></div>
				<?php } else { ?>
					<div class="bt-page-titlebar--title-blurry"><?php echo seine_page_title(); ?></div>
				<?php } ?>
				<div class="bt-page-titlebar--infor">
					<h1 class="bt-page-titlebar--title"><?php echo seine_page_title(); ?></h1>
					<div class="bt-page-titlebar--breadcrumb">
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
