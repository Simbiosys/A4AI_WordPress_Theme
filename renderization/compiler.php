<?php
	require_once(__DIR__.'/../inc/lightncandy/lightncandy.php');

	class Compiler {

		// singleton
		private static $instance;

		private $settings;

		private $templatesPath;
		private $compiledTemplatesPath;

		private function __construct($settings) {
			$this->settings = $settings;

			$this->templatesPath = __DIR__ . '/..' . $this->settings['templatesPath'];
			$this->compiledTemplatesPath = __DIR__ . '/..' . $this->settings['compiledTemplatesPath'];
		}

		public static function getInstance($settings) {
			if (!self::$instance) {
				self::$instance = new static($settings);
			}

			return self::$instance;
		}

		public function compileTemplates() {
			$pages = scandir($this->templatesPath);
			self::compileTemplate('header', true);
			self::compileTemplate('footer', true);
			self::compileTemplate('by', true);

			foreach ($pages as $page) {
				self::compileTemplate($page, false);
			}
		}

		public function compileTemplate($templateName, $partial) {
			if ($partial) {
				$templatePath = $this->templatesPath."partials/".$templateName.'.hbs';
			} else {
				$templatePath = $this->templatesPath.$templateName;
			}

			if (file_exists($templatePath)) {
				$template = file_get_contents($templatePath);

				$compiledTemplate = LightnCandy::compile($template, Array(
   					'flags' => LightnCandy::FLAG_STANDALONE | LightnCandy::FLAG_THIS | LightnCandy::FLAG_SPVARS,
    				'basedir' => Array(
        			$this->templatesPath,
							$this->templatesPath.'partials/',
    				),
    				'fileext' => Array(
        			'.tmpl',
        			'.mustache',
        			'.hbs',
    				),
						'helpers' => array(
							'chapter_title' => function($args) {
									$title = $args[0]["post_title"];
									$level = $args[0]["index_level"];
									$tag = $args[0]["tag"];
									$chapter = $args[0]["chapter"];
									$index = $args[0]["index"];
									$type = $args[0]["meta-box-block-type"];
									$chart_index = $args[0]["chart_index"];
									$headings = $args[1];

									$the_class = '';

									if ($type == 'highlighted') {
										$the_class = 'box-title';
									}
									else if ($type == 'chart') {
										$the_class = 'table-caption';
									}

									if (empty($title)) {
										return "";
									}

									$icon = $type == 'chart' ? '<i class="fa fa-bar-chart icon-list-figures"></i>' : '';
									$chart_index = $type == 'chart' ? "Figure $chart_index." : '';

									$title_header = "";

									switch ($level) {
										case 1:
											$title_header = "";
											break;
										case 2:
											$subchapter = !empty($index) ? "<span class='subchapter'>$index</span>" : "";
											$title_header = "<h2 id='$tag' class='$the_class'>$subchapter$title</h2>";
											break;
										case 3:
											$title_header = "<h3 id='$tag' class='$the_class'><span class='subsubchapter'>$index</span>$title</h3>";
											break;
										case 4:
											$title_header = "<h4 id='$tag' class='$the_class'>$title</h4>";
											break;
										case 5:
											$title_header = "<h5 id='$tag' class='$the_class'>$title</h5>";
											break;
										default:
											$title_header = "<h6 id='$tag' class='$the_class'>$icon $chart_index $title</h6>";
											break;
									}

									$nav = "";

									if ($level > 1 && !empty($index)) {
										$lis = array();

										foreach ($headings as $heading) {
											$heading_index = $heading["index"];

											$startsWith = $index === "" || strrpos($heading_index, $index, -strlen($heading_index)) !== FALSE;

											if ($startsWith && strlen($heading_index) > strlen($index)) {
												$li_tag = $heading["tag"];
												$li_title = $heading["post_title"];
												$li_index = $heading["index"];

												array_push($lis, "<li><a href='#$li_tag'>$li_index $li_title</a></li>");
											}
										}

										$lis = implode("", $lis);
										$nav = "<nav><ul class='tags'>$lis</ul></nav>";
									}

									return "$title_header$nav";
							},
							'table_caption' => function($args) {
								$table = $args[0];
								$caption = $args[1];
								$tag = $args[2];
								$table_index = $args[3];

								$title = "<i class='fa fa-table icon-list-figures'></i> Table $table_index. $caption";

								if (empty($table)) {
									return "<h6 id='$tag' class='table-caption'>$title</h6>";
								}

								return str_replace("{{caption}}", $title, "<div id='$tag'>$table</div>");
							},
							'select_selected' => function($args) {
								return $args[0] == $args[1] ? "selected" : "";
							}
						)
				));

				$name = explode('.', $templateName);
				$name = $this->compiledTemplatesPath . $name[0];

				file_put_contents($name, $compiledTemplate);
			} else {
				error_log(date("Y-m-d H:i:s").': File: '.$templatePath.' does not exists');
			}
		}

	}
?>
