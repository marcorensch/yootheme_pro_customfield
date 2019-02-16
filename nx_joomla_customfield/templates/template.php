<?php

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

function dateformat($date,$format){

    
    if($format === '') $format = "%e.%B %Y";

    // $formattedDate = date_format(new DateTime($date), $format);
    $formattedDate = strftime($format ,strtotime($date));

    return $formattedDate;
};

if(!empty($props['fieldname'])){
    if(array_key_exists($props['fieldname'], $itemCustomFields)){
        $rawvalue = $itemCustomFields[$props['fieldname']]['value'];
        switch($props['fieldtype']){
            case 'date':
                $string = dateformat($rawvalue, $props['dateformat'] );
            break;
            case 'text':
            default:
            $string = $rawvalue;
        };

        echo '<div class="">'.$string.'</div>'."\n";

    }else{
        echo '<script> console.log("nx-Joomla! Customfield Plugin for Yootheme Pro: Customfield '.$props['fieldname'].' not found in this article");</script>';
    };
}else{
    echo '<script> console.log("nx-Joomla! Customfield Plugin for Yootheme Pro: no Customfield configured");</script>';
};




?>

    <?php // render node title field by using $props['title'] ?>

    <?php // render node select field by using $props['select'] ?>
