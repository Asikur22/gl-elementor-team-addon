<?php

use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;

/**
 * Elementor Team Widget.
 *
 * Elementor widget that inserts terms of a taxonomy into the page.
 *
 * @since 1.0.0
 */
class GL_Elementor_Team_Widget extends Widget_Base {
	
	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_name() {
		return 'gl-ele-team';
	}
	
	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_title() {
		return __( 'Team Slider', 'gl-elementor-addon' );
	}
	
	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_icon() {
		return 'fa fa-list';
	}
	
	/**
	 * Get widget scripts.
	 *
	 * @return string Widget scripts.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_script_depends() {
		return [ 'swiper', 'gl-ele-addon' ];
	}
	
	/**
	 * Get widget stylesheet.
	 *
	 * @return string Widget stylesheet.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_style_depends() {
		return [ 'gl-ele-addon' ];
	}
	
	/**
	 * Get widget categories.
	 *
	 * @return array Widget categories.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_categories() {
		return [ 'basic' ];
	}
	
	/**
	 * Register Taxonomy widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'gl-elementor-addon' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		
		$repeater = new \Elementor\Repeater();
		
		$repeater->add_control(
			'name',
			[
				'label'       => __( 'Name', 'gl-elementor-addon' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'title',
			[
				'label'       => __( 'Title', 'gl-elementor-addon' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'text',
			[
				'label'       => __( 'Text', 'gl-elementor-addon' ),
				'type'        => Controls_Manager::WYSIWYG,
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'image',
			[
				'label'   => __( 'Image', 'gl-elementor-addon' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		
		$repeater->add_control(
			'fb',
			[
				'label'       => __( 'Facebook Link', 'gl-elementor-addon' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'twitter',
			[
				'label'       => __( 'Button Link', 'gl-elementor-addon' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'yelp',
			[
				'label'       => __( 'Yelp Link', 'gl-elementor-addon' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'instagram',
			[
				'label'       => __( 'Instagram', 'gl-elementor-addon' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'linkedin',
			[
				'label'       => __( 'LinkedIn', 'gl-elementor-addon' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'teams',
			[
				'label'       => __( 'Team Member', 'gl-elementor-addon' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ name }}}',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'carousel_section',
			[
				'label' => __( 'Carousel Options', 'gl-elementor-addon' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'infinite',
			[
				'label'   => __( 'Infinite Loop', 'gl-elementor-addon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => __( 'Yes', 'gl-elementor-addon' ),
					'no'  => __( 'No', 'gl-elementor-addon' ),
				],
			]
		);
		
		$this->add_control(
			'navigation',
			[
				'label'   => __( 'Navigation', 'gl-elementor-addon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'both',
				'options' => [
					'both'   => __( 'Arrows and Dots', 'gl-elementor-addon' ),
					'arrows' => __( 'Arrows', 'gl-elementor-addon' ),
					'dots'   => __( 'Dots', 'gl-elementor-addon' ),
					'none'   => __( 'None', 'gl-elementor-addon' ),
				],
			]
		);
		
		$this->add_control(
			'autoplay',
			[
				'label'   => __( 'Autoplay', 'gl-elementor-addon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => __( 'Yes', 'gl-elementor-addon' ),
					'no'  => __( 'No', 'gl-elementor-addon' ),
				],
			]
		);
		
		$this->add_control(
			'autoplay_speed',
			[
				'label'   => __( 'Autoplay Timeout', 'gl-elementor-addon' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 8000,
			]
		);
		
		$this->add_control(
			'pause_on_hover',
			[
				'label'   => __( 'Pause on Hover', 'gl-elementor-addon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => __( 'Yes', 'gl-elementor-addon' ),
					'no'  => __( 'No', 'gl-elementor-addon' ),
				],
			]
		);
		
		$this->add_control(
			'item_spacing',
			[
				'label'   => __( 'Item Spacing', 'gl-elementor-addon' ),
				'type'    => Controls_Manager::SLIDER,
				'range'   => [
					'px' => [
						'max' => 100,
					],
				],
				'default' => [
					'size' => 0,
				],
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Team Member', 'gl-elementor-addon' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		// Name
		$this->add_control(
			'name_style',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Name', 'elementor-pro' ),
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'name_text_color',
			[
				'label'     => __( 'Text Color', 'gl-elementor-addon' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .name' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'name_typography',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .name',
			]
		);
		
		// Title
		$this->add_control(
			'title_style',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Title', 'elementor-pro' ),
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'title_text_color',
			[
				'label'     => __( 'Text Color', 'gl-elementor-addon' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .title' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
				'selector' => '{{WRAPPER}} .title',
			]
		);
		
		// Text
		$this->add_control(
			'text_style',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Text', 'elementor-pro' ),
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'text_text_color',
			[
				'label'     => __( 'Text Color', 'gl-elementor-addon' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .text' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'text_typography',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
				'selector' => '{{WRAPPER}} .text',
			]
		);
		
		// Icon
		$this->add_control(
			'icon_style',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Icon', 'elementor-pro' ),
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'icon_text_color',
			[
				'label'     => __( 'Text Color', 'gl-elementor-addon' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .team-socials svg path' => 'fill: {{VALUE}};',
					
				],
			]
		);
		
		$this->add_control(
			'icon_text_hover_color',
			[
				'label'     => __( 'Text Hover Color', 'gl-elementor-addon' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .team-socials a:hover svg path' => 'fill: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_section();
		
	}
	
	/**
	 * Render Social Item widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function social_items( $social, $icon ) {
		if ( isset( $social ) && ! empty( $social ) ) {
			$file = plugin_dir_path( __DIR__ ) . 'images/' . $icon . '.svg';
			
			echo '<a href="' . esc_url( $social ) . '">';
			include( $file );
			echo '</a>';
		}
	}
	
	/**
	 * Render Team widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		
		if ( ! empty( $settings['teams'] ) ) {
			$options = [
				'items'              => 1,
				'loop'               => $settings['infinite'] == 'yes' ? true : false,
				'dots'               => ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) ),
				'nav'                => ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) ),
				'autoplay'           => $settings['autoplay'] == 'yes' ? true : false,
				'autoplayTimeout'    => $settings['autoplay_speed'],
				'autoplayHoverPause' => $settings['pause_on_hover'] == 'yes' ? true : false,
				'margin'             => $settings['item_spacing']
			];
			?>
			<!-- Team Carousel-->
			<div class="team-carousel">
				<div class="swiper-container" data-settings="<?php echo htmlspecialchars( json_encode( $options ) ); ?>">
					<div class="swiper-wrapper">
						<?php foreach ( $settings['teams'] as $index => $item ) : ?>
							<div class="team-member swiper-slide">
								<div class="team-image">
									<?php echo wp_get_attachment_image( $item['image']['id'], 'full' ); ?>
									<div class="team-socials">
										<?php $this->social_items( $item['twitter'], 'twitter' ); ?>
										<?php $this->social_items( $item['fb'], 'facebook' ); ?>
										<?php $this->social_items( $item['yelp'], 'yelp' ); ?>
										<?php $this->social_items( $item['instagram'], 'instagram' ); ?>
										<?php $this->social_items( $item['linkedin'], 'linkedin' ); ?>
									</div>
								</div>
								<div class="team-text">
									<h3 class="name"><?php echo esc_html( $item['name'] ); ?></h3>
									<p class="title"><?php echo esc_html( $item['title'] ); ?></p>
									<div class="text"><?php echo apply_filters( 'the_content', $item['text'] ); ?></div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
					<?php if ( 1 < $settings['teams'] ) : ?>
						<?php if ( $options['dots'] ) : ?>
							<div class="swiper-pagination"></div>
						<?php endif; ?>
						<?php if ( $options['nav'] ) : ?>
							<div class="swiper-button-prev"></div>
							<div class="swiper-button-next"></div>
						<?php endif; ?>
					<?php endif; ?>
				</div>
			</div>
			<!-- / Team Carousel-->
			<?php
		}
	}
	
}