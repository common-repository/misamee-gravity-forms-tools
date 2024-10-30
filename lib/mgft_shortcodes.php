<?php
/**
 * mgft_shortcodes.php Created by Andrea Sciamanna
 * On 25/10/12, 12.03
 */
class mgft_shortcodes
{
	static $add_script;
	static $add_style;

	static function setup_shortcodes()
	{
		add_shortcode('mgft-grandtotal', array(__CLASS__, 'grand_total'));
		add_shortcode('mgft-progressbar', array(__CLASS__, 'progressBar'));

		add_action('wp_enqueue_scripts', array(__CLASS__, 'register_style'));
		add_action('wp_footer', array(__CLASS__, 'print_style'));
	}

	static function setup_tinyMCE()
	{
		add_action('init', array(__CLASS__, 'misamee_gf_shortcode_button'));
	}

	static function register_script()
	{
		wp_register_script('mgft-script', misamee_gf_tools::getPluginUrl() . 'js/script.js', array('jquery'), false, true);
	}

	static function register_style()
	{
		wp_register_style('mgft-style', misamee_gf_tools::getPluginUrl() . 'css/style.css');
	}

	static function print_script()
	{
		if (!self::$add_script)
			return;

		wp_print_scripts('mgft-script');
	}

	static function print_style()
	{
		if (!self::$add_style)
			return;

		wp_enqueue_style('mgft-style');
	}

	private static function isNullOrEmpty($question)
	{
		return (!isset($question) || trim($question) === '');
	}

	static function parseArguments($attributes)
	{
		$mgftDefaults = misamee_gf_tools::$defaults;

		$id = false;
		/** @noinspection PhpUnusedLocalVariableInspection */
		/** @noinspection SpellCheckingInspection */
		$cssclass = 'grand-total';
		/** @noinspection SpellCheckingInspection */
		$htmlelement = 'div';
		/** @noinspection SpellCheckingInspection */
		$exp = "";
		/** @noinspection SpellCheckingInspection */
		$maxvalueexp = "";
		/** @noinspection SpellCheckingInspection */
		$autostyle = false;
		$hidevalue = false;
		$colors = '#f00,#ff0,#0f0';
		/** @noinspection SpellCheckingInspection */
		$thousandsseparator = false;
		$decimals = 0;
		$search = '';
		$star = null;
		/** @noinspection SpellCheckingInspection */
		$entrystatus = 'active';

		foreach ($attributes as $key => $att) {
			if (strtolower($att) == 'false') {
				$attributes[$key] = false;
			}
			if (strtolower($att) == 'true') {
				$attributes[$key] = true;
			}
		}
		//print_r($attributes);

		/** @noinspection SpellCheckingInspection */
		extract(shortcode_atts($mgftDefaults, $attributes), EXTR_OVERWRITE);

		if (!class_exists('grand_total_helper')) {
			require_once 'grand_total_helper.php';
		}

		/** @noinspection SpellCheckingInspection */
		return array(
			'expression' => $exp,
			'maxValueExp' => $maxvalueexp,
			'formId' => $id,
			'cssClass' => $cssclass,
			'htmlElement' => $htmlelement,
			'autoStyle' => $autostyle,
			'hideValue' => $hidevalue,
			'colors' => $colors,
			'thousandsSeparator' => $thousandsseparator,
			'decimals' => $decimals,
			'search' => $search,
			'star' => $star,
			'entryStatus' => $entrystatus,
		);
	}

	static function grand_total($attributes)
	{
		$result = 0;
		$params = self::parseArguments($attributes);
		$helper = new grand_total_helper();

		//Gets shortcode argument
		include('mgft_shortcodes_common.php');

		$format = '<%1$s class="%2$s">%3$s</%1$s>';

		//echo '<pre>' . print_r($helper, true) . '</pre>';

		if (!self::isNullOrEmpty($helper->valueExpression)) {
			$result = $helper->getValue();
		}
		if ($helper->thousandsSeparator || $helper->decimals) {
			$displayValue = number_format($result, $helper->decimals);
		} else {
			$displayValue = $result;
		}
		try {
			return sprintf($format, $helper->htmlElement, $helper->cssClass, $displayValue);
		} catch (Exception $e) {
			return __('Missing parameters!', misamee_gf_tools::$localizationDomain);
		}
	}

	static function progressBar($attributes)
	{
		$params = self::parseArguments($attributes);
		$helper = new grand_total_helper();
		$displayValue = '';

		//Gets shortcode argument
		include('mgft_shortcodes_common.php');

		$format = '<%1$s class="%6$s%2$s %2$s-perc-%3$s %2$s-val-%4$s %2$s-max-%5$s" data-value="%4$s" data-max="%5$s" data-percentage="%3$s" data-colors="%7$s"><span%9$s>%8$s%%</span></%1$s>';

		$value = 0;
		$maxValue = 0;
		if (!self::isNullOrEmpty($helper->valueExpression)) {
			$value = $helper->getValue();
		}
		if (!self::isNullOrEmpty($helper->maxValueExpression)) {
			$maxValue = $helper->getMaxValue();
		}

		$percentage = 0;

		if ($maxValue != 0) {
			$percentage = ($value / $maxValue) * 100;
			if ($helper->thousandsSeparator || $helper->decimals) {
				$displayValue = number_format($percentage, $helper->decimals);
			} else {
				$displayValue = intval($percentage);
			}
			$percentage = intval($percentage);
		} else {
			echo $maxValue;
		}

		$style = '';
		$autoStyle = '';
		if ($params['autoStyle']) {
			self::$add_script = true;
			self::$add_style = true;
			$style .= 'mgft-progressbar mgft-progressbar-' . $percentage . ' ';
			$autoStyle = ' style="';

			$autoStyle .= 'width:' . $percentage . '%;';
			$colorsArray = explode(',', $helper->colors);
			$colorsCount = count($colorsArray);
			if ($colorsCount != 0) {
				$segments = 100 / $colorsCount;
				for ($i = 0; $i < $colorsCount; $i++) {
					$segment = ($i + 1);
					if ($percentage <= ($segment * $segments)) {
						$autoStyle .= 'background-color:' . $colorsArray[$i] . ';';
						break;
					}
				}
			}

			$autoStyle .= '"';
		}
		if ($params['hideValue']) {
			$style .= 'hidevalue ';
		}

		try {
			return sprintf($format, $helper->htmlElement, $helper->cssClass, $percentage, $value, $maxValue, $style, $params['colors'], $displayValue, $autoStyle);
		} catch (Exception $e) {
			return __('Missing parameters!', misamee_gf_tools::$localizationDomain);
		}
	}
}
