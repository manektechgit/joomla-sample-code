<?php if($data['article-showheader-banner']->rawvalue == 1) {
				if($data['article-hoogte']->rawvalue != "") {
					$style = 'style="height: '.$data['article-hoogte']->rawvalue.'vh;"';
				} else {
					$style = '';
				}
				?>
		<?php
			$db = JFactory::getDBO();
			$select_article_sql_header = $data['article-sql-header']->rawvalue;
			if(!empty($select_article_sql_header)) {
			$query = "SELECT * FROM #__tenzer_header as g LEFT JOIN #__tenzer_header_categories as c ON g.id = c.fk_gal_id 
								LEFT JOIN  #__tenzer_header_connect as co ON c.id = co.fk_cat_id 
								LEFT JOIN #__tenzer_header_img as img ON co.fk_gal_img_id = img.id
								where g.id = $select_article_sql_header AND img.publish=1 ORDER BY img.ordering ASC";
			$db->setQuery($query);
			$select_header_images = $db->loadObjectList();
		?>
		<?php if(count($select_header_images) > 0) { ?>
		<div class="header_banner">
		<?php } ?>
		<?php if(count($select_header_images) == 1) { 
					foreach ($select_header_images as $k => $v) {
						$select_header_imgLink = 'images/com_tenzer_header/gal-'.$select_article_sql_header.'/original/'.$v->file_name;
		?>
							<div class="single_image" <?php echo $style;?>>
								<?php if($select_header_imgLink != "") { ?>
									<img <?php echo $style;?> src="<?php echo JUri::root().htmlspecialchars($resizer->resize($select_header_imgLink, array('w' => 2000, 'h' => 857, 'crop' => FALSE, 'maxOnly' => TRUE)));?>" alt="header_banner_image" class="" />
									<div class="header-banner-text">
										<?php if(!empty($v->slogan1)) { ?>
										<span class="header-title1"><?php echo $v->slogan1; ?></span>
										<?php } ?>
										<?php if(!empty($v->slogan2)) { ?>
										<span class="header-title2"><?php echo $v->slogan2; ?></span>
										<?php } ?>
									</div>
								<?php } ?>
							</div>
							<div class="mobile-single-image">
								<?php if($select_header_imgLink != "") { ?>
									<img src="<?php echo JUri::root().htmlspecialchars($resizer->resize($select_header_imgLink, array('w' => 550, 'crop' => FALSE, 'maxOnly' => TRUE)));?>" alt="header_banner_image_mobile" class="" />
									<div class="header-banner-text">
										<?php if(!empty($v->slogan1)) { ?>
										<span class="header-title1"><?php echo $v->slogan1; ?></span>
										<?php } ?>
										<?php if(!empty($v->slogan2)) { ?>
										<span class="header-title2"><?php echo $v->slogan2; ?></span>
										<?php } ?>
									</div>
								<?php } ?>
						</div>
				<?php } ?>
		<?php } else if(count($select_header_images) > 1) {
							?>
								<div class="image_slider" <?php echo $style;?>>
									<div class="swiper-wrapper">
									<?php
											foreach ($select_header_images as $k => $v) {
												$select_header_imgLink = 'images/com_tenzer_header/gal-'.$select_article_sql_header.'/original/'.$v->file_name; 
												$count = 1;
												if($select_header_imgLink != "") {
													echo '<div class="swiper-slide"><img '.$style.' src='.JUri::root().htmlspecialchars($resizer->resize($select_header_imgLink, array('w' => 2000, 'h' => 857, 'crop' => FALSE, 'maxOnly' => TRUE))).' class="" alt="img_'.$count.'" itemprop="thumbnailUrl" />';
													echo '<div class="header-banner-text">';
														if(!empty($v->slogan1)) {
															echo '<span class="header-title1">'.$v->slogan1.'</span>';
														}
														if(!empty($v->slogan2)) {
															echo '<span class="header-title2">'.$v->slogan2.'</span>';
														}
													echo '</div>';
													
													echo '</div>';
												}
												$count++;
											}
										
						?>
									</div>
								</div>
								<div class="mobile-slider-image">
									<?php
										
											$count_mobile = 1;
											foreach($select_header_images as $k => $v) {
												$select_header_imgLink = 'images/com_tenzer_header/gal-'.$select_article_sql_header.'/original/'.$v->file_name;
												if($select_header_imgLink != "" && $count_mobile == 1) {
													echo '<img '.$style.' src='.JUri::root().htmlspecialchars($resizer->resize($select_header_imgLink, array('w' => 550, 'crop' => FALSE, 'maxOnly' => TRUE))).' class="" alt="mobile_slider_img_'.$count_mobile.'" itemprop="thumbnailUrl" />';
													echo '<div class="header-banner-text">';
														if(!empty($v->slogan1)) {
															echo '<span class="header-title1">'.$v->slogan1.'</span>';
														}
														if(!empty($v->slogan2)) {
															echo '<span class="header-title2">'.$v->slogan2.'</span>';
														}
													echo '</div>';
												}
												$count_mobile++;
											}
										
										?>
								</div>
		<?php } ?>
		<?php if(count($select_header_images) > 0) { ?>
		</div>
		<?php }
			}		?>
		<?php } else { ?>
            <jdoc:include type="modules" name="slider" />
		<?php } ?>