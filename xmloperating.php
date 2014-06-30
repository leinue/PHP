<?
/*create*/
//class
$xml="<rss><channel>xxxx</channel></rss>>";
$rss=new SimpleXMLElement($xml);

//string
$rss=simplexml_load_string($xml);

//file
$rss=simplexml_load_file("filename");
/*create*/

/*read*/
$rss=simplexml_load_file("filename");
foreach ($rss->channel-?item as $item) {
	echo $item->title."</br>";
	echo $item->link."</br></br>"
}
/*read*/

/*edit*/
$rss=simplexml_load_file("filename");

$rss->channel->item[2]->title="xxx";//更改第三个元素的值

foreach ($rss->channel-?item as $item) {
	echo $item->title."</br>";
	echo $item->link."</br></br>"
}
/*edit*/

/*delete*/
$rss=simplexml_load_file("filename");

unset($rss->channel->item[2]);//删除第三个元素的值

foreach ($rss->channel-?item as $item) {
	echo $item->title."</br>";
	echo $item->link."</br></br>"
}
/*delete*/
?>