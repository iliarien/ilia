<?php
$username = $_GET['username'];
$password = $_GET['password'];
$file = "webtv_usr.xml";
		 $txt_file = file_get_contents('http://' . $_SERVER['HTTP_HOST'] . '/get.php?type=starlivev3&username=' . $username . '&password=' . $password . '');
           $rows        = explode("\n", $txt_file);
              if(empty($rows[count($rows)-1])) {
                 unset($rows[count($rows)-1]);
                 $rows=array_map('trim',$rows);
              }
	   $handle = fopen($file, "w+") or die('Could not open file');
	   fwrite($handle, "<?xml version=\"1.0\"?>"."\n");
	   fwrite($handle, "<!-- Playlist generator for spark WEB TV plugin for Xtream-Codes iptv panel developed by MikkM (mikk.myyrsepp@gmail.com) -->"."\n");
	   fwrite($handle, "<webtvs>"."\n");
  foreach($rows as $row => $data)
       {
	//get row data
	$row_data = explode(',', $data);
    //replace _ with spaces
    $row_data[0] = str_replace('_', ' ', $row_data[0]);


       //generate playlist content
	   fwrite($handle, "<webtv title=\"{$row_data[0]}\" urlkey=\"0\""."\n");
	   fwrite($handle, "url=\"{$row_data[1]}\""."\n");
	   fwrite($handle, "description=\"\" type=\"1\" group=\"1\" iconsrc=\"\"/>"."\n");
	 }
fwrite($handle, "</webtvs>");
fclose($handle);
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($file));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
?>
netstat -plane | grep :80 | awk {‘print $5'} | cut -d ‘:’ -f1 | sort -n | uniq -c | sort -n
netstat -plane | grep :80 | awk {‘print $5'} | cut -d ‘:’ -f1 | sort -n | uniq -c | sort -n