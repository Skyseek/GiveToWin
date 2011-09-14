<?php
/*
 Plugin Name: Register Modal Box
 Plugin URI: http://axcoto.com/blog/article/282
 Description: Adding ability to add modal register box
 Version: 1.0
 Author: kureikain <kureikain@gmail.com>
 Author URI: http://www.axcoto.com/blog
 */

 
if (!defined('WP_CONTENT_URL'))
define('WP_CONTENT_URL', get_option('siteurl') . '/wp-content');
if (!defined('WP_CONTENT_DIR'))
define('WP_CONTENT_DIR', ABSPATH . 'wp-content');
if (!defined('WP_PLUGIN_URL') )
define('WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins');
if (!defined('WP_PLUGIN_DIR') )
define('WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins');

if (!class_exists('AxcotoModalRegister')) {
	class AxcotoModalRegister {
		/**
		 * @var string The plugin version
		 */
		public $version = '1.0.1';

		/**
		 * @var string The options string name for this plugin
		 */
		var $optionsName = 'axcoto_modal_register_options';

		/**
		 * @var string $localizationDomain Domain used for localization
		 */
		public $localizationDomain = 'axcoto_modal_register';

		/**
		 * @var string $pluginurl The url to this plugin
		 */
		public $pluginurl = '';
		/**
		 * @var string $pluginpath The path to this plugin
		 */
		public $pluginpath = '';

		/**
		 * @var array $options Stores the options for this plugin
		 */
		public $options = array();

		/**
		 * PHP 5 Constructor
		 */
		function __construct() {
			$name = dirname(plugin_basename(__FILE__));
			//Language Setup
			load_plugin_textdomain($this->localizationDomain, false, "$name/I18n/");

			//"Constants" setup
			$this->pluginurl = WP_PLUGIN_URL . "/$name/";
			$this->pluginpath = WP_PLUGIN_DIR . "/$name/";

			//Initialize the options
			$this->get_options();

			//Actions
			add_action('admin_menu', array(&$this, 'admin_menu_link'));

			if (!is_admin()) {
				add_filter('register', array(&$this, 'registerLink'));
				add_action('wp_head', array($this, 'header'));
				add_action('wp_footer', array($this, 'footer'));
				add_action('wp_print_styles', array(&$this, 'css'));
				add_action('wp_print_scripts', array(&$this, 'js'));
			}

			add_action('init', array(&$this, 'init'));
				
			add_action('wp_ajax_modal_register', array(&$this, 'doUserAjax'));
			add_action('wp_ajax_nopriv_modal_register', array(&$this, 'doUserAjax'));
		}

		function init() {
			session_start();
		}

		function css() {
			wp_enqueue_style('axcoto-register-modal', $this->pluginurl . "assets/css/default.css", false, $this->version, 'screen');
		}

		function js() {
			wp_enqueue_script('axcoto-register-modal', $this->pluginurl . "assets/js/default.js", false, $this->version, true);
		}

		function registerLink($link) {
			if (!is_user_logged_in()) {
				//$link  = '<a href="#register-modal-form" class="axcoto-register-modal">Register</a>';
				$link = str_replace('href=', 'class="axcoto-register-modal" href=', $link);
			}
			return $link;
		}

		function footer() {
			include 'templates/register.php';
		}
		
		function header() {
			echo '
			<script type="text/javascript">var blogUrl = "', get_bloginfo('url'),'";</script>';
		}

		/**
		 * Retrieves the plugin options from the database.
		 * @return array
		 */
		function get_options() {
			if (!$options = get_option($this->optionsName)) {
				$options = array(
					'admin' => true,
					'theme' => 'default'
					);
					update_option($this->optionsName, $options);
			}
			$this->options = $options;
		}

		/**
		 * Saves the admin options to the database.
		 */
		function save_admin_options(){
			return update_option($this->optionsName, $this->options);
		}

		/**
		 * @desc Adds the options subpanel
		 */
		function admin_menu_link() {
			add_options_page('RegisterModal Box', 'RegisterModal Box', 10, basename(__FILE__), array(&$this, 'admin_options_page'));
			add_filter('plugin_action_links_' . plugin_basename(__FILE__), array(&$this, 'filter_plugin_actions'), 10, 2 );
		}

		/**
		 * @desc Adds the Settings link to the plugin activate/deactivate page
		 */
		function filter_plugin_actions($links, $file) {
			$settings_link = '<a href="options-general.php?page=' . basename(__FILE__) . '">' . __('Settings', $this->localizationDomain) . '</a>';
			array_unshift($links, $settings_link); // before other links
			return $links;
		}

		/**
		 * Adds settings/options page
		 */
		function admin_options_page() {
			include 'templates/options.php';
		}
		
		/**
		 * Ajax handle 
		 */
		function doUserAjax() {
			include $this->pluginpath . '/captcha.class.php';
			include $this->pluginpath . '/user.php';
			//print_r($_SESSION);
			if (!AxcotoCaptcha::isValid($_POST['captcha'])) {
				$result = array('error' => 4, 'msg' => '<span>Captcha is not correct</span>');
				echo json_encode($result);
				exit();
			}
			
			$user = new AxcotoModalRegisterUser();
			$username = $_POST['username'];
			$password = $_POST['password'];
			$email = $_POST['email'];
			$result = $user->userAdd($username, $password, $email);
			echo json_encode($result); 
			die();
		}
	}
}

//instantiate the class
if (class_exists('AxcotoModalRegister')) {
	$simplemodal_login = new AxcotoModalRegister();
}

/*
 * The format of this plugin is based on the following plugin template:
 * http://pressography.com/plugins/wordpress-plugin-template/
 */
