<?php

function getPostsByCategory($categorySlug) {
	global $post;

	$posts = Array();
	$categoryId = get_category_by_slug($categorySlug)->term_id;

	$args = array('posts_per_page' => 5, 'category' => $categoryId);

	$myposts = get_posts( $args );

	foreach ( $myposts as $post ){
		setup_postdata( $post );

		$news = Array();
		$news['title'] = get_the_title();
		$news['time'] = get_the_date();
		$news['link'] = get_permalink();
		$news['content'] = get_the_content("Read more...");

		array_push($posts, $news);
	}
	wp_reset_postdata();

	while (count($posts) < 3) {
		$post = Array();
		$post['title'] = "No more news";
		$post['content'] = "";

		array_push($posts, $post);
	}

	return $posts;
}

//////////////////////////////////////////////////////////////////////
//////////////////	Static pages 	//////////////////////////////
//////////////////////////////////////////////////////////////////////

function sliceHtmlIntoChapters($html, $tables) {
	$chapters = Array();
	$positions_h1 = Array();
	$positions_h2 = null;

	$article_class = 'text-article';
	$article_id = 'chapter_';

	$lastPos = 0;

	while (($lastPos = strpos($html, "<h1>", $lastPos)) !== false) {
		$positions_h1[] = $lastPos;
		$lastPos = $lastPos + strlen("<h1>");
	}

	$tableCount = 1;
	$figures = array();

	$table_of_contents_h1 = "";

	for ($i = 0; $i < count($positions_h1); $i++) {
		$number = $i;
		$number_tag = $number == 0 ? "i" : $number;

		if ($i == (count($positions_h1) - 1)) {
			$article = substr($html, $positions_h1[$i]);
		}
		else {
			$article = substr($html, $positions_h1[$i], $positions_h1[$i + 1] - $positions_h1[$i]);
		}

		// H2 positions
		$positions_h2 = Array();
		$lastPos = 0;

		// First content
		$positions_h2[] = 0;

		while (($lastPos = strpos($article, "<h2>", $lastPos)) !== false) {
			$positions_h2[] = $lastPos;
			$lastPos = $lastPos + strlen("<h2>");
		}

		$subchapters = Array();
		$table_of_contents_h2 = "";
		$subchapter_count = 1;
		$tags = "";

		for ($j = 0; $j < count($positions_h2); $j++) {
			$subnumber = $j + 1;

			if ($j == (count($positions_h2) - 1)) {
				$subarticle = substr($article, $positions_h2[$j]);
			}
			else {
				$subarticle = substr($article, $positions_h2[$j], $positions_h2[$j + 1] - $positions_h2[$j]);
			}

			$processed_subarticle = \simple_html_dom\str_get_html($subarticle);

			if (!empty($processed_subarticle)) {
				// h1 is extracted from $article
				// Remove it to avoid duplicates

				foreach($processed_subarticle->find('h1') as $h1) {
					$h1->outertext = "";
				}

				$h2 = null;
				$h2_text = "";
				$h2_id = "";

				$h2 = $processed_subarticle->find('h2', 0);

				$subchapter_count_old = $subchapter_count;

				if (!empty($h2)) {
					$h2_text = getSingleNodeText($h2);
					$h2_id = getNodeText($h2);
					$tags .= "<li><a href='#$h2_id'>$h2_text</a></li>";
					$content = $h2->innertext;
					$h2->innertext = "<span class='subchapter'>$number_tag.$subchapter_count</span> $content";
					$h2->setAttribute('id', $h2_id);

					$subchapter_count++;
				}

				$count = 1;

				// Insert tables

				foreach($processed_subarticle->find('div.data-table') as $table) {
					$id = $table->id;

					$tableContent = "";

					if (array_key_exists($id, $tables)) {
						$tableContent = $tables[$id];

						if (strpos($id, "-graphic") === false) {
							$tableContent = str_replace("{{table}}", "Table $tableCount.", $tableContent);
							$tableCount++;

							$tableObj = \simple_html_dom\str_get_html($tableContent);
							$caption = $tableObj->find('caption', 0)->plaintext;

							array_push($figures, array(
								"id" => $id,
								"caption" => $caption
							));
						}
					}

					$table->outertext = $tableContent;
				}

				$count = 1;
				$subtags = "";

				foreach($processed_subarticle->find('h3') as $h3) {
					$content = getSingleNodeText($h3);
					$id = getNodeText($h3);
					$subtags .= "<li><a href='#$id'>$content</a></li>";
					$content = $h3->innertext;
					$h3->innertext = "<span class='subsubchapter'>$number_tag.$subchapter_count_old.$count</span> $content";
					$h3->setAttribute('id', $id);

					$count++;
				}
			}

			// subtags
			$nav = "<nav><ul class='tags'>$subtags</ul></nav>";
			$h2->outertext = $h2->outertext . $nav;

			$sub_table_of_contents = "";

			if (!empty($subtags)) {
				$sub_table_of_contents = "<ol>$subtags</ol>";
			}

			if (!empty($h2_text))
				$table_of_contents_h2 .= "<li class='level2'><a href='#$h2_id'>$h2_text</a>$sub_table_of_contents</li>";

			array_push($subchapters, $processed_subarticle->outertext);
		}

		$processed_article = \simple_html_dom\str_get_html($article);

		$nav = "<nav><ul class='tags'>$tags</ul></nav>";

		$title = $processed_article->find('h1', 0);

		if ($title) {
			$title->outertext = $title->outertext . $nav;
			$article_id = getNodeText($title);
		}

		$h1 = $title->outertext;
		$h1_text = $title->innertext;

		$content = $h1 . implode($subchapters);

		$chapters["chapter_".($i+1)] = "<article class='".$article_class."' id='".$article_id."'><p class='chapter'>$number_tag</p>$content<hr /></article>";

		$sub_table = "";
		
		if (!empty($table_of_contents_h2))
			$sub_table = "<ol>$table_of_contents_h2</ol>";
			
		$down = "";
		
		if (!empty($table_of_contents_h2))
			$down = "<i class='fa fa-angle-down fa-2x'></i>";
			
		$table_of_contents_h1 .= "<li class='level1'><a href='#$article_id'>$number_tag. $h1_text</a>$down $sub_table</li>";
	}

	return array(
		"chapters" => $chapters,
		"figures" => $figures,
		"table" => $table_of_contents_h1
	);
}

