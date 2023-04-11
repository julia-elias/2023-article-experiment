<?php
include ('data.php');
$identifier = 'schl-eyp';
$eyp = array(
	array(
		'title'   => '<strong>Why</strong> we’re doing this story',
		'content' => '<p>The issue of mass school shootings is a complicated one, and The News Beat is committed to looking at it from several angles. Today’s story addresses the factor of location. Other recent stories have looked at school facilities, gun laws, teacher training and mental health.</p>'
	),
	array(
		'title'   => '<strong>How</strong> we’re doing this story',
		'content' => '<p>To try to make sense of school shootings, we used FBI data (the most comprehensive shooting data available in the U.S.) to look for patterns. We found commonalities in the location of the shootings and are sharing our analysis with you here. The national poll mentioned in the story surveyed a random sample of 2,000 U.S. adults, which means that every American adult had an equal chance of being surveyed.</p>'
	),
	array(
		'title'   => 'Here’s <strong>where we need your help</strong>',
		'content' => '<p>How can the United States make its schools safer? And how can The News Beat cover the issue in a way that’s fair and that helps in our society’s understanding? Please share those ideas in the comments section.</p>'
	)
);

include ('../article-template.php');
