<?php

$el = $this->el('div', [

    'class' => [
        'example-element'
    ]

]);

// Joomla! Fields Helper & Setup to get the Fields for this article:
JLoader::register('FieldsHelper', JPATH_ADMINISTRATOR . '/components/com_fields/helpers/fields.php');
$model = JModelLegacy::getInstance('Article', 'ContentModel', array('ignore_request'=>true));
$articleID = JFactory::getApplication()->input->get('id');
$appParams = JFactory::getApplication()->getParams();
$model->setState('params', $appParams);
$item = $model->getItem($articleID);

// get the Articles's Customfields
$jcFields = FieldsHelper::getFields('com_content.article', $item, true);
$itemCustomFields = array();
foreach($jcFields as $field) {
    $itemCustomFields[$field->name]['value'] = $field->rawvalue;
    $itemCustomFields[$field->name]['label'] = $field->label;
};
if(!empty($props['fieldname'])){
    if(array_key_exists($props['fieldname'], $itemCustomFields)){
        var_dump($itemCustomFields[$props['fieldname']]['value']);

    }else{
        echo '<script> console.log("nx-Joomla! Customfield Plugin for Yootheme Pro: Customfield '.$props['fieldname'].' not found in this article");</script>';
    };
}else{
    echo '<script> console.log("nx-Joomla! Customfield Plugin for Yootheme Pro: no Customfield configured");</script>';
};




?>

<?= $el($props, $attrs) ?>

    <?php // render node title field by using $props['title'] ?>

    <?php // render node select field by using $props['select'] ?>

    

</div>
