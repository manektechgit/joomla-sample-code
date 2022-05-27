<?php
defined('_JEXEC') or die;
$params = $this->item->params;
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
require_once JPATH_SITE . '/plugins/content/imgresizecache/resize.php';
$resizer = new ImgResizeCache();
$lang = JFactory::getLanguage();
$langtag = $lang->getTag();
$canEdit = $this->item->params->get('access-edit');
$info    = $params->get('info_block_position', 0);
?>
<?php
JLoader::register('FieldsHelper', JPATH_ADMINISTRATOR . '/components/com_fields/helpers/fields.php');
$field = array(); // grabbing field
foreach ($this->item->jcfields as $f) {
    $field[$f->name] = $f; // using field alias name
}
?>
<?php if ($this->item->state == 0 || strtotime($this->item->publish_up) > strtotime(JFactory::getDate())
	|| ((strtotime($this->item->publish_down) < strtotime(JFactory::getDate())) && $this->item->publish_down != JFactory::getDbo()->getNullDate())) : ?>
	<?php /* ?><div class="system-unpublished"><?php */ ?>
<?php endif; ?>
<?php //echo JLayoutHelper::render('joomla.content.blog_style_default_item_title', $this->item); ?>
<?php if ($canEdit || $params->get('show_print_icon') || $params->get('show_email_icon')) : ?>
	<?php //echo JLayoutHelper::render('joomla.content.icons', array('params' => $params, 'item' => $this->item, 'print' => false)); ?>
<?php endif; ?>
<?php if ($params->get('show_tags') && !empty($this->item->tags->itemTags)) : ?>
	<?php echo JLayoutHelper::render('joomla.content.tags', $this->item->tags->itemTags); ?>
<?php endif; ?>
<?php // Todo Not that elegant would be nice to group the params ?>
<?php $useDefList = ($params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date')
	|| $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category') || $params->get('show_author') ); ?>

<?php
$images = json_decode($this->item->images);
?>
<?php 	if ($params->get('show_readmore') && $this->item->readmore):            if ($params->get('access-view')):                $link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language));            else:                $itemId = JFactory::getApplication()->getMenu()->getActive()->id;                $link = new JUri(JRoute::_('index.php?option=com_users&view=login&Itemid=' . $itemId, false));                $link->setVar('return', base64_encode(JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language), false)));            endif;         endif; 			?>			<?php				if(empty($link)) {					$link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language));				}			?>

			<h3><a href="<?php echo $link; ?>"><?php echo $this->item->title; ?></a></h3>
   <?php
    $blog_text = strlen($this->item->introtext) > 121 ? substr($this->item->introtext,0,121)."..." : $this->item->introtext;
   // echo strip_tags($blog_text); 
	$remove_tags = array("<strong>", "</strong>");
	//echo str_replace($remove_tags, "", $blog_text);
	?>
<?php if ($useDefList && ($info == 1 || $info == 2)): ?>
	<?php echo JLayoutHelper::render('joomla.content.info_block.block', array('item' => $this->item, 'params' => $params, 'position' => 'below')); ?>
<?php endif; ?>

<?php if (!$params->get('show_intro')) : ?>
	<?php //echo $this->item->event->afterDisplayTitle; ?>
<?php endif; ?>
<?php if ($this->item->state == 0 || strtotime($this->item->publish_up) > strtotime(JFactory::getDate()) || ((strtotime($this->item->publish_down) < strtotime(JFactory::getDate())) && $this->item->publish_down != JFactory::getDbo()->getNullDate())): ?>
    <?php /*?></div><?php class="system-unpublished" */ ?>
<?php endif; ?>
<?php echo $this->item->event->afterDisplayContent; ?>