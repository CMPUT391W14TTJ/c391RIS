<?php

function sort_picker($name)
{
    $order=array('Date ASC', 'Date DESC');

    // Sort dropdown
    $html="<select name=\"".$name."order\">";
    $html.="<option value='NULL'>Default</option>";
    for($i=0;$i<2;$i++)
    {
       $html.="<option value='$order[$i]'>$order[$i]</option>";
    }
    $html.="</select> ";

    return $html;
}
?>
