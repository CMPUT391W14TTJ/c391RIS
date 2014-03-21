<?php

function time_picker($name)
{
    $order=array('Week', 'Month', 'Year');

    // Sort dropdown
    $html="<select name=\"".$name."picker\">";
    for($i=0;$i<3;$i++)
    {
       $html.="<option value='$order[$i]'>$order[$i]</option>";
    }
    $html.="</select> ";

    return $html;
}
?>
