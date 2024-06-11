<?php
namespace SeineElementorWidgets\Widgets\CarsSearch;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Css_Filter;

class Widget_CarsSearch extends Widget_Base {

	public function get_name() {
		return 'bt-cars-search';
	}

	public function get_title() {
		return __( 'Cars Search', 'seine' );
	}

	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	public function get_categories() {
		return [ 'seine' ];
	}

	public function get_script_depends() {
		return ['select2-min', 'elementor-widgets' ];
	}
	
	protected function register_content_section_controls() {
		$this->start_controls_section(
			'ss_cars_search_content',[
				'label' => __( 'Content', 'seine' ),
			]
		);

			$this->add_control(
				'top_search_heading',[
					'label' => __( 'Top Search', 'seine' ),
					'type' => Controls_Manager::HEADING,
				]
			);

			$this->add_control(
				'top_search_title', [
					'label'       => __( 'Title', 'seine' ),
					'type'        => Controls_Manager::TEXT,
					'label_block' => true,
					'default'     => 'Top Seach:',
				]
			);

			$repeater = new Repeater();

			$repeater->add_control(
				'top_search_text', [
					'label'       => esc_html__( 'Text', 'seine' ),
					'type'        => Controls_Manager::TEXT,
					'label_block' => true,
					'default'     => 'This is text',
				]
			);

			$repeater->add_control(
				'top_search_link', [
					'label' => esc_html__( 'Link', 'seine' ),
					'type' => Controls_Manager::TEXT,
					'label_block' => true,
					'default' => '',
				]
			);

			$this->add_control(
				'cars_top_search',[
					'label' => esc_html__( 'List Items', 'seine' ),
					'type' => Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[
							'top_search_text'  => __( 'This is text 01', 'seine' ),
							'top_search_link'  => '#'
						],
						[
							'top_search_text'  => __( 'This is text 02', 'seine' ),
							'top_search_link'  => '#'
						],
						[
							'top_search_text'  => __( 'This is text 03', 'seine' ),
							'top_search_link'  => '#'
						],
					],
					'title_field' => '{{{ top_search_text }}}',
				]
			);

