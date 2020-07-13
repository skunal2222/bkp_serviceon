<?php
function label($label, $obj)
{
	$return = $obj->lang->line($label);
	if($return)
		echo $return;
	else
		echo $label;
}
