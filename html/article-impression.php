<?php	if($data['article-show-impression-slider']->rawvalue == 1) {
			$db = JFactory::getDBO();
			$select_article_sql_belevings = $data['article-sql-belevings']->rawvalue;
			if(!empty($select_article_sql_belevings)) {
			$query = "SELECT * FROM #__tenzer_impression as g LEFT JOIN #__tenzer_impression_categories as c ON g.id = c.fk_gal_id 
								LEFT JOIN  #__tenzer_impression_connect as co ON c.id = co.fk_cat_id 
								LEFT JOIN #__tenzer_impression_img as img ON co.fk_gal_img_id = img.id
								where g.id = $select_article_sql_belevings AND img.publish=1 ORDER BY img.ordering ASC";
			$db->setQuery($query);
			$select_experience_images = $db->loadObjectList();
			
		?>
		<?php 
			if(count($select_experience_images) > 0) { 
			$cnt = 1;
				if($langtag == 'nl-NL') {
					$article_label_button = $data['article-label-button-nl']->rawvalue;
				} else if($langtag == 'de-DE') {
					$article_label_button = $data['article-label-button-de']->rawvalue;
				} else {
					$article_label_button = $data['article-label-button-en']->rawvalue;
				}
				
				$article_impression_block_hoogte = $data['article-impression-block-hoogte']->rawvalue;
						if($article_impression_block_hoogte != "") {
							$impression_block_style = 'style="height: '.$article_impression_block_hoogte.'vh;"';
						} else {
							$impression_block_style = '';
						}
			?>
			<section class="impression-block">
			<?php if(count($select_experience_images) == 1) { ?>
				<?php foreach ($select_experience_images as $k => $v) {
						$select_experience_imgLink = 'images/com_tenzer_impression/sdr-'.$select_article_sql_belevings.'/original/'.$v->file_name;
						
						echo '<div class="single-slide" '.$impression_block_style.'>';
								if(!empty($select_experience_imgLink)) {
									echo '<img class="lazy impression-desktop-img" alt="impression-img-'.$cnt.'" data-src="'.JUri::root().htmlspecialchars($resizer->resize($select_experience_imgLink, array('w' =>2000, 'h' => 749, 'crop' => TRUE, 'maxOnly' => TRUE))).'" />';
									echo '<img class="lazy impression-mobile-img" alt="impression-mobile-img-'.$cnt.'" data-src="'.JUri::root().htmlspecialchars($resizer->resize($select_experience_imgLink, array('w' =>550, 'crop' => TRUE, 'maxOnly' => TRUE))).'" />';
								}
								echo '<div class="slider-content">';
											if(!empty($v->img_title)) {
											echo "<h2>".$v->img_title."</h2>";
											}
											echo $v->img_description;
											if(!empty($v->videolink)) {
											echo "<div><a class='btn' href='".$v->videolink."'>".$article_label_button."</a></div>";
											}
									if(!empty($v->videolink)) {
									echo '<a class="icon" href='.$v->videolink.'><i class="fas fa-chevron-circle-right"></i></a>';
									}
									echo '</div>';
									echo '</div>';
						
					 } ?>
			<?php } else if(count($select_experience_images) > 1) {
				echo '<div class="swiper-wrapper">';
							foreach ($select_experience_images as $k => $v) {
								$select_experience_imgLink = 'images/com_tenzer_impression/sdr-'.$select_article_sql_belevings.'/original/'.$v->file_name;
								
								echo '<div class="swiper-slide"><div class="single-slide" '.$impression_block_style.'>';
								if(!empty($select_experience_imgLink)) {
								echo '<img class="lazy impression-desktop-img" alt="impression-img-'.$cnt.'" data-src="'.JUri::root().htmlspecialchars($resizer->resize($select_experience_imgLink, array('w' =>2000, 'h' => 749, 'crop' => TRUE, 'maxOnly' => TRUE))).'" />';
								echo '<img class="lazy impression-mobile-img" alt="impression-mobile-img-'.$cnt.'" data-src="'.JUri::root().htmlspecialchars($resizer->resize($select_experience_imgLink, array('w' =>550, 'crop' => TRUE, 'maxOnly' => TRUE))).'" />';
								}
								echo '<div class="slider-content">';
											if(!empty($v->img_title)) {
											echo "<h2>".$v->img_title."</h2>";
											}
											echo $v->img_description;
											if(!empty($v->videolink)) {
											echo "<div><a class='btn' href='".$v->videolink."'>".$article_label_button."</a></div>";
											}
											if(!empty($v->videolink)) {
								echo '<a class="icon" href='.$v->videolink.'><i class="fas fa-chevron-circle-right"></i></a>';
											}
								echo '</div>';
									echo '</div>
									</div>';
								$cnt++;
							}
							 echo '</div>';
							
			 } ?>
					
			</section>
			<?php }
			} ?>
<?php } ?>