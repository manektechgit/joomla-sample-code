<?php

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

JLoader::register('FieldsHelper', JPATH_ADMINISTRATOR . '/components/com_fields/helpers/fields.php');
$jcategories = JCategories::getInstance('Content');
$category   = $this->category;
$attribute = FieldsHelper::getFields('com_content.categories', $category, true);

$lang = JFactory::getLanguage();
$langtag = $lang->getTag();

require_once JPATH_SITE . '/plugins/content/imgresizecache/resize.php';
$resizer = new ImgResizeCache();


function isMobileDevice() { 
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo 
|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i" 
, $_SERVER["HTTP_USER_AGENT"]); 
}

if(isMobileDevice() == 0){
	$tmpclass = 'desktop';
} else if(isMobileDevice() == 1) {
	$tmpclass = 'mobile';
}
		
?>

<div class="overview<?php echo $this->pageclass_sfx; ?>" itemscope itemtype="https://schema.org/Blog">
	
		
		<div class="description" id="article-anchor">
		
				<?php 
                $desc = JHtml::_('content.prepare', $this->category->description, '', 'com_content.category');
				$descend2 = '';
                if (strpos($desc, '{readmore}') !== false) {
                    $descend2 = '1'; 
                }
                $desc = str_replace('{readmore}', '<div class="desccollapse test" id="desccollapse">', $desc);

                

                if ($descend2 == '1') {
                	echo $desc; 
						$noreadmore = '';
						if($langtag =='en-GB') {
						   echo '</div><p class="desktop_readmore"><a href="javascript:void(0);" class="readmorelink collapselink collapsed"><span>Read more <i class="fas fa-chevron-down"></i></span></a><a href="javascript:void(0);" class="readlesslink collapselink"><span>Read less <i class="fas fa-chevron-up"></i></span></a></p>';
						   
						} elseif ($langtag == 'de-DE') {
						   echo '</div><p class="desktop_readmore"><a href="javascript:void(0);" class="readmorelink collapselink collapsed"><span>Lesen Sie mehr <i class="fas fa-chevron-down"></i></span></a><a href="javascript:void(0);" class="readlesslink collapselink"><span>Weniger lesen <i class="fas fa-chevron-up"></i></span></a></p>';
						} else {
							echo '</div><p class="desktop_readmore"><a href="javascript:void(0);" class="readmorelink collapselink collapsed"><span>Lees meer <span>></span></span></a><a href="javascript:void(0);" class="readlesslink collapselink"><span>Lees minder <span>></span></span></a></p>';
						}
						
                    	/
                 
                }else
                {
                	
	    				$categorydesc = preg_split('/<hr[^>]*>/i', $this->category->description);
	    					if(empty($categorydesc[1]) || !isset($categorydesc[1]))
	    					{
								$noreadmore = 'noreadmore';
	    						echo JHtml::_('content.prepare', $categorydesc[0], '', 'com_content.category');
	    					}else
	    					{
								$noreadmore = '';
	    						echo JHtml::_('content.prepare', $categorydesc[0], '', 'com_content.category').'<div class="desccollapse test" id="desccollapse">'.JHtml::_('content.prepare', $categorydesc[1], '', 'com_content.category');
								echo '</div><p class="text-center"><a href="javascript:void(0);" class="readmorelink collapselink collapsed">Lees meer <span>></span></a><a href="javascript:void(0);" class="readlesslink collapselink">Lees minder <span>></span></a></p>';
	    					}
	                		
	                
	             }
               

            ?>
		
		</div>
	
