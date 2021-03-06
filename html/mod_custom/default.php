<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_custom
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
if ($module->showtitle) {
?>
<span class="module-header"><?php echo $module->title; ?></span>
<?php } ?>
<div class="toggle_footer_menu footer_custom_content">
<?php echo $module->content;?>
</div>