<?php


/*
	** Title Function v1.0
	** Title Function That Echo The Page Title In Case The Page
	** Has The Variable $pageTitle And Echo صارحني Title For Other Pages
	*/

function getTitle() {

    global $pageTitle;

    if (isset($pageTitle)) {

        echo $pageTitle;

    } else {

        echo 'صارحني';

    }
}

// function that takes a message's creation time as a parameter and returns a "time ago" string:

function time_ago($created_at) {
    $datetime = new DateTime($created_at, new DateTimeZone('Africa/Cairo'));
    $datetime->setTimezone(new DateTimeZone('Africa/Cairo'));
    $interval = $datetime->diff(new DateTime());
    $suffix = ($interval->invert == 1) ? 'منذ' : 'منذ';
    if ($interval->y > 0) {
        return $interval->format($suffix.' %y سنين');
    } elseif ($interval->m > 0) {
        return $interval->format($suffix.' %m شهور');
    } elseif ($interval->d > 0) {
        return $interval->format($suffix.' %d أيام');
    } elseif ($interval->h > 0) {
        return $interval->format($suffix.' %h ساعات');
    } elseif ($interval->i > 0) {
        return $interval->format($suffix.' %i دقائق');
    } else {
        return 'الأن';
    }
}

