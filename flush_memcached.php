<?php
	$memcache = new Memcache;
    $memcache->connect("localhost", 11211); # You might need to set "localhost" to "127.0.0.1"
	$memcache->flush();
	echo '<h1>Memcached is flushed!</h1>';
?>