<?php
include ('data.php');
$identifier = 'hr-eyp';
$eyp = array(
	array(
		'title'   => '<strong>Why</strong> we’re doing this story',
		'content' => '<p>In choosing which crimes to write about, we evaluate if there is an ongoing threat to public safety and prioritize covering those that do. This crash left a driver in critical condition, and the suspect is still at large.</p>'
	),
	array(
		'title'   => '<strong>How</strong> we’re doing this story',
		'content' => '<p>All the information in this story was gathered from interviews with Fairview police or police reports from that department. We often do not publish suspect mugshots, but we did in this case so the community can help police find him.</p>'
	),
	array(
		'title'   => '<strong>Our approach</strong> to covering crime',
		'content' => '<p>We are working on an FAQ about which crimes we report, what information we include and the goals and ethics that guide us. If you have a question you\'d like to see answered, please post it in the comments.</p>'
	)
);
include ('../article-template.php');
