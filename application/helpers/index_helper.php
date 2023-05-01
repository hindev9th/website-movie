<?php
/**
 * get the defined config value by a key
 * @param string $key
 * @return config value
 */
if (!function_exists('get_setting')) {

	function get_setting($key = "")
	{
		$ci = get_instance();
		return $ci->config->item($key);
	}

}
/**
 * prepare uri
 *
 * @param string $uri
 * @return full url
 */
if (!function_exists('get_uri')) {

	function get_uri($uri = "")
	{
		$ci = get_instance();
		$index_page = $ci->config->item('index_page');
		return base_url($index_page . '/' . $uri);
	}

}


/**
 * link the css files
 *
 * @param array $array
 * @return print css links
 */
if (!function_exists('load_css')) {

	function load_css(array $array)
	{
		$version = get_setting("app_version");

		foreach ($array as $uri) {
			echo "<link rel='stylesheet' type='text/css' href='" . base_url($uri) . "?v=$version' />";
		}
	}

}

/**
 * link the javascript files
 *
 * @param array $array
 * @return print js links
 */
if (!function_exists('load_js')) {

	function load_js(array $array)
	{
		$version = get_setting("app_version");

		foreach ($array as $uri) {
			echo "<script type='text/javascript'  src='" . base_url($uri) . "?v=$version'></script>";
		}
	}

}

/**
 * format datetime to string date or hour ago
 *
 * @param string $time
 * @return false|String time ago
 */
if (!function_exists('format_time')) {
	function format_time(string $time)
	{
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$startTime = date('H:i:s d-m-Y', strtotime($time));
		$endTime = date('H:i:s d-m-Y');
		$second = strtotime($endTime) - strtotime($startTime);
		$minutes = $second / 60;
		$hour = $minutes / 60;
		$day = $hour / 24;

		if ($second < 0){
			return $startTime;
		}

		if ($second < 60) {
			return intval($second) . " Second ago";
		}

		if ($minutes < 60) {
			return intval($minutes) . " Minute ago";
		}

		if ($hour < 24) {
			return intval($hour) . " Hour ago";
		}

		if ($day < 30) {
			return intval($day) . " Day ago";
		}

		return $startTime;
	}
}
