<?php

namespace SeineElementorWidgets\Widgets\IconPhoneContact;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class Widget_IconPhoneContact extends Widget_Base
{

	public function get_name()
	{
		return 'bt-icon-phone-contact';
	}

	public function get_title()
	{
		return __('Icon Phone Contact', 'seine');
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
			'icon',
			[
				'label' => esc_html__('Icon', 'seine'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],

			]
		);
		$this->add_control(
			'icon_link',
			[
				'label' => esc_html__('Box Link', 'seine'),
				'type' => 	Controls_Manager::URL,
				'default' => [
					'url' => '',
				],
				'show_external' => false,
			]
		);

		$this->add_control(
			'heading',
			[
				'label' => esc_html__('Heading', 'seine'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('This is the heading', 'seine'),
			]
		);

		$this->add_control(
			'content',
			[
				'label' => esc_html__('content', 'seine'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('', 'seine'),
			]
		);


		$this->end_controls_section();
	}



	protected function register_style_content_section_controls()
	{

		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__('Content Box', 'seine'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'icon_style',
			[
				'label' => __('Icon', 'seine'),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'icon_ratio_size',
			[
				'label' => __('Size', 'seine'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 52,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bt-icon-text-box--icon' => 'width: {{SIZE}}px;',
					'{{WRAPPER}} .bt-icon-text-box--infor' => 'width: calc( 100% - {{SIZE}}px );',
				],
			]
		);
		$this->add_responsive_control(
			'icon_gap',
			[
				'label' => __('Gap', 'seine'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 15,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bt-icon-text-box--infor' => 'padding-left: {{SIZE}}px;',
				],
			]
		);
		$this->add_responsive_control(
			'content_gap',
			[
				'label' => __('Content Spacing', 'seine'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 8,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bt-icon-text-box--heading' => 'margin-bottom: {{SIZE}}px;',
				],
			]
		);


		$this->add_control(
			'heading_style',
			[
				'label' => __('Heading', 'seine'),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'heading_color',
			[
				'label' => __('Heading Color', 'seine'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-icon-text-box--heading' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'heading_typography',
				'label' => __('Heading Typography', 'seine'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-icon-text-box--heading',
			]
		);
		$this->add_control(
			'content_style',
			[
				'label' => __('Content', 'seine'),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => __('Content Color', 'seine'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-icon-text-box--content' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => __('Price Typography', 'seine'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-icon-text-box--content',
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
		$icon_link_url = !empty($settings['icon_link']['url']) ? $settings['icon_link']['url'] : '';

?>
		<div class="bt-elwg-icon-text-box-item">

			<div class="bt-icon-text-box">
				<?php if (!empty($settings['icon'])) {
				?>
					<div class="bt-icon-text-box--icon">
						<?php
						if (!empty($icon_link_url)) {
							echo '<a href="' . esc_url($icon_link_url) . '">';
						}
						?>
						<img src="<?php echo esc_url($settings['icon']['url']) ?>" alt="" />
						<?php
						if (!empty($icon_link_url)) {
							echo '</a>';
						}
						?>
					</div>

				<?php

				} ?>
				<div class="bt-icon-text-box--infor">
					<?php
					if (!empty($icon_link_url)) {
						echo '<a href="' . esc_url($icon_link_url) . '">';
					}

					if (!empty($settings['heading'])) {
						echo '<h3 class="bt-icon-text-box--heading">' . $settings['heading'] . '</h3>';
					}
					?>
					<?php
					if (!empty($settings['content'])) {
						echo '<span class="bt-icon-text-box--content">' . $settings['content'] . '</span>';
					}
					?>
					<?php
					if (!empty($icon_link_url)) {
						echo '</a>';
					}
					?>
				</div>
			</div>

		</div>
<?php
	}

	protected function content_template()
	{
	}
}
