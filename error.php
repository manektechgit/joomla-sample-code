<?php
/**
 * @package		Joomla.Site
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
 
$lang = JFactory::getLanguage();
$langtag = $lang->getTag();

if (($this->error->getCode()) == '404') {
header('Location:'.JUri::root().explode('-',$langtag)[0].'/	');
exit;
}