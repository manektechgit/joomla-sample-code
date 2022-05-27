<?php $article_plattegrond_items = $data['article-plattegrond-items']->rawvalue;
		$article_plattegrond_items_count = count((array)json_decode($article_plattegrond_items));
		if(!empty(json_decode($article_plattegrond_items))) {
				if($article_plattegrond_items_count == 1) {
					$col_class = 'col-one';
				} else if($article_plattegrond_items_count > 1) {
					$col_class = 'col-two';
				}
		?>
		<section class="plattegrond-block <?php echo $col_class;?>">
			<div class="container">
					<?php if(!empty($data['article-plattegrond-title']->rawvalue)) { ?>
					<h2><?php echo $data['article-plattegrond-title']->rawvalue;?></h2>
					<?php } ?>
					<?php
						if($langtag == 'nl-NL') {
							$plattegrond_link_title = $data['article-plattegrond-link-title-nl']->rawvalue;
						} else if($langtag == 'de-DE') {
							$plattegrond_link_title = $data['article-plattegrond-link-title-de']->rawvalue;
						} else {
							$plattegrond_link_title = $data['article-plattegrond-link-title-en']->rawvalue;
						}
						
						
							echo '<div class="plattegrond-flex">';
							foreach (json_decode($article_plattegrond_items) as $article_plattegrond_item) {
								$plattegrond_link = $article_plattegrond_item->field34;
							if($plattegrond_link != "") {									$plattegrond_link = $plattegrond_link;									$plattegrond_link_target = '_blank';								} else {									$plattegrond_link = 'javascript:void(0);';									$plattegrond_link_target = '';								}
							    $article_plattegrond_item_imagearray = $article_plattegrond_item->field53;
							    $article_plattegrond_item_image = explode('#',$article_plattegrond_item_imagearray);
							    
								echo '<div class="plattegrond-wrap">';
								if(!empty($article_plattegrond_item->field22)) {
								echo '<h2>'.$article_plattegrond_item->field22.'</h2>';
								}
								echo '<div class="image"><img class="lazy" data-src="'.JUri::root().htmlspecialchars($resizer->resize($article_plattegrond_item_image[0], array('w' => 800, 'h' => 550, 'crop' => TRUE, 'maxOnly' => FALSE))).'" alt="plattegrond image" /></div>';
								echo '<a target="'.$plattegrond_link_target.'" class="btn" href="'.$plattegrond_link.'">'.$plattegrond_link_title.'</a></div>';
							}
							echo '</div>';
								
					?>
			</div>
		</section>
		<?php } ?>