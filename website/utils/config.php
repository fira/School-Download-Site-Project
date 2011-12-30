<?php	
	/* utils/config.php 
		Loads configuration variables from an XML File using SimpleXML
		By default that file should be config.xml in root directory
    */

	/* This is just a config file, so let's keep it simple.
	   We don't need to do fancy trees, we'll just associate every tag name
	   to it's value in $_CONFIG.
	   EG. <tag>content</tag>    --->    $_CONFIG['tag'] = "content"
	*/
	
	/* Note that we need to shift the relative path to an absolute path
	   because the opening is done relative to the file processed by PHP */
	$configDoc = simplexml_load_file(__DIR__ . '/../config.xml');
	foreach($configDoc->children() as $item) {
		$_CONFIG[$item->getName()] = $item;
	}

	/* Lets clean up the variables used so they don't annoy us in other pages */
	unset($configDoc);
	unset($item);
?>
