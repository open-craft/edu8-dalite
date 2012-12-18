<?php

namespace Edu8;

class Config {
    private static $connection;

    public static function initDb() {
        if(!$connection){
	    $filename = __DIR__ . '/../../config/db.php';
	    if (is_file($filename))
		$connection = require $filename;
	    else
	        throw new Exception('Missing config/', basename($filename));
	}
        return $connection;
    }
}

?>
