<?php
require_once('utils.php');

class PolicyResearchModel {

	function PolicyResearchModel() {
	}

	function get($api_url, $visualisationsPath) {
		global $wpdb;

		$data = Array();
		$chapters = Array();

		$this->getPage($wpdb, $data, "Policy-Introduction", "introduction");
		$this->getPage($wpdb, $data, "Policy-Case-Studies", "case");
		$this->getPage($wpdb, $data, "Policy-The-Knowledge-Bank", "bank");
		$this->getPage($wpdb, $data, "Policy-Affordability-Report", "report");
		$this->getPage($wpdb, $data, "Policy-Best-Practices", "practices");
		$this->getPage($wpdb, $data, "Thematic-Papers-and-Briefings", "papers");

		return $data;
	}
	
	function getPage($wpdb, &$data, $page, $name) {
		// Obtain the post id through its name
		$id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '$page'");

		// Obtain the post through its id
		$post = get_post($id);

		// Filter the post content
		$post_content = apply_filters('the_content', $post->post_content);

		$data["policy"][$name] = $post_content;
	}
}
?>
