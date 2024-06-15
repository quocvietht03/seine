<?php

namespace SeineElementorWidgets\Widgets\TimeList;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Typography;

class Widget_TimeList extends Widget_Base
{

	public function get_name()
	{
		return 'bt-time-list';
	}

	public function get_title()
	{
		return __('Time List', 'seine');
	}

	public function get_icon()
	{
		return 'eicon-posts-ticker';
	}

	public function get_categories()
	{
		return ['seine'];
	}

	public function get_script_depends()
	{
		return ['elementor-widgets'];
	}

	protected function register_layout_section_controls()
	{
		$this->start_controls_section(
			'section_content',
			[
				'label' => __('Content', 'seine'),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'time_title',
			[
				'label' => __('Title', 'seine'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __('Monday', 'seine'),
			]
		);

		$repeater->add_control(
			'time_date',
			[
				'label' => __('Date', 'seine'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __('12:00 pm - 08:00 pm', 'seine'),
			]
		);



		$this->add_control(
			'list',
			[
				'label' => __('List Time', 'seine'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'time_title' => __('Monday', 'seine'),
						'time_date' => __('12:00 pm - 08:00 pm', 'seine'),
					],
					[
						'time_title' => __('Tuesday To Friday', 'seine'),
						'time_date' => __('06:00 pm - 05:00 pm', 'seine'),
					],
					[
						'time_title' => __('Saturday - Sunday', 'seine'),
						'time_date' => __('8:00 am - 3:30 pm', 'seine'),
					],
				],
				'title_field' => '{{{ time_title }}}',
			]
		);

		$this->end_controls_section();
	}

	protected function register_style_section_controls()
	{


		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__('Content', 'seine'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'titmetitle_style',
			[
				'label' => __('Title', 'seine'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'timetitle_color',
			[
				'label' => __('Color', 'seine'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-time--title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'timetitle_typography',
				'label' => __('Typography', 'seine'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-time--title',
			]
		);

		$this->add_control(
			'timedate_style',
			[
				'label' => __('Date', 'seine'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'timedate_color',
			[
				'label' => __('Color', 'seine'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-time--date' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'timedate_typography',
				'label' => __('Typography', 'seine'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-time--date',
			]
		);
		$this->end_controls_section();
	}

	protected function register_controls()
	{
		$this->register_layout_section_controls();
		$this->register_style_section_controls();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();

		if (empty($settings['list'])) {
			return;
		}
?>
		<div class="bt-elwg-time-list--default">
			<ul class="bt-time-list">
				<?php foreach ($settings['list'] as $index => $item) {
				?>
					<li class="bt-time--item">
						<div class="bt-time--title">
							<?php echo $item['time_title']; ?>
						</div>
						<div class="bt-time--date">
							<?php echo $item['time_date']; ?>
						</div>
					</li>
				<?php } ?>
			</ul>
		</div>
<?php
	}

	protected function content_template()
	{
	}
}
