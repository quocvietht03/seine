<?php

namespace SeineElementorWidgets\Widgets\HighlightedHeadingStyle1;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class Widget_HighlightedHeadingStyle1 extends Widget_Base
{

	public function get_name()
	{
		return 'bt-highlighted-heading-style-1';
	}

	public function get_title()
	{
		return __('Highlighted Heading Style 1', 'seine');
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
			'section_heading',
			[
				'label' => __('Heading', 'seine'),
			]
		);
		$repeater = new Repeater();


		$repeater->add_control(
			'text_title',
			[
				'label' => __('Text', 'autoart'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __('Text Heading', 'autoart'),
			]
		);
		$repeater->add_control(
			'style_title',
			[
				'label' => __('Style', 'seine'),
				'type' => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1' => '1',
					'2' => '2',
				],
			]
		);
		$this->add_control(
			'list',
			[
				'label' => __('List Style Heading', 'autoart'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'text_title' => __('This is the heading', 'autoart'),
						'style_title' => '1'
					],
					[
						'text_title' => __('Highlighted', 'autoart'),
						'style_title' => '2'
					],
					[
						'text_title' => __('After heading', 'autoart'),
						'style_title' => '1'
					],
				],
				'title_field' => '{{{ text_title }}}',
			]
		);

		$this->add_control(
			'link_heading',
			[
				'label'       => esc_html__('Link', 'seine'),
				'type'        => Controls_Manager::TEXT,
				'input_type'  => 'url',
				'default'     => '',
			]
		);

		$this->add_control(
			'html_tag',
			[
				'label' => __('HTML Tag', 'seine'),
				'type'  => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => [
					'h1' => 'h1',
					'h2' => 'h2',
					'h3' => 'h3',
					'h4' => 'h4',
					'h5' => 'h5',
					'h6' => 'h6',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_style_content_section_controls()
	{

		$this->start_controls_section(
			'section_style_heading',
			[
				'label' => esc_html__('Heading', 'seine'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'text_align',
			[
				'label' => esc_html__('Alignment', 'seine'),
				'type'  => Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__('Left', 'seine'),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'seine'),
						'icon'  => 'eicon-text-align-center',
					],
					'end' => [
						'title' => esc_html__('Right', 'seine'),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default' => 'start',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-highlighted-heading' => 'justify-content: {{VALUE}};text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __('Color', 'seine'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-highlighted-heading h1' => 'color: {{VALUE}};',
					'{{WRAPPER}} .bt-elwg-highlighted-heading h2' => 'color: {{VALUE}};',
					'{{WRAPPER}} .bt-elwg-highlighted-heading h3' => 'color: {{VALUE}};',
					'{{WRAPPER}} .bt-elwg-highlighted-heading h4' => 'color: {{VALUE}};',
					'{{WRAPPER}} .bt-elwg-highlighted-heading h5' => 'color: {{VALUE}};',
					'{{WRAPPER}} .bt-elwg-highlighted-heading h6' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'text_typography',
				'label'    => __('Typography', 'seine'),
				'default'  => '',
				'selector' => '{{WRAPPER}} .bt-elwg-highlighted-heading h1, {{WRAPPER}} .bt-elwg-highlighted-heading h2, {{WRAPPER}} .bt-elwg-highlighted-heading h3, {{WRAPPER}} .bt-elwg-highlighted-heading h4, {{WRAPPER}} .bt-elwg-highlighted-heading h5, {{WRAPPER}} .bt-elwg-highlighted-heading h6',
			]
		);

		$this->add_control(
			'highlighted_text_style',
			[
				'label' => __('Highlighted Text', 'seine'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'highlighted_text_color',
			[
				'label' => __('Color', 'seine'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-highlighted-heading .__text-highlighted' => 'color: {{VALUE}};'
				],
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
		$html_tag = isset($settings['html_tag']) ? $settings['html_tag'] : '';
		$link     = isset($settings['link_heading']) ? $settings['link_heading'] : '';
		if (empty($settings['list'])) {
			return;
		}
?>

		<div class="bt-elwg-highlighted-heading">
			<?php echo "<$html_tag>"; ?>

			<?php if (!empty($link)) : ?>
				<a href="<?php echo esc_url($link); ?>">
					<?php foreach ($settings['list'] as $index => $item) : ?>
						<?php if ($item['text_title']) : ?>
							<?php if ($item['style_title'] == 1) { ?>
								<?php echo $item['text_title']; ?>
							<?php } else { ?>
								<span class="__text-highlighted">
									<?php echo $item['text_title']; ?>
								</span>
							<?php } ?>
						<?php endif; ?>
					<?php endforeach; ?>
				</a>
			<?php else : ?>
				<?php foreach ($settings['list'] as $index => $item) : ?>
					<?php if ($item['text_title']) : ?>
						<?php if ($item['style_title'] == 1) { ?>
							<?php echo $item['text_title']; ?>
						<?php } else { ?>
							<span class="__text-highlighted">
								<?php echo $item['text_title']; ?>
							</span>
						<?php } ?>
					<?php endif; ?>
				<?php endforeach; ?>
			<?php endif; ?>

			<?php echo "</$html_tag>"; ?>
		</div>
<?php
	}

	protected function content_template()
	{
	}
}
