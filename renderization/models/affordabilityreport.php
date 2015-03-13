<?php
require_once('utils.php');

class AffordabilityReportModel {

	function AffordabilityReportModel() {
	}

	function get($api_url, $visualisationsPath) {
		global $wpdb;

		$data = Array();
		$chapters = Array();

		// Obtain the post id through its name
		$id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = 'affordability-report'");

		// Obtain the post through its id
		$post = get_post($id);

		// Filter the post content
		$post_content = apply_filters('the_content', $post->post_content);

		$data["hub"]["content"] = $post_content;
		$data["hub"]["countries"] = $this->formatApiData($api_url);

		return $data;
	}
	
	function formatApiData($api_url) {
		$observations = json_decode(file_get_contents($api_url.'/observations/INDEX/ALL/LATEST'), true);
		$observations = $observations["data"];
	
		$emerging = array();
		$developing = array();
		
		$path = get_stylesheet_directory_uri();
		$url = get_site_url();
	
		foreach ($observations as $observation) {
			$code = $observation["area"];
			$short_name = $observation["short_name"];
			$continent = $this->getContinent($observation["continent"]);
			$value = round($observation["value"]);
			$area_type = strtolower($observation["area_type"]);
			$ranking = $observation["ranking"];
			$colour = $this->getColour($value);
			$dark_colour = $this->getDarkColour($value);
			$width = $this->getWidth($value);
			$pos = $this->getPos($value);
			
			$data = array(
				"name" => $short_name,
				"code" => $code,
				"continent" => $continent,
				"value" => $value,
				"type" => $area_type,
				"ranking" => $ranking,
				"ranking_pos" => $ranking < 10,
				"colour" => $colour,
				"dark_colour" => $dark_colour,
				"width" => $width,
				"pos" => $pos,
				"flag" => "$path/images/rect-flags/$code.png",
				"url" => "$url/affordability-report/data/?indicator=INDEX&country=$code"
			);
			
			if ($area_type == "developing")
				array_push($developing, $data);
			else
				array_push($emerging, $data);
		}
	
		usort($emerging, array('AffordabilityReportModel', 'usortCmp'));
		usort($developing, array('AffordabilityReportModel', 'usortCmp'));
	
		return array(
			"emerging" => array_slice($emerging, 0, 5),
			"developing" => array_slice($developing, 0, 5)
		);
	}
	
	function getWidth($value) {
		$max = 155;
		
		return round($max * ($value / 100));
	}
	
	function getPos($value) {
		$max = 155;
		
		return -96 + round($max * ($value / 100));
	}
	
	function getColour($value) {
		if ($value < 25.0)
			return "#FF4000";
		else if ($value < 50.0)
			return "#FFE200";
		else if ($value < 60.0)
			return "#A5DF00";
		
		return "#00E000";
	}
	
	function getDarkColour($value) {
		if ($value < 25.0)
			return "#822100";
		else if ($value < 50.0)
			return "#7F7000";
		else if ($value < 60.0)
			return "#516F00";
		
		return "#006200";
	}
	
	function getContinent($code) {
		switch($code) {
			case "AFR":
				return "Africa";
			case "EAS":
				return "East Asia & Pacific";
			case "ECS":
				return "Europe & Central Asia";
			case "LCN":
				return "Latin America & Caribbean";
			case "MEA":
				return "Middle East";
			case "SAS":
				return "South Asia";
		}
		
		return $code;
	}
	
	private static function usortCmp($a, $b) {
		return $a["ranking"] > $b["ranking"];
	}
}
?>