		$this->end_controls_section();
	}

	protected function register_style_content_section_controls() {
		$this->start_controls_section(
			'ss_cars_search_general',[
				'label' => esc_html__( 'General', 'seine' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'ss_cars_search_general_bcl',[
					'label' => esc_html__( 'Background Color', 'seine' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#fff',
					'selectors' => [
						'{{WRAPPER}} .bt-elwg-cars-search-inner' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'ss_cars_search_general_pd',[
					'label' => esc_html__( 'Padding', 'seine' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'top'    => 10,
						'right'  => 10,
						'bottom' => 10,
						'left'   => 10,
						'unit'   => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .bt-elwg-cars-search-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					],
				]
			);

			$this->add_responsive_control(
				'ss_cars_search_general_bri',[
					'label' => esc_html__( 'Border Radius', 'seine' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'top'    => 10,
						'right'  => 10,
						'bottom' => 10,
						'left'   => 10,
						'unit'   => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .bt-elwg-cars-search-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
						'{{WRAPPER}} .bt-elwg-cars-search--form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Box_Shadow::get_type(),[
					'name' => 'ss_cars_search_general_box_shadow',
					'selector' => '{{WRAPPER}} .bt-elwg-cars-search-inner',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'ss_style_form_search',[
				'label' => esc_html__( 'Form', 'seine' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_responsive_control(
				'ss_style_form_search_pd',[
					'label' => esc_html__( 'Padding', 'seine' ),
					'type'  => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'top'    => 30,
						'right'  => 30,
						'bottom' => 27,
						'left'   => 30,
						'unit'   => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .bt-elwg-cars-search--form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'ss_style_form_search_typography',
					'label'    => esc_html__( 'Typography', 'seine' ),
					'default'  => '',
					'selector' => '{{WRAPPER}} .bt-elwg-cars-search-inner .bt-field-type-select .select2-container .select2-selection--single .select2-selection__rendered',
				]
			);

			$this->add_control(
				'cars_search_form_fields_color',[
					'label'     => esc_html__( 'Color', 'seine' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .select2-container .select2-selection__rendered' => 'color: {{VALUE}};',
					],
				]
			);
		$this->end_controls_section();

		$this->start_controls_section(
			'ss_style_top_search',[
				'label' => esc_html__( 'Top Search', 'seine' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_control(
				'top_search_heading_title',[
					'label' => esc_html__( 'Title', 'seine' ),
					'type'  => Controls_Manager::HEADING,
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),[
					'name'     => 'top_search_title_typography',
					'label'    => esc_html__( 'Typography', 'seine' ),
					'default'  => '',
					'selector' => '{{WRAPPER}} .bt-elwg-cars-search--form-top-search p',
				]
			);

			$this->add_control(
				'top_search_title_color',[
					'label'     => esc_html__( 'Color', 'seine' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#fff',
					'selectors' => [
						'{{WRAPPER}} .bt-elwg-cars-search--form-top-search p' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'top_search_heading_content',[
					'label' => esc_html__( 'Content', 'seine' ),
					'type'  => Controls_Manager::HEADING,
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),[
					'name'     => 'top_search_content_typography',
					'label'    => esc_html__( 'Typography', 'seine' ),
					'default'  => '',
					'selector' => '{{WRAPPER}} .bt-elwg-cars-search--form-top-search a',
				]
			);

			$this->add_control(
				'top_search_content_color',[
					'label'     => esc_html__( 'Color', 'seine' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#fff',
					'selectors' => [
						'{{WRAPPER}} .bt-elwg-cars-search--form-top-search a' => 'color: {{VALUE}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'ss_style_form_bg',[
				'label' => esc_html__( 'Background', 'seine' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Background::get_type(),[
					'name'     => 'elwg_cars_search_bg',
					'label'    => esc_html__( 'Color', 'seine' ),
					'types'    => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .bt-elwg-cars-search--form',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'ss_style_form_bg_overlay',[
				'label' => esc_html__( 'Background Overlay', 'seine' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Background::get_type(),[
					'name'     => 'elwg_cars_search_bg_overlay',
					'label'    => esc_html__( 'Color', 'seine' ),
					'types'    => ['classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .bt-elwg-cars-search--form::before',
				]
			);

			$this->add_responsive_control(
				'elwg_cars_search_bg_overlay_opacity',[
					'label' => esc_html__( 'Opacity', 'seine' ),
					'type'  => Controls_Manager::SLIDER,
					'default'  => [
						'size' => .5,
					],
					'range' => [
						'px' => [
							'max' => 1,
							'step' => 0.01,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .bt-elwg-cars-search--form::before' => 'opacity: {{SIZE}};',
					],
					'condition' => [
						'elwg_cars_search_bg_overlay_background' => [ 'classic', 'gradient' ],
					],
				]
			);

			$this->add_control(
				'elwg_cars_search_bg_overlay_blend_mode',[
					'label'   => esc_html__( 'Blend Mode', 'seine' ),
					'type'    => Controls_Manager::SELECT,
					'options' => [
						''            => esc_html__( 'Normal', 'seine' ),
						'multiply'    => esc_html__( 'Multiply', 'seine' ),
						'screen'      => esc_html__( 'Screen', 'seine' ),
						'overlay'     => esc_html__( 'Overlay', 'seine' ),
						'darken'      => esc_html__( 'Darken', 'seine' ),
						'lighten'     => esc_html__( 'Lighten', 'seine' ),
						'color-dodge' => esc_html__( 'Color Dodge', 'seine' ),
						'saturation'  => esc_html__( 'Saturation', 'seine' ),
						'color'       => esc_html__( 'Color', 'seine' ),
						'luminosity'  => esc_html__( 'Luminosity', 'seine' ),
						'difference'  => esc_html__( 'Difference', 'seine' ),
						'exclusion'   => esc_html__( 'Exclusion', 'seine' ),
						'hue'         => esc_html__( 'Hue', 'seine' ),
					],
					'selectors' => [
						'{{WRAPPER}} .bt-elwg-cars-search--form::before' => 'mix-blend-mode: {{VALUE}}',
					],
					'conditions' => [
						'relation' => 'or',
						'terms' => [
							[
								'name'     => 'elwg_cars_search_bg_overlay_image[url]',
								'operator' => '!==',
								'value'    => '',
							],
							[
								'name'     => 'elwg_cars_search_bg_overlay_color',
								'operator' => '!==',
								'value'    => '',
							],
						],
					],
				]
			);

		$this->end_controls_section();

	}

	protected function register_controls() {
		$this->register_content_section_controls();
		$this->register_style_content_section_controls();
	}

	protected function render() {
		$settings  = $this->get_settings_for_display();
		?>
			<div class="bt-elwg-cars-search--default">
				<?php get_template_part( 'framework/templates/car-search', 'style', array('layout' => 'style-default', 'data' => $settings)); ?>
			</div>
		<?php
	}

	protected function content_template() {

	}
}
