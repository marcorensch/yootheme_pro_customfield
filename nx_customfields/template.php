<?php
/*
<div>
    <h1>Example Element</h1>
    <?php var_dump($element->children); 
    echo gettype($element['cffieldname']);
    
    foreach($element->children as $field){
        $fieldname = $field->props['cffieldname'];
        echo '<h3>'.$fieldname.'</h3>';
    }
    ?>
</div>
*/
?>

<?php

if (!defined('__ROOT__')) define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/nx_customfields/helper/debug.php'); 


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
}

// CSS by Element Settings
if(strlen($element['field_editor_css']) > 3){
    echo '<style type="text/css">' . $element['field_editor_css'] . '</style>';
}

// Element Render:
echo '<div id="' . $element['id'] . '" class="el-container ' . $element['class'][0] . '">';

switch($element['field_select_layout']){
    case 1:
        // Resultat width m & larger
        echo '<div class="uk-child-width-1-1 uk-grid-collapse" uk-grid>';
        $i = 0;
        $wrap_count = 4;
        foreach($element->children as $searchedfield){
            if(array_key_exists('cffieldname', $searchedfield->props)){ // start only if key exists
                $i +=1;
                $fieldname = $searchedfield->props['cffieldname'];
                if (array_key_exists('field_prefix', $searchedfield->props)) {
                    $prefix = $searchedfield->props['field_prefix'];
                }else{
                    $prefix = '';
                };
                if (array_key_exists('field_suffix', $searchedfield->props)) {
                    $suffix = $searchedfield->props['field_suffix'];
                }else{
                    $suffix = '';
                };

                $fieldvalue = $itemCustomFields[$fieldname]['value'];

                if($i%$wrap_count==1){
                    // New row
                    echo '<div class="el-row uk-child-width-auto uk-grid-small uk-flex uk-flex-center" uk-grid>';
                };

                if(is_numeric($fieldvalue)){
                    echo '<div class="el-number">' . $fieldvalue . '</div>';
                }else{
                    $fieldvalueArray = explode(' ', $fieldvalue);
                    $shortname = $fieldvalueArray[1];
                    echo '<div class="el-text">';
                        echo '<span class="uk-hidden@m">' . $shortname . '</span>'; 
                        echo '<span class="uk-visible@m">' .$prefix . $fieldvalue . $suffix . '</span>';
                    echo '</div>';
                };

                if($i%2 == 0 && $i%$wrap_count != 0){
                    echo '<div>:</div>';
                }

                if($i%$wrap_count==0){
                    // End of row
                    echo '</div>';
                };
            }; // End if Key cffieldname exists
        };
        echo '</div>';
    break;
    case 0:
    default:
    // Simple text
        foreach($element->children as $searchedfield){
            if(array_key_exists('cffieldname', $searchedfield->props)){ // start only if key exists
                if (array_key_exists('field_prefix', $searchedfield->props)) {
                    $prefix = $searchedfield->props['field_prefix'];
                }else{
                    $prefix = '';
                };
                if (array_key_exists('field_suffix', $searchedfield->props)) {
                    $suffix = $searchedfield->props['field_suffix'];
                }else{
                    $suffix = '';
                };
                $fieldname = $searchedfield->props['cffieldname'];
                $fieldvalue = $itemCustomFields[$fieldname]['value'];
                echo '<div class="el-text">' .$prefix .  $fieldvalue . $suffix . '</div>';
            };
        }
}

echo '</div>';


?>