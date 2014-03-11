<?php


function get_month_string($number)
{
	$months=array('','January','February','March','April','May',
   	'June','July','August', 'September','October','November','December');
	return $months[$number];
}

function date_picker($name, $startyear=NULL, $endyear=NULL)
{
    if($startyear==NULL) $startyear = date("Y")-50;
    if($endyear==NULL) $endyear=date("Y"); 

    $months=array('','January','February','March','April','May',
    'June','July','August', 'September','October','November','December');

    // Month dropdown
    $html="<select name=\"".$name."month\">";

    for($i=1;$i<=12;$i++)
    {
       $html.="<option value='$i'>$months[$i]</option>";
    }
    $html.="</select> ";
   
    // Day dropdown
    $html.="<select name=\"".$name."day\">";
    for($i=1;$i<=31;$i++)
    {
       $html.="<option $selected value='$i'>$i</option>";
    }
    $html.="</select> ";

    // Year dropdown
    $html.="<select name=\"".$name."year\">";

    for($i=$endyear;$i>=$startyear;$i--)
    {      
      $html.="<option value='$i'>$i</option>";
    }
    $html.="</select> ";

    return $html;
}
?>