function generateSideBar($chapters) {
	$slices = Array();
	$subsections = Array();
	$sidebar = "";
	$subsection = "";

	$count = 0;

	foreach ($chapters as $article) {
		$article_element = $article->find('article', 0);
		$chapter_title = $article->find('h1', 0);
		$innertext = getSingleNodeText($chapter_title);
		$id = $article_element->getAttribute('id');
		
		$count_tag = $count == 0 ? "i" : $count;
		
		$sidebar .= "<li><a href='#$id'><span class='number'>$count_tag</span> <span class='text'>$innertext</span></a><ul>";
		$subsection = "";

		foreach($article->find('h2') as $h2) {
			$innertext = getSingleNodeText($h2);
			$subsection .= "<li><a href='#".$h2->getAttribute('id')."'>".$innertext."</a></li>";
		}

		$subsections[$article_element->getAttribute('id')] = "<ul>".$subsection."</ul>";
		$sidebar .= $subsection."</ul></li>";

		$count++;
	}

	$slices["sidebar"] = $sidebar;
	$slices["subsections"] = $subsections;

	return $slices;
}

function getSingleNodeText($node) {
	$texts = $node->find('text');
	$texts = implode(" ", $texts);
	return preg_replace("/\s+/", ' ', $texts);
}

function getNodeText($node) {
	return formatTitleToAnchor(getSingleNodeText($node));
}

function formatTitleToAnchor($title) {
	$anchor = strtolower(str_replace(' ', '_', $title));
	$anchor = str_replace(':', '', $anchor);

	return $anchor;
}

///////////////////////////////////////////////////////////////////////
/////////////////	Compound pages		///////////////////////
///////////////////////////////////////////////////////////////////////

function getChildPages($post_slug) {
	global $wpdb;

	$my_wp_query = new WP_Query();

	$page = get_page_by_path($post_slug);
	$id = $page->ID;
	$args = array(
        'child_of' => $page->ID,
        'parent' => $page->ID,
        'hierarchical' => 0
	);

	return get_pages($args);
}

function getPostContent($post_slug) {
	global $wpdb;

	// Obtain the post through its slug
	$post = get_page_by_path($post_slug);

	// Filter the post content
	$content = apply_filters('the_content', $post->post_content);

	return $content;
}

function generateCompoundSidebar(&$sections) {
	$sidebar = "<ul>";

	$chapter_counter = 0;
	foreach( $sections as &$section) {
		$chapter_counter++;
		$html = \simple_html_dom\str_get_html($section);

		$chapter_title = $html->find('h1', 0);
		$chapter_title->setAttribute('id', 'chapter_'.$chapter_counter);

		$sidebar .= "<li><a href='#".$chapter_title->getAttribute('id')."'>".$chapter_title->innertext."</a><ul>";

		$section_counter = 0;
		foreach($html->find('h2') as $h2) {
			$section_counter++;
			$h2->setAttribute('id', 'chapter_'.$chapter_counter.'_section_'.$section_counter);
			$sidebar .= "<li><a href='#".$h2->getAttribute('id')."'>".$h2->innertext()."</a></li>";
		}

		$section = $html;
		$sidebar .= "</ul></li>";
	}
	$sidebar .= "</ul>";

	return $sidebar;
}
?>
