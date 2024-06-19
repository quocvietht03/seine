<?php

namespace SeineElementorWidgets\Widgets\SiteSocial;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class Widget_SiteSocial extends Widget_Base
{

	public function get_name()
	{
		return 'bt-site-social';
	}

	public function get_title()
	{
		return __('Site Social', 'seine');
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
			'title',
			[
				'label' => esc_html__('Title', 'seine'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => '',
			]
		);

		$this->end_controls_section();
	}

	protected function register_layout_section_controls()
	{
		$this->start_controls_section(
			'section_layout',
			[
				'label' => __('Layout', 'seine'),
			]
		);

		$this->add_responsive_control(
			'text_align',
			[
				'label' => esc_html__('Alignment', 'seine'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__('Left', 'seine'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'seine'),
						'icon' => 'eicon-text-align-center',
					],
					'end' => [
						'title' => esc_html__('Right', 'seine'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-site-social' => 'justify-content: {{VALUE}};',
				],
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
			'title_color',
			[
				'label' => __('Title Color', 'seine'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-site-social span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __('Title Typography', 'seine'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-elwg-site-social span',
			]
		);

		$this->end_controls_section();
	}

	protected function register_controls()
	{
		$this->register_content_section_controls();
		$this->register_layout_section_controls();
		$this->register_style_content_section_controls();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		if (function_exists('get_field')) {
			$site_infor = get_field('site_information', 'options');
		} else {
			return;
		}

		if (empty($site_infor['site_socials'])) {
			return;
		}

?>
		<div class="bt-elwg-site-social">
			<?php
			if (!empty($settings['title'])) {
				echo '<span class="bt-title">' . $settings['title'] . '</span>';
			}

			foreach ($site_infor['site_socials'] as $item) {
				if ($item['social'] == 'facebook') {
					echo '<a class="bt-' . esc_attr($item['social']) . '" href="' . esc_url($item['link']) . '" target="_blank">
	<svg width="10" height="18" viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M9.37955 0.428292V3.08008H7.80255C6.56706 3.08008 6.33603 3.67271 6.33603 4.52651V6.42494H9.27911L8.88737 9.39816H6.33603V17.022H3.26237V9.39816H0.700983V6.42494H3.26237V4.23521C3.26237 1.69392 4.81929 0.307755 7.08938 0.307755C8.1742 0.307755 9.10835 0.388113 9.37955 0.428292Z" fill="white"/>
</svg>


										</a>';
				}

				if ($item['social'] == 'linkedin') {
					echo '<a class="bt-' . esc_attr($item['social']) . '" href="' . esc_url($item['link']) . '" target="_blank">
		<svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M4.27079 4.91476V14.869H0.956061V4.91476H4.27079ZM4.48173 1.8411C4.49178 2.79534 3.76856 3.55873 2.61343 3.55873H2.59334C1.47838 3.55873 0.765213 2.79534 0.765213 1.8411C0.765213 0.866768 1.50852 0.123465 2.63352 0.123465C3.76856 0.123465 4.47169 0.866768 4.48173 1.8411ZM16.1938 9.16364V14.869H12.8891V9.54534C12.8891 8.2094 12.407 7.29534 11.2116 7.29534C10.2976 7.29534 9.75517 7.90806 9.5141 8.5007C9.43374 8.72168 9.40361 9.01297 9.40361 9.31431V14.869H6.09892C6.1391 5.84891 6.09892 4.91476 6.09892 4.91476H9.40361V6.36119H9.38352C9.81544 5.67815 10.5989 4.68373 12.3869 4.68373C14.5666 4.68373 16.1938 6.11007 16.1938 9.16364Z" fill="white"/>
</svg>

										</a>';
				}

				if ($item['social'] == 'twitter') {
					echo '<a class="bt-' . esc_attr($item['social']) . '" href="' . esc_url($item['link']) . '" target="_blank">
				<svg width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M15.8842 2.40597C15.4423 3.04883 14.8898 3.62137 14.257 4.08343C14.267 4.22405 14.267 4.36468 14.267 4.5053C14.267 8.79436 11.0025 13.7363 5.036 13.7363C3.19783 13.7363 1.49024 13.204 0.053857 12.2799C0.315018 12.31 0.566134 12.32 0.837339 12.32C2.35408 12.32 3.75029 11.8078 4.86524 10.9339C3.4389 10.9037 2.24359 9.96959 1.83176 8.68387C2.03265 8.71401 2.23354 8.7341 2.44448 8.7341C2.73578 8.7341 3.02707 8.69392 3.29828 8.6236C1.81167 8.32227 0.696714 7.01646 0.696714 5.43945C0.696714 5.42941 0.696714 5.40932 0.696714 5.39927C1.12863 5.64035 1.63087 5.79102 2.16323 5.8111C1.28935 5.22852 0.716803 4.2341 0.716803 3.1091C0.716803 2.50642 0.877518 1.95396 1.15877 1.47182C2.75587 3.44057 5.15654 4.72628 7.8485 4.86691C7.79828 4.62584 7.76814 4.37472 7.76814 4.1236C7.76814 2.33566 9.21457 0.879185 11.0126 0.879185C11.9467 0.879185 12.7905 1.27093 13.3831 1.90374C14.1164 1.76311 14.8195 1.49191 15.4423 1.12026C15.2012 1.8736 14.6889 2.50642 14.0159 2.9082C14.6688 2.83789 15.3016 2.65709 15.8842 2.40597Z" fill="white"/>
</svg>


										</a>';
				}

				if ($item['social'] == 'google') {
					echo '<a class="bt-' . esc_attr($item['social']) . '" href="' . esc_url($item['link']) . '" target="_blank">
		<svg width="23" height="15" viewBox="0 0 23 15" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M14.2508 7.87891C14.2508 11.8538 11.5851 14.6713 7.57227 14.6713C3.7302 14.6713 0.618591 11.5597 0.618591 7.71763C0.618591 3.87556 3.7302 0.76395 7.57227 0.76395C9.45062 0.76395 11.0159 1.44699 12.2302 2.58538L10.3424 4.39732C9.83009 3.90402 8.92886 3.32533 7.57227 3.32533C5.20062 3.32533 3.26535 5.28906 3.26535 7.71763C3.26535 10.1462 5.20062 12.1099 7.57227 12.1099C10.3234 12.1099 11.3574 10.1272 11.5187 9.11217H7.57227V6.72154H14.137C14.2034 7.07254 14.2508 7.42355 14.2508 7.87891ZM22.4757 6.72154V8.71373H20.493V10.6964H18.5008V8.71373H16.5181V6.72154H18.5008V4.73884H20.493V6.72154H22.4757Z" fill="#E22E04"/>
</svg>


										</a>';
				}
			}
			?>
		</div>
<?php
	}

	protected function content_template()
	{
	}
}
