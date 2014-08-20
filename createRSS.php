<?php

echo '<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0">
<channel>
<title>fuck</title>
<description>son of bitch</description>
<link>www.baidu.com</link>';

$data = array(
	0 => array('title' => 'SSH Key Authentication', 'description' => 'The wonderful hosting company that I use', 'link' => 'http://www.larryullman.com/2012/05/25/ssh-key-authentication/', 'pubDate' => '1337930580'),
	1 => array('title' => 'What It Means to Be a Writer, Part 1', 'description' => 'A little while back, I had a series of emails', 'link' => 'http://www.larryullman.com/2012/05/23/what-it-means-to-be-a-writer-part-1-defining-your-book/', 'pubDate' => '1337683425'),
	2 => array('title' => 'Learn to Write', 'description' => 'There was a recent posting by', 'link' => 'http://www.larryullman.com/2012/05/18/learn-to-write/', 'pubDate' => '133733103')
);

foreach ($data as $key => $item) {
	echo '<item>
	<title>' . htmlentities($item['title']) . '</title>
	<description>' . htmlentities($item['description']) . '...</description>
	<link>' . $item['link'] . '</link>
	<guid>' . $item['link'] . '</guid>
	<pubDate>' . date('r', $item['pubDate']) . '</pubDate>
	</item>
	';
}

echo '</channel>
</rss>';

?>