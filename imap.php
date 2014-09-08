 <?php
$mb = imap_open("{my.imap.com.tw}INBOX", "wilson", "mypasswd");
$AllHeaders = imap_headers($mb);
imap_close($mb);
echo "<pre>\n";
for ($i=0; $i < count($AllHeaders); $i++) {
  echo $AllHeaders[$i]."<p><hr><p>\n";
}
echo "</pre>\n";
?> 