<?php 
		$colparams = JFactory::getApplication()->getTemplate(true)->params;
        $colval = $colparams->get('column_type');
         if($colval == 0 ):
        	$colcls = 'col6';
        elseif ($colval == 1):
        	$colcls = 'col4';
      	else:
      		$colcls = 'col3';
      	endif;
		
		 ?>
	<?php if (empty($this->lead_items) && empty($this->link_items) && empty($this->intro_items) && $this->params->get('show_no_articles', 1)) : ?>
        <p><?php echo JText::_('COM_CONTENT_NO_ARTICLES'); ?></p>
	<?php endif; ?>

	<?php if (!empty($this->lead_items)): $counter = 0; ?>
		
			<?php foreach ($this->lead_items as &$item) : ?>
				<div class="overviewitem item content_block <?php echo 'col-blocks-3'; ?>">
				<div class="article<?php echo $item->state == 0 ? ' system-unpublished' : null; ?>" itemprop="blogPost" itemscope itemtype="https://schema.org/BlogPosting">
					<?php $this->item = &$item; echo $this->loadTemplate('item'); ?>
				</div>

				<?php $counter++; ?>
				</div>
			<?php endforeach; ?>
		
	<?php endif;  ?>
	<?php if (!empty($this->intro_items)): $counter = 1;
		$counter_mobile = 1;	?>
		<?php /*if(isMobileDevice() == 1){*/ ?>
			<div class="mobile-list">
				<?php 
					foreach ($this->intro_items as $key => &$item): 
						$images2 = json_decode($item->images);
						$link_moilbe = '';
						if(empty($link_moilbe)) {
							$link_moilbe = JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catid, $item->language));
						}
						?>
						<div class="overviewitem">
							<div class="image">
									<?php if(!empty($images2->image_intro)) { ?>
										<a href="<?php echo $link_moilbe; ?>"><img class="lazy" data-src="<?php echo JURI::root().htmlspecialchars($resizer->resize(explode('#',$images2->image_intro)[0], array('w' => 550, 'crop' => FALSE, 'maxOnly' => TRUE)));?>" alt="image_mobile_<?php echo $counter_mobile;?>" /><h3><?php echo $item->title;?></h3></a>
										<?php } ?>
							</div>
							<?php					
								/*$this->item = & $item;
								echo $this->loadTemplate('item');*/
							?>
					</div>
					<?php $counter_mobile++; ?>
			<?php endforeach; ?>
			</div>
		<?php /*}*/ ?>
		<?php /*if(isMobileDevice() == 0){*/ ?>
			<div class="desktop-list section-max-fluid">
			<?php foreach ($this->intro_items as $key => &$item): 
			/*$count = ((int) $key % (int) $this->columns) + 1; */
			$images2 = json_decode($item->images);
			$link_desktop = '';
			if(empty($link_desktop)) {
				$link_desktop = JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catid, $item->language));
			}
			?>
			<?php if($counter == 1) { ?>
			<div class="block1">
				<div class="block-left">
					<div class="overviewitem">
							<div class="image">
									<?php if(!empty($images2->image_intro)) { ?>
										<a href="<?php echo $link_desktop; ?>"><img class="lazy" data-src="<?php echo JURI::root().htmlspecialchars($resizer->resize(explode('#',$images2->image_intro)[0], array('w' => 953, 'h' => 592, 'crop' => FALSE, 'maxOnly' => TRUE)));?>" alt="image1" /><h3><?php echo $item->title;?></h3></a>
										<?php } ?>
							</div>
					</div>
				</div>
			<?php } ?>
			<?php if($counter == 2) { ?>
				<div class="block-right">
					<div class="overviewitem">
								<div class="image">
									<?php if(!empty($images2->image_intro)) { ?>
										<a href="<?php echo $link_desktop; ?>"><img class="lazy" data-src="<?php echo JURI::root().htmlspecialchars($resizer->resize(explode('#',$images2->image_intro)[0], array('w' => 558, 'h' => 265, 'crop' => FALSE, 'maxOnly' => TRUE)));?>" alt="image1" /><h3><?php echo $item->title;?></h3></a>
										<?php } ?>
								</div>
					</div>
			<?php } ?>
			<?php if($counter == 3) { ?>
					<div class="overviewitem">
								<div class="image">
									<?php if(!empty($images2->image_intro)) { ?>
										<a href="<?php echo $link_desktop; ?>"><img class="lazy" data-src="<?php echo JURI::root().htmlspecialchars($resizer->resize(explode('#',$images2->image_intro)[0], array('w' => 558, 'h' => 265, 'crop' => FALSE, 'maxOnly' => TRUE)));?>" alt="image1" /><h3><?php echo $item->title;?></h3></a>
										<?php } ?>
								</div>
					</div>
				</div>
			</div>
			<?php } ?>
			<?php if($counter == 4) { ?>
			<div class="block2">
					<div class="overviewitem">
								<div class="image">
									<?php if(!empty($images2->image_intro)) { ?>
										<a href="<?php echo $link_desktop; ?>"><img class="lazy" data-src="<?php echo JURI::root().htmlspecialchars($resizer->resize(explode('#',$images2->image_intro)[0], array('w' => 494, 'h' => 307, 'crop' => FALSE, 'maxOnly' => TRUE)));?>" alt="image1" /><h3><?php echo $item->title;?></h3></a>
										<?php } ?>
								</div>
					</div>
			<?php } ?>
			<?php if($counter == 5) { ?>
					<div class="overviewitem">
								<div class="image">
									<?php if(!empty($images2->image_intro)) { ?>
										<a href="<?php echo $link_desktop; ?>"><img class="lazy" data-src="<?php echo JURI::root().htmlspecialchars($resizer->resize(explode('#',$images2->image_intro)[0], array('w' => 494, 'h' => 307, 'crop' => FALSE, 'maxOnly' => TRUE)));?>" alt="image1" /><h3><?php echo $item->title;?></h3></a>
										<?php } ?>
								</div>
					</div>
			<?php } ?>
			<?php if($counter == 6) { ?>
					<div class="overviewitem">
								<div class="image">
									<?php if(!empty($images2->image_intro)) { ?>
										<a href="<?php echo $link_desktop; ?>"><img class="lazy" data-src="<?php echo JURI::root().htmlspecialchars($resizer->resize(explode('#',$images2->image_intro)[0], array('w' => 494, 'h' => 307, 'crop' => FALSE, 'maxOnly' => TRUE)));?>" alt="image1" /><h3><?php echo $item->title;?></h3></a>
										<?php } ?>
								</div>
					</div>
			</div>
			<?php } ?>
			<?php if($counter == 7) { ?>
			<div class="block3">
					<div class="overviewitem">
								<div class="image">
									<?php if(!empty($images2->image_intro)) { ?>
										<a href="<?php echo $link_desktop; ?>"><img class="lazy" data-src="<?php echo JURI::root().htmlspecialchars($resizer->resize(explode('#',$images2->image_intro)[0], array('w' => 755, 'h' => 307, 'crop' => FALSE, 'maxOnly' => TRUE)));?>" alt="image1" /><h3><?php echo $item->title;?></h3></a>
										<?php } ?>
								</div>
					</div>
			<?php } ?>
			<?php if($counter == 8) { ?>
					<div class="overviewitem">
								<div class="image">
									<?php if(!empty($images2->image_intro)) { ?>
										<a href="<?php echo $link_desktop; ?>"><img class="lazy" data-src="<?php echo JURI::root().htmlspecialchars($resizer->resize(explode('#',$images2->image_intro)[0], array('w' => 755, 'h' => 307, 'crop' => FALSE, 'maxOnly' => TRUE)));?>" alt="image1" /><h3><?php echo $item->title;?></h3></a>
										<?php } ?>
								</div>
					</div>
			</div>
			<?php } ?>
				

					<?php $counter++; ?>
				
			<?php endforeach; ?>
			</div>
		<?php /*}*/ ?>
		
	<?php endif; ?>

	<?php if (!empty($this->link_items)): ?>
		<div class="items-more">
			<?php /*echo $this->loadTemplate('links');*/ ?>
		</div>
	<?php endif; ?>

	<?php if (!empty($this->children[$this->category->id]) && $this->maxLevel != 0): ?>
		<div class="cat-children">
			<?php if ($this->params->get('show_category_heading_title_text', 1) == 1): ?>
				<h3>
                    <?php echo JText::_('JGLOBAL_SUBCATEGORIES'); ?>
                </h3>
			<?php endif; ?>

			<?php echo $this->loadTemplate('children'); ?>
        </div>
	<?php endif; ?>

	<?php if (($this->params->def('show_pagination', 1) == 1 || ($this->params->get('show_pagination') == 2)) && ($this->pagination->pagesTotal > 1)) : ?>
		<div class="com-content-category-blog__navigation w-100">
			<?php if ($this->params->def('show_pagination_results', 1)) : ?>
				<p class="com-content-category-blog__counter counter float-end pt-3 pe-2">
					<?php echo $this->pagination->getPagesCounter(); ?>
				</p>
			<?php endif; ?>
			<div class="com-content-category-blog__pagination">
				<?php echo $this->pagination->getPagesLinks(); ?>
			</div>
		</div>
	<?php endif; ?>
</div>