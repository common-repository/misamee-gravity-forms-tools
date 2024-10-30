<?php
/*
Plugin Name: Misamee Gravity Forms Tools
Plugin URI: http://misamee.com/2012/10/misamee-gravity-forms-tools/
Description: Add a shortcode that sums data frm Gravity Forms entries, showing the result as a value, percentage or progressbar.
Version: 1.3.1
Author: Misamee
Author URI: http://misamee.com/
*/
/*

== Changelog ==
See readme.txt


TODO: show the progress bar in "Gravity Forms Directory & Addons"
*/

if(!defined("RG_CURRENT_PAGE"))
    define("RG_CURRENT_PAGE", basename($_SERVER['PHP_SELF']));

if (!class_exists('misamee_tools')) {
	require_once 'lib/misamee_tools.php';
}

if (!class_exists('misamee_gf_tools')) {
	class misamee_gf_tools
	{
		/**
		 * @var string The options string name for this plugin
		 */
		//var $optionsName = 'misamee_gf_tools_options';

		var $pluginBaseName = "";

		/**
		 * @var array $options Stores the options for this plugin
		 */
		//var $options = array();
		/**
		 * @var string $localizationDomain Domain used for localization
		 */
		static $localizationDomain = "misamee-gf-tools";

		static $pluginPath;
		static $pluginUrl;

        static $defaults = array(
                            'id' => false,
                            'cssclass' => 'grand-total',
                            'htmlelement' => 'div',
                            'exp' => '',
                            'maxvalueexp' => '',
                            'autostyle' => 1,
                            'hidevalue' => 1,
                            'colors' => '#f00,#ff0,#0f0',
                            'thousandsseparator' => 0,
                            'decimals' => 0,
                            'search' => '',
                            'star' => null,
                            'entrystatus' => 'active',
                        );

		//Class Functions
		public static function init()
		{
			$class = __CLASS__;
			new $class;
		}

		/**
		 * PHP 5 Constructor
		 */
		public function __construct()
		{
			if (self::is_gravityforms_installed()) {
				//"Constants" setup
				// Set Plugin Path
				self::$pluginPath = self::getPluginUrl();
				// Set Plugin URL
				self::$pluginUrl = self::getPluginPath();

				//Initialize the options
				//$this->getOptions();
				//Admin menu
				//add_action("admin_menu", array(&$this, "admin_menu_link"));

				//Actions
				//add_action('admin_enqueue_scripts', array(&$this,'misamee_gf_tools_script')); // or wp_enqueue_scripts, login_enqueue_scripts
				if (!is_admin()) {
					if (!class_exists('mgft_shortcodes')) {
						require_once 'lib/mgft_shortcodes.php';
					}
					if (!class_exists('mgft_shortcodes')) {
						return;
					} else {
						mgft_shortcodes::setup_shortcodes();
					}
					$this->misamee_gf_tools_filters();
				}
				if (!class_exists('mgft_editor')) {
					require_once 'lib/mgft_editor.php';
				}
				if (!class_exists('mgft_editor')) {
					return;
				} else {
					mgft_editor::setup_editor(self::$pluginUrl);
					if(in_array(RG_CURRENT_PAGE, array('post.php', 'page.php', 'page-new.php', 'post-new.php'))){
						 add_action('admin_footer',  array('mgft_editor', 'add_mce_popup'));
					 }
				}
			} else {
				add_action('admin_notices', array(&$this, 'gravityFormsIsMissing'));
			}
		}

        public static function getPluginUrl() {
            return plugin_dir_url(__FILE__);
        }

        public static function getPluginPath()
        {
            return plugin_dir_path(__FILE__);
        }

		private function gravityFormsIsMissing()
		{
			misamee_tools::showMessage("You must have Gravity Forms installed in order to use this plugin.", true);
		}


		public static function is_gravityforms_installed()
		{
			return class_exists("RGForms");
		}

		function misamee_gf_tools_localization()
		{
			$locale = get_locale();
			$mo = plugins_url("/languages/" . $this->localizationDomain . "-" . $locale . ".mo", __FILE__);
			load_plugin_textdomain($this->localizationDomain, false, dirname(plugin_basename(__FILE__)) . '/languages/');
		}


		function misamee_gf_tools_filters()
		{
		}
	} //End Class
} //End if class exists statement

if (class_exists('misamee_gf_tools')) {
	add_action('plugins_loaded', array('misamee_gf_tools', 'init'));
} else {
	echo "Can't find misamee_gf_tools.";
}