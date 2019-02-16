<?php
function dateformat($date,$format){ 
    if($format === '') $format = "%e.%B %Y";

    // $formattedDate = date_format(new DateTime($date), $format);
    $formattedDate = strftime($format ,strtotime($date));

    return $formattedDate;
};
?>