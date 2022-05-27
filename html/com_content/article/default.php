<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

error_reporting(0);
defined('_JEXEC') or die;

require_once JPATH_SITE . '/plugins/content/imgresizecache/resize.php';

$resizer = new ImgResizeCache();

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
$lang = JFactory::getLanguage();
$langtag = $lang->getTag();

	JLoader::register('FieldsHelper', JPATH_ADMINISTRATOR . '/components/com_fields/helpers/fields.php');
	JModelLegacy::addIncludePath(JPATH_SITE.'/components/com_content/models', 'ContentModel');
	$id = JFactory::getApplication()->input->get('id');
	$model =& JModelLegacy::getInstance('Article', 'ContentModel', array('ignore_request'=>true));
	$appParams = JFactory::getApplication()->getParams();
	$model->setState('params', $appParams);
	$item =& $model->getItem($id);
	$jcFields = FieldsHelper::getFields('com_content.article',  $item, True);
	$data = array();
	foreach($jcFields as $jcField)
	{
		$data[$jcField->name] = $jcField;
	}
	//echo $data['introduction-description']->rawvalue;
	$article_block = $data['article-block']->rawvalue;
	
	$article_detail_plattegrond_items = $data['article-plattegrond-items']->rawvalue;
	$article_detail_kenmerken_title = $data['article-kenmerken-title']->rawvalue;
	$article_detail_plattegrond_items_count = count((array)json_decode($article_detail_plattegrond_items));
	
// Create shortcuts to some parameters.

$params  = $this->item->params;
$images  = json_decode($this->item->images);
$urls    = json_decode($this->item->urls);
$canEdit = $params->get('access-edit');
$user    = JFactory::getUser();
$info    = $params->get('info_block_position', 0);

JLoader::register('FieldsHelper', JPATH_ADMINISTRATOR . '/components/com_fields/helpers/fields.php');
$field = array(); // grabbing field
foreach ($this->item->jcfields as $f) {
    $field[$f->name] = $f; // using field alias name
}

?>

<div class="article<?php echo $this->pageclass_sfx ? ' ' . $this->pageclass_sfx : ''; ?>" itemscope itemtype="https://schema.org/Article">
    <meta itemprop="inLanguage" content="<?php echo ($this->item->language === '*') ? JFactory::getConfig()->get('language') : $this->item->language; ?>" />


    <?php $params->get('show_intro') ?: print $this->item->event->afterDisplayTitle; ?>
<!--     <?php echo $this->item->event->beforeDisplayContent; ?> -->

    <?php if (isset($urls) && ((!empty($urls->urls_position) && ($urls->urls_position == '0')) || ($params->get('urls_position') == '0' && empty($urls->urls_position)))
        || (empty($urls->urls_position) && (!$params->get('urls_position')))) : ?>
        <?php echo $this->loadTemplate('links'); ?>
    <?php endif; ?>
    <?php if ($params->get('access-view')):?>
        <?php if (isset($images->image_fulltext) && !empty($images->image_fulltext)) : ?>
            <?php $imgfloat = (empty($images->float_fulltext)) ? $params->get('float_fulltext') : $images->float_fulltext; ?>
            <div class="pull-<?php echo htmlspecialchars($imgfloat); ?> item-image"> <img
                    <?php if ($images->image_fulltext_caption):
                        echo 'class="caption"' . ' title="' . htmlspecialchars($images->image_fulltext_caption) . '"';
                    endif; ?>
                    src="<?php echo htmlspecialchars($images->image_fulltext); ?>" alt="<?php echo htmlspecialchars($images->image_fulltext_alt); ?>" itemprop="image"/> </div>
        <?php endif; ?>
        <?php
        if (!empty($this->item->pagination) && $this->item->pagination && !$this->item->paginationposition && !$this->item->paginationrelative):
            echo $this->item->pagination;
        endif;
        ?>

        <?php if (isset ($this->item->toc)) :
            echo $this->item->toc;
        endif; ?>
        <div class="content" itemprop="article-body" id="article-anchor">
            <?php
                $desc = JHtml::_('content.prepare', $this->item->text, '', 'com_content.category');
				$desc_mobile = JHtml::_('content.prepare', $this->item->text, '', 'com_content.category');
				$descend2 = '';
				$descend_mobile = '';
				if (strpos($desc, '{readmoremobile}') !==false) {
                    $descend_mobile = '1'; 
                }

                if (strpos($desc, '{readmore}') !==false) {
                    $descend2 = '1'; 
                }

				$desc = str_replace('{readmoremobile}', '<div class="desccollapse_mobile" id="desccollapse_mobile">', $desc);
                $desc = str_replace('{readmore}', '<div class="desccollapse" id="desccollapse">', $desc);
				$desc_mobile = str_replace('{readmoremobile}', '<div class="tmp" >', $desc_mobile);
				
                /*echo $desc;*/

                if ($descend2 == '1') {
                    if($langtag =='en-GB') {
                       $desc = str_replace('{readmoreend}', '</div><p class="desktop_readmore"><a href="javascript:void(0);" class="readmorelink collapselink collapsed"><span>Read more <span>></span></span></a><a href="javascript:void(0);" class="readlesslink collapselink"><span>Read less <span>></span></span></a></p>', $desc);
                    } elseif ($langtag == 'de-DE') {
                       $desc = str_replace('{readmoreend}', '</div><p class="desktop_readmore"><a href="javascript:void(0);" class="readmorelink collapselink collapsed"><span>Lesen Sie mehr <span>></span></span></a><a href="javascript:void(0);" class="readlesslink collapselink"><span>Weniger lesen <span>></span></span></a></p>', $desc);
                    } else {
                        $desc = str_replace('{readmoreend}', '</div><p class="desktop_readmore"><a href="javascript:void(0);" class="readmorelink collapselink collapsed"><span>Lees meer  <span>></span></span></a><a href="javascript:void(0);" class="readlesslink collapselink"><span>Lees minder <span>></span></span></a></p>', $desc);
                    }
                }
			
				if ($descend_mobile == '1') {
                    if($langtag =='en-GB') {
                       $desc = str_replace('{readmoremobileend}','</div><p class="mobile_readmore"><a href="javascript:void(0);" class="readmorelink_mobile collapselink_mobile collapsed">Read more <span>></span></a><a href="javascript:void(0);" class="readlesslink_mobile collapselink_mobile">Read less <span>></span></a></p>', $desc);
                    } elseif ($langtag == 'de-DE') {
                       $desc = str_replace('{readmoremobileend}', '</div><p class="mobile_readmore"><a href="javascript:void(0);" class="readmorelink_mobile collapselink_mobile collapsed">Lesen Sie mehr <span>></span></a><a href="javascript:void(0);" class="readlesslink_mobile collapselink_mobile">Weniger lesen <span>></span></a></p>', $desc);
                    } else {
                        $desc = str_replace('{readmoremobileend}', '</div><p class="mobile_readmore"><a href="javascript:void(0);" class="readmorelink_mobile collapselink_mobile collapsed">Lees meer <span>></span></a><a href="javascript:void(0);" class="readlesslink_mobile collapselink_mobile">Lees minder <span>></span></a></p>', $desc);
						
						$desc_mobile = str_replace('{readmoremobileend}', '</div>', $desc_mobile);
                    }
                }
				
				if($article_detail_plattegrond_items_count <= 0 && $article_detail_kenmerken_title == "") {
				    echo $desc;
				    if ($descend_mobile == '1') {
					    echo '<div class="mobile-readmore">'.str_replace(array('{readmoremobile}','{readmore}','{readmoreend}','{readmoremobileend}'),'',$desc_mobile).'<p><a href="javascript:void(0);" class="mobile-readmoreback mobile-tab-close">Terug</a></p></div>';
				    }
				}
            ?>
            <?php if($article_detail_plattegrond_items_count >= 1 || !empty($article_detail_kenmerken_title)) { ?>
            <ul class="nav-tabs tab-detail-li">
				<li class="nav-item "><a href="#tab1" data-toggle="tab" class="nav-link active">				<?php				    if($langtag == 'nl-NL') {						echo $data['article-informatie-title-nl']->rawvalue;					} else if($langtag == 'de-DE') {						echo $data['article-informatie-title-de']->rawvalue;					} else if($langtag == 'en-GB') {						echo $data['article-informatie-title-en']->rawvalue;					} ?>					</a></li>
				<?php if($article_detail_kenmerken_title != "") { ?>
				<li class="nav-item"><a href="#tab3" class="nav-link" data-toggle="tab">
					<?php
						if($langtag == 'nl-NL') {
							echo $article_detail_kenmerken_title;
						} else if($langtag == 'de-DE') {	
							echo 'Eigenschaften';					
						} else if($langtag == 'en-GB') {	
							echo 'Characteristics';					
						} ?></a></li>
				<?php } ?>
				<?php if($article_detail_plattegrond_items_count >= 1) { ?>
				<li class="nav-item"><a href="#tab2" class="nav-link" data-toggle="tab">				<?php				    if($langtag == 'nl-NL') {						echo 'Plattegrond';					} else if($langtag == 'de-DE') {						echo 'Karte';					} else if($langtag == 'en-GB') {						echo 'Map';					} ?></a></li>
				<?php } ?>
			</ul>
			<div class="tab-detail-content">
				<div id="tab1" class="tab-pane-detail active">
					<?php echo $desc; ?>
					<?php if ($descend_mobile == '1') {
						echo '<div class="mobile-readmore">'.str_replace(array('{readmoremobile}','{readmore}','{readmoreend}','{readmoremobileend}'),'',$desc_mobile).'<p><a href="javascript:void(0);" class="mobile-readmoreback mobile-tab-close">Terug</a></p></div>';
					} ?>
				</div>
				<?php if($article_detail_plattegrond_items_count >= 1) { ?>
				<div id="tab2" class="tab-pane-detail">
					<?php require_once JPATH_SITE . '/templates/standard4/html/article-plattegrond.php'; ?>
				</div>
				<?php } ?>
				<?php if($article_detail_kenmerken_title != "") { ?>
				<div id="tab3" class="tab-pane-detail">
					<?php require_once JPATH_SITE . '/templates/standard4/html/article-kenmerken.php'; ?>
				</div>
				<?php } ?>
			</div>
			<?php } ?>
        </div>

        <?php if ($info == 1 || $info == 2) : ?>
            <?php if ($useDefList) : ?>
                <?php echo JLayoutHelper::render('joomla.content.info_block.block', array('item' => $this->item, 'params' => $params, 'position' => 'below')); ?>
            <?php endif; ?>
            <?php if ($params->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
                <?php $this->item->tagLayout = new JLayoutFile('joomla.content.tags'); ?>
                <?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
            <?php endif; ?>
        <?php endif; ?>

        <?php
        if (!empty($this->item->pagination) && $this->item->pagination && $this->item->paginationposition && !$this->item->paginationrelative):
            //echo $this->item->pagination;
            ?>
        <?php endif; ?>
        <?php if (isset($urls) && ((!empty($urls->urls_position) && ($urls->urls_position == '1')) || ($params->get('urls_position') == '1'))) : ?>
            <?php echo $this->loadTemplate('links'); ?>
        <?php endif; ?>
        <?php // Optional teaser intro text for guests ?>
    <?php elseif ($params->get('show_noauth') == true && $user->get('guest')) : ?>
        <?php echo JLayoutHelper::render('joomla.content.intro_image', $this->item); ?>
        <?php echo JHtml::_('content.prepare', $this->item->introtext); ?>
        <?php // Optional link to let them register to see the whole article. ?>
        <?php if ($params->get('show_readmore') && $this->item->fulltext != null) : ?>
            <?php $menu = JFactory::getApplication()->getMenu(); ?>
            <?php $active = $menu->getActive(); ?>
            <?php $itemId = $active->id; ?>
            <?php $link = new JUri(JRoute::_('index.php?option=com_users&view=login&Itemid=' . $itemId, false)); ?>
            <?php $link->setVar('return', base64_encode(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language))); ?>
            <p class="readmore">
                <a href="<?php echo $link; ?>" class="register">
                    <?php $attribs = json_decode($this->item->attribs); ?>
                    <?php
                    if ($attribs->alternative_readmore == null) :
                        echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
                    elseif ($readmore = $this->item->alternative_readmore) :
                        echo $readmore;
                        if ($params->get('show_readmore_title', 0) != 0) :
                            echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
                        endif;
                    elseif ($params->get('show_readmore_title', 0) == 0) :
                        echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');
                    else :
                        echo JText::_('COM_CONTENT_READ_MORE');
                        echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
                    endif; ?>
                </a>
            </p>
        <?php endif; ?>
    <?php endif; ?>
    <?php if(!empty($boeken)) : ?>
        <div class="inpage-buttons">
            <a class="btn btn-reserve" href="<?php echo $boeken; ?>"><?php echo $boektekst; ?></a>
            <a class="btn btn-availability" href="<?php echo $boeken; ?>">Beschikbaarheid</a>
        </div>
    <?php endif;?>

    <?php if (!empty($this->item->pagination) && $this->item->pagination && $this->item->paginationposition && $this->item->paginationrelative):
        echo $this->item->pagination;
    endif; ?>
    <?php echo $this->item->event->afterDisplayContent; ?>
	
	<?php
	if(!empty(json_decode($article_block))) {
		echo '<div class="article-blocks">';
		foreach(json_decode($article_block) as $article_block_single) { ?>
			<div class="article-block">
				<div class="img-tag"><img class="lazy" data-src="<?php echo JURI::root().htmlspecialchars($resizer->resize($article_block_single->ArticleBlockImage, array('w' => 361, 'h' => 205, 'crop' => FALSE, 'maxOnly' => TRUE)));?>" alt="<?php echo $article_block_single->ArticleBlockTitle;?>" /></div>
				<h3><?php echo $article_block_single->ArticleBlockTitle;?></h3>
				<p><?php echo $article_block_single->ArticleBlockDescription;?></p>
			</div>
	<?php 
		}
		echo '</div>';
	}
	?>
</div>