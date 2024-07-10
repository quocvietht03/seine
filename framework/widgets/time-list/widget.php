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
		$this->add_control(
			'time_enable_icon',
			[
				'label' => __('Enable Icon', 'seine'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Yes', 'seine'),
				'label_off' => __('No', 'seine'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$this->add_control(
			'time_icon',
			[
				'label' => esc_html__('Icon', 'seine'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				],
				'condition' => [
					'time_enable_icon' => 'yes',
				],
			]
		);
		$this->add_control(
			'time_list_enable',
			[
				'label' => __('Enable Custom List', 'seine'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Yes', 'seine'),
				'label_off' => __('No', 'seine'),
				'return_value' => 'yes',
				'default' => 'no',
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
				'label' => __('Hours', 'seine'),
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
				'condition' => [
					'time_list_enable' => 'yes',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_style_section_controls()
	{

		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => esc_html__('Icon', 'seine'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'time_enable_icon' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __('Size', 'seine'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 54,
				],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-site-infor' => 'column-gap: {{SIZE}}{{UNIT}}',
				],

				'condition' => [
					'time_enable_icon' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'icon_gap',
			[
				'label' => __('Space Between', 'seine'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 15,
				],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-site-infor' => 'column-gap: {{SIZE}}{{UNIT}}',
				],

				'condition' => [
					'time_enable_icon' => 'yes',
				],
			]
		);


		$this->end_controls_section();

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
				'label' => __('Hours', 'seine'),
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
		$site_information = get_field('site_information', 'options');

?>
		<div class="bt-elwg-time-list--default">
			<ul class="bt-time-list">
				<?php if (!empty($settings['time_list_enable']) && $settings['time_list_enable'] === 'yes') {
					if (empty($settings['list'])) {
						return;
					}
					foreach ($settings['list'] as $index => $item) {
				?>
						<li class="bt-time--item">
							<?php if (!empty($settings['time_enable_icon']) && $settings['time_enable_icon'] === 'yes' && !empty($settings['time_icon']['url'])) { ?>
								<div class="bt-time--icon">
									<img src="<?php echo esc_url($settings['time_icon']['url']); ?>" alt="">
								</div>
							<?php } ?>
							<div class="bt-time--infor">
								<div class="bt-time--title">
									<?php echo $item['time_title']; ?>
								</div>
								<div class="bt-time--date">
									<?php echo $item['time_date']; ?>
								</div>
							</div>
						</li>
						<?php }
				} else {
					if (!empty($site_information['opening_hours'])) {
						foreach ($site_information['opening_hours'] as $item) {
						?>
							<li class="bt-time--item">
								<?php if (!empty($settings['time_enable_icon']) && $settings['time_enable_icon'] === 'yes' && !empty($settings['time_icon']['url'])) { ?>
									<div class="bt-time--icon">
										<img src="<?php echo esc_url($settings['time_icon']['url']); ?>" alt="">
									</div>
								<?php } ?>
								<div class="bt-time--infor">
									<div class="bt-time--title">
										<?php echo $item['heading']; ?>
									</div>
									<div class="bt-time--date">
										<?php echo $item['hours']; ?>
									</div>
								</div>
							</li>
				<?php
						}
					}
				}
				?>
			</ul>
		</div>
<?php
	}

	protected function content_template()
	{
	}
}
