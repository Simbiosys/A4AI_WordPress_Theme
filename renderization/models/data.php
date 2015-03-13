<?php
require_once('utils.php');

class DataModel {

	function DataModel() {
	}

	function get($api_url, $visualisationsPath) {
		global $wpdb;

		// Read from file
		$path = get_stylesheet_directory();
		$file = "$path/renderization/data/data/initial.json";

		if (file_exists($file)) {
			$data = json_decode(file_get_contents($file), true);
			return $data;
		}

		$data = Array();

		$apiData = $this->formatApiData($api_url);

		$data["data_initial"]["data"] = json_encode($apiData);

		// Store in file
		file_put_contents($file, json_encode($data));

		return $data;
	}

	function formatApiData($api_url) {
		// Areas
		$areas = json_decode(file_get_contents($api_url . '/areas/countries?info=false'), true);

		// Areas Info
		$areasInfo = json_decode(file_get_contents($api_url . '/areasInfo'), true);

		// Index indicator
		$index = json_decode(file_get_contents($api_url . '/indicators/INDEX'), true);

		// Index and subindices observations
		$obs_index = json_decode(file_get_contents($api_url . '/visualisations/INDEX/ALL/LATEST'), true);
		$obs_access = json_decode(file_get_contents($api_url . '/visualisations/ACCESS/ALL/LATEST'), true);
		$obs_infrastructure = json_decode(file_get_contents($api_url . '/visualisations/INFRASTRUCTURE/ALL/LATEST'), true);

		return array(
			"areas" => $areas,
			"areasInfo" => $areasInfo,
			"index" => $index,
			"obs_index" => $obs_index,
			"obs_access" => $obs_access,
			"obs_infrastructure" => $obs_infrastructure
		);
	}
}
?>
