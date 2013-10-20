<?php
/*
 *Function to set environment of bee in play
 */
function environment_setting()
{
	if($_SERVER['HTTP_HOST'] == "localhost")
	{
		return "development";
	}
	else if($_SERVER['HTTP_HOST'] == "nbi.weblitzstudios.com")
	{
		return "staging";
	}
	else
	{
		return "production";
	}
}
?>
