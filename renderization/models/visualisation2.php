<?php
require_once('utils.php');

class Visualisation2Model {

	function Visualisation2Model() {
	}

	function get($api_url, $visualisationsPath) {
		global $wpdb;

		// Read from file
		$path = get_stylesheet_directory();
		$file = "$path/renderization/data/data/visualisation2.json";

		if (file_exists($file)) {
			$data = json_decode(file_get_contents($file), true);
			return $data;
		}

		$data = Array();

		$apiData = $this->formatApiData($api_url);

		$data["visualisation2"]["data"] = json_encode($apiData);

		// Store in file
		file_put_contents($file, json_encode($data));

		return $data;
	}

	function formatApiData($api_url) {
		// Areas
		$areas = json_decode(file_get_contents($api_url . '/areas/countries?info=false'), true);

		// Areas Info
		$areasInfo = json_decode(file_get_contents($api_url . '/areasInfo'), true);

		return array(
			"areas" => $areas,
			"areasInfo" => $areasInfo
		);
	}
}
?>
