<?php

function greet()
{

    /* This sets the $time variable to the current hour in the 24 hour clock format */
    $time = date("H");
    /* Set the $timezone variable to become the current timezone */
    $timezone = date("e");
    /* If the time is less than 1200 hours, show good morning */
    if ($time < "12") {
        $aa = "mor";
        return "Good morning";

    } else
    /* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */
    if ($time >= "12" && $time < "17") {
        $aa = "af";
        echo "Good afternoon";
    } else
    /* Should the time be between or equal to 1700 and 1900 hours, show good evening */
    if ($time >= "17" && $time < "19") {
        return "Good evening";
    } else
    /* Finally, show good night if the time is greater than or equal to 1900 hours */
    if ($time >= "19") {
        return "Good night";
    }
 }

    ?>
<div  class="col-md-3 col-sm-3 pull-right" style="margin-top:8px">
	
	<h5><strong>{{ greet() }},<span style="color:#CE352C;font-size:110%;font-style:italic"> {{ ucwords( Auth::user()->name)}}</span></strong> </h5>
</div>