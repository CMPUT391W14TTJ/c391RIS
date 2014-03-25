<?php

function time_picker($name)
{
    $order=array('Week', 'Month', 'Year', 'Total');

    // Sort dropdown
    $html="<select name=\"".$name."picker\">";
    for($i=0;$i<4;$i++)
    {
       $html.="<option value='$order[$i]'>$order[$i]</option>";
    }
    $html.="</select> ";

    return $html;
}
?>
