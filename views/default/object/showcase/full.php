<?php

$showcase = $vars['entity'];
$owner = $showcase->getOwnerEntity();

$img = elgg_view_entity_icon($showcase, 'master', array(
	'href' => false,
));
$icon = elgg_view('output/url', array(
	'text' => $img,
	'href' => $showcase->address,
	'class' => 'showcase-master'
));

$owner_icon = elgg_view_entity_icon($owner, 'tiny');
$owner_link = elgg_view('output/url', array(
	'href' => $owner->getURL(),
	'text' => $owner->name,
	'is_trusted' => true,
));
$author_text = elgg_echo('byline', array($owner_link));
$date = elgg_view_friendly_time($showcase->time_created);

$categories = elgg_view('output/categories', $vars);

$body = $icon . elgg_view('output/longtext', array('value' => $showcase->description));

$metadata = elgg_view_menu('entity', array(
	'entity' => $showcase,
	'handler' => 'showcase',
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));

// do not show the metadata and controls in widget view
if (elgg_in_context('widgets')) {
	$metadata = '';
}

$subtitle = "$author_text $date $categories";


$params = array(
	'entity' => $showcase,
	'title' => false,
	'metadata' => $metadata,
	'subtitle' => $subtitle,
);
$params = $params + $vars;
$summary = elgg_view('object/elements/summary', $params);

echo elgg_view('object/elements/full', array(
	'summary' => $summary,
	'icon' => $owner_icon,
	'body' => $body,
));