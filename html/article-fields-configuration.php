<?php
	JLoader::register('FieldsHelper', JPATH_ADMINISTRATOR . '/components/com_fields/helpers/fields.php');
	JModelLegacy::addIncludePath(JPATH_SITE.'/components/com_content/models', 'ContentModel');
	$id = JFactory::getApplication()->input->get('id');
	$view_article = JFactory::getApplication()->input->get('view');			
					
		if($id != "" && $view_article == 'article') {
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
		}
?>