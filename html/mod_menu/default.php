<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$id = '';

if (($tagId = $params->get('tag_id', '')))
{
	$id = ' id="' . $tagId . '"';
}

// The menu class is deprecated. Use nav instead
?>
<div class="respo_btn">	
    <a href="javascript:void(0)">	
        <span class="navbar-icon"> 	
            <span></span> <span></span> <span></span> <span></span> 	
        </span>
	</a>	
</div>

<?php if($module->showtitle) { ?><div class="menu-wrap"><h3 class="module-header"><?php echo $module->title; ?></h3><?php } ?>
<ul class="nav toggle_footer_menu tz-main-nav<?php echo $class_sfx; ?>"<?php echo $id; ?>>
<?php foreach ($list as $i => &$item)
{
	$itemParams = $item->getParams();
	$class = 'nav-item';

	if ($item->id == $default_id)
	{
		$class .= '';
	}


	if (($item->id == $active_id) || ($item->type == 'alias' && $itemParams->get('aliasoptions') == $active_id))
	{
		// $class .= ' current';
	}

	if (in_array($item->id, $path))
	{
		// $class .= ' active';
	}
	elseif ($item->type == 'alias')
	{
		$aliasToId = $itemParams->get('aliasoptions');

		if (count($path) > 0 && $aliasToId == $path[count($path) - 1])
		{
			$class .= ' active';
		}
		elseif (in_array($aliasToId, $path))
		{
			$class .= ' alias-parent-active';
		}
	}

	if ($item->type == 'separator')
	{
		$class .= ' divider';
	}

	if ($item->deeper)
	{
		$class .= ' deeper dropdown';
	}

	if ($item->parent)
	{
		// $class .= ' parent';
	}

	echo '<li class="' . $class . '">';

	switch ($item->type) :
		case 'separator':
		case 'component':
		case 'heading':
		case 'url':
			require JModuleHelper::getLayoutPath('mod_menu', 'default_' . $item->type);
			break;

		default:
			require JModuleHelper::getLayoutPath('mod_menu', 'default_url');
			break;
	endswitch;

	// The next item is deeper.
	if ($item->deeper)
	{
		echo '<span class="down-arrow"></span>';
		echo '<ul class="nav-child dropdown-ul">';
	}
	// The next item is shallower.
	elseif ($item->shallower)
	{
		echo '</li>';
		echo str_repeat('</ul></li>', $item->level_diff);
	}
	// The next item is on the same level.
	else
	{
		echo '</li>';
	}
}
?>
<?php if($module->showtitle) { ?>
</div>
<?php } ?>
