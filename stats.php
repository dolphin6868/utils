<html>
<head>
<title>Memcache stats</title>
<style type="text/css">
body {
	font-family: "Segoe UI";
	line-height: 30px;
	font-size: 12px;
	padding: 20px 0px 0px 40px;
}

table {
	border: 2px solid #FEDC3D;
	margin: 40px 0px 0px 40px;
}

table td {
	padding: 10px;
}

.grey {
	background: #FEF5CB;
}

.highlights {
	font-weight: bold;
}
</style>
</head>
    <body>
		<?php         
			$memcache_obj = new Memcache;
			$memcache_obj->addServer('localhost', 11211);
		?>
		<h1>Th&#7889;ng k&#234; memcache server ucan</h1>
        <?php
		printDetails($memcache_obj->getStats());
        function printDetails($status) {

            echo "<table>";

            echo "<tr class='grey'><td>Phi&#234;n b&#7843;n memcache:</td><td class='highlights'> " . $status ["version"] . "</td></tr>";
            echo "<tr><td>Process id tr&#234;n server </td><td class='highlights'>" . $status ["pid"] . "</td></tr>";
            echo "<tr class='grey'><td>T&#7893;ng th&#7901;i gian ho&#7841;t &#273;&#7897;ng c&#7911;a memcache (t&#237;nh b&#7857;ng gi&#226;y) </td><td class='highlights'>" . $status ["uptime"] . " = " . ($status["uptime"]/3600) . " gi&#7901;</td></tr>";
			/*
            echo "<tr><td>T&#7893;ng th&#7901;i gian s&#7917; d&#7909;ng c&#7911;a ti&#7871;n tr&#236;nh hi&#7879;n th&#7901;i (t&#237;nh b&#7857;ng gi&#226;y)</td><td>" . $status ["rusage_user"] . " gi&#226;y</td></tr>";
            echo "<tr><td>T&#7893;ng th&#7901;i gian h&#7879; th&#7889;ng d&#224;nh cho ti&#7871;n tr&#236;nh hi&#7879;n th&#7901;i </td><td>" . $status ["rusage_system"] . " gi&#226;y</td></tr>";*/
            echo "<tr><td>T&#7893;ng s&#7889; item &#273;&#432;&#7907;c t&#7841;o ra k&#7875; t&#7915; khi server kh&#7903;i &#273;&#7897;ng</td><td class='highlights'>" . $status ["total_items"] . "</td></tr>";
            echo "<tr class='grey'><td>T&#7893;ng s&#7889; k&#7871;t n&#7889;i hi&#7879;n th&#7901;i</td><td class='highlights'>" . $status ["curr_connections"] . "</td></tr>";
            echo "<tr><td>T&#7893;ng s&#7889; k&#7871;t n&#7889;i k&#7875; t&#7915; khi server b&#7855;t &#273;&#7847;u ho&#7841;t &#273;&#7897;ng</td><td class='highlights'>" . $status ["total_connections"] . "</td></tr>";
            echo "<tr class='grey'><td>S&#7889; l&#432;&#7907;ng request nh&#7853;n d&#7919; li&#7879;u (d&#7841;ng get)</td><td class='highlights'>" . $status ["cmd_get"] . "</td></tr>";
            echo "<tr><td>S&#7889; l&#432;&#7907;ng request l&#432;u d&#7919; li&#7879;u (d&#7841;ng set)</td><td class='highlights'>" . $status ["cmd_set"] . "</td></tr>";

            $percCacheHit = ((real) $status ["get_hits"] / (real) $status ["cmd_get"] * 100);
            $percCacheHit = round($percCacheHit, 3);
            $percCacheMiss = 100 - $percCacheHit;

            echo "<tr class='grey'><td>S&#7889; l&#432;&#7907;ng kh&#243;a &#273;&#432;&#7907;c y&#234;u c&#7847;u v&#224; t&#236;m th&#7845;y</td><td class='highlights'>" . $status ["get_hits"] . " ($percCacheHit%)</td></tr>";
            echo "<tr><td>S&#7889; l&#432;&#7907;ng kh&#243;a &#273;&#432;&#7907;c y&#234;u c&#7847;u nh&#432;ng kh&#244;ng t&#236;m th&#7845;y</td><td class='highlights'>" . $status ["get_misses"] . "($percCacheMiss%)</td></tr>";

            $MBRead = (real) $status["bytes_read"] / (1024 * 1024);

            echo "<tr class='grey'><td>S&#7889; l&#432;&#7907;ng bytes &#273;&#227; upload l&#234;n server qua m&#7841;ng</td><td class='highlights'>" . $MBRead . " Mega Bytes</td></tr>";
            $MBWrite = (real) $status["bytes_written"] / (1024 * 1024);
            echo "<tr><td>S&#7889; l&#432;&#7907;ng bytes &#273;&#227; download t&#7915; server qua m&#7841;ng</td class='highlights'><td class='highlights'>" . $MBWrite . " Mega Bytes</td></tr>";
            $MBSize = (real) $status["limit_maxbytes"] / (1024 * 1024);
            echo "<tr class='grey'><td>K&#237;ch th&#432;&#7899;c t&#7889;i &#273;a c&#7911;a memcache.</td><td class='highlights'>" . $MBSize . " Mega Bytes</td></tr>";
            echo "<tr><td>S&#7889; l&#432;&#7907;ng items h&#7907;p l&#7879; &#273;&#227; b&#7883; x&#243;a &#273;&#7875; gi&#7843;i ph&#243;ng b&#7897; nh&#7899; cho items m&#7899;i</td><td class='highlights'>" . $status ["evictions"] . "</td></tr>";
            echo "<tr class='grey'><td>K&#237;ch th&#432;&#7899;c memcache hi&#7879;n th&#7901;i</td><td class='highlights'>" . (real) $status["bytes"] / (1024 * 1024) . " Mega Bytes</td></tr>";

            echo "</table>";
        }
        ?> 
    </body>
</html>