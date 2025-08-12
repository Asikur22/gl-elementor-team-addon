<?php
/*
 * Plugin Name: Gl ELementor Team Addon
 * Plugin URI: https://greenlifeit.com/plugins/
 * Description: Gl Elementor Addon for showing team members.
 * Author: Asiqur Rahman
 * Author URI: https://asique.net/
 * Version: 1.0.0
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: gl-elementor-team-addon
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Main Elementor Test Extension Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */
final class GL_Elementor_Addon {
	
	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 *
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';
	
	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';
	
	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';
	
	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * @var GL_Elementor_Addon The single instance of the class.
	 */
	private static $_instance = null;
	
	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @return GL_Elementor_Addon An instance of the class.
	 * @since 1.0.0
	 *
	 * @access public
	 * @static
	 *
	 */
	public static function instance() {
		
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		
		return self::$_instance;
	}
	
	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'i18n' ] );
		add_action( 'plugins_loaded', [ $this, 'init' ] );
	}
	
	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 *
	 * Fired by `init` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function i18n() {
		load_plugin_textdomain( 'gl-elementor-addon' );
	}
	
	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init() {
		
		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			
			return;
		}
		
		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			
			return;
		}
		
		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			
			return;
		}
		
		// Add Plugin actions
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
		
		// Register Widget Styles
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'widget_styles' ] );
	}
	
	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {
		
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}
		
		$message = sprintf(
		/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'gl-elementor-addon' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'gl-elementor-addon' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'gl-elementor-addon' ) . '</strong>'
		);
		
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
		
	}
	
	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {
		
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}
		
		$message = sprintf(
		/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'gl-elementor-addon' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'gl-elementor-addon' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'gl-elementor-addon' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);
		
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
		
	}
	
	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {
		
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}
		
		$message = sprintf(
		/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'gl-elementor-addon' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'gl-elementor-addon' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'gl-elementor-addon' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);
		
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
		
	}
	
	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_widgets() {
		// Include Widget files
		require_once( __DIR__ . '/widgets/team.php' );
		
		// Register widget
		Elementor\Plugin::instance()->widgets_manager->register_widget_type( new GL_Elementor_Team_Widget() );
	}
	
	/**
	 * Init Widgets Assets
	 *
	 * Include widgets Assets and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function widget_styles() {
		wp_register_style( 'gl-ele-addon', plugins_url( 'styles/style.css', __FILE__ ) );
		wp_register_script( 'gl-ele-addon', plugins_url( 'scripts/scripts.js', __FILE__ ), ['jquery'] );
	}
	
}

GL_Elementor_Addon::instance();