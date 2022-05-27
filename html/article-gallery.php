<!-- Gallery block -->
				<?php
						if($data['article-sql-gallery']->rawvalue != "" && $data['article-gallery-display']->rawvalue == 1) {
							
							$db = JFactory::getDBO();
							$select_gallery_id = $data['article-sql-gallery']->rawvalue;
							$select_gallery_count = 1;
							$new_select_gallery = '';
							
							$query = "SELECT * FROM #__tenzer_gallery as g LEFT JOIN #__tenzer_gallery_categories as c ON g.id = c.fk_gal_id 
								LEFT JOIN  #__tenzer_gallery_connect as co ON c.id = co.fk_cat_id 
								LEFT JOIN #__tenzer_gallery_img as img ON co.fk_gal_img_id = img.id
								where g.id = $select_gallery_id AND img.publish=1 ORDER BY img.ordering ASC";
							$db->setQuery($query);
							$select_gallery_images = $db->loadObjectList();
							
							$select_image_count = count($select_gallery_images) - 3;
							$select_image_count_digit = count($select_gallery_images) - 3;
							if($select_image_count > 0) {
								$select_image_count = '<div class="overlap_text"><span>';
									if($langtag == 'nl-NL') {
										$select_image_count .= $data['article-label-alle-fotos']->rawvalue;
									} else if($langtag == 'de-DE') {
										$select_image_count .= $data['article-label-alle-fotos-de']->rawvalue;
									} else {
										$select_image_count .= $data['article-label-alle-fotos-en']->rawvalue;
									}
								$select_image_count .= '</span>';
								
								$select_image_count .= '</div>';
								
							} else {
								$select_image_count = '';
							} ?>
							
							<?php
							
							$new_select_gallery .= '<section class="gallery-section">
								<div class="container-fluid">
									';
								$select_gallery_count_all = 1;
								foreach ($select_gallery_images as $k => $v) {
									$select_gallery_imgLink1 = 'images/com_tenzer_gallery/gal-'.$select_gallery_id.'/original/'.$v->file_name;
									$select_gallery_imgLink2 .= '<a class="fancybox" href="javascript:void(0);"><img class="lazy" data-src="'.JURI::root().htmlspecialchars($resizer->resize($select_gallery_imgLink1, array('w' => 390, 'h' => 240, 'crop' => TRUE, 'maxOnly' => TRUE))).'" alt="img-'.$select_gallery_count_all.'" /></a>';
									$select_gallery_count_all++;
								}
								foreach ($select_gallery_images as $k => $v) {
									$select_gallery_imgLink = 'images/com_tenzer_gallery/gal-'.$select_gallery_id.'/original/'.$v->file_name;
																		if($select_gallery_count == 1 ) {											$select_gallery_imgLink_url_3 = $select_gallery_imgLink;									}
									
									if($select_gallery_count == 1 ) {
									$new_select_gallery .=	'<div class="coloverwrite img_box gallery-block1"><div class="block-left">
											<a data-fancybox="article_gallery2" class="fancybox imglink" rel="ligthbox" href="'.$select_gallery_imgLink.'"><span><img class="lazy" data-src="'.JUri::root().htmlspecialchars($resizer->resize($select_gallery_imgLink, array('w' => 953, 'h' => 592, 'crop' => TRUE, 'maxOnly' => FALSE))).'" alt="Gallery image 1" /></span></a></div>';
									}
									if($select_gallery_count == 2 ) {
										$new_select_gallery .= '<div class="block-right"><a data-fancybox="article_gallery2" class="fancybox imglink" rel="ligthbox" href="'.$select_gallery_imgLink.'"><span><img class="lazy" data-src="'.JUri::root().htmlspecialchars($resizer->resize($select_gallery_imgLink, array('w' => 558, 'h' => 266, 'crop' => TRUE, 'maxOnly' => FALSE))).'" alt="Gallery image 2" /></span></a>';
									}
									if($select_gallery_count == 3 ) {
										$new_select_gallery .= '<a data-fancybox="article_gallery2" class="fancybox imglink" rel="ligthbox" href="'.$select_gallery_imgLink.'"><span><img class="lazy" data-src="'.JUri::root().htmlspecialchars($resizer->resize($select_gallery_imgLink, array('w' => 558, 'h' => 266, 'crop' => TRUE, 'maxOnly' => FALSE))).'" alt="Gallery image 3" />'.$select_image_count.'</span></a></div>
										<a class="imglink mobile-gallery"  href="javascript:void(0);"><span><img class="lazy" data-src="'.JUri::root().htmlspecialchars($resizer->resize($select_gallery_imgLink_url_3, array('w' => 953, 'h' => 592, 'crop' => TRUE, 'maxOnly' => FALSE))).'" alt="Gallery image mobile 3" />'.$select_image_count.'</span></a>
										<div class="img-mobile-gallery">'.$select_gallery_imgLink2.'<a href="javascript:void(0);" class="mobile-tab-close">Terug</a></div>
										</div>';
									}
									
								$select_gallery_count++;
								}
							
							$select_gallery_count2 = 1;
							$new_select_gallery .= '<div style="display: none;">';
							foreach($select_gallery_images as $k => $v) {
								$select_gallery_imgLink2 = 'images/com_tenzer_gallery/gal-'.$select_gallery_id.'/original/'.$v->file_name;
								if($select_gallery_count2 > 3 ) {  
									 $new_select_gallery .= '<a data-fancybox="article_gallery2" class="fancybox" rel="ligthbox" href="'.$select_gallery_imgLink2.'"></a>
									'; 
								} 
								$select_gallery_count2++;
							}
							$new_select_gallery .= '</div>';
							$new_select_gallery .= '</div></section>';
							
							echo $new_select_gallery;
							
						}
						?>
							
				<!-- Gallery block END -->