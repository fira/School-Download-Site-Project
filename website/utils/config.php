<?php	
	/* utils/config.php 
		This file is designed to load a XML File, and parse it to set
		configuration variables used in the rest of the website
		Note that because it parses an XML File, it's advised to load it 
		only where neccessary to reduce server load */

	// Hardcoded variable for the path to the config file. Unless you have a better idea.
	$configFile = 'config.xml';


	/* Let's keep it simple. It's just a configuration file, we don't need
	fancy data trees. We'll process every tag at the root level and 
	set its value in the configuration array, with key being the tag name. 
	IE. if you have <stuff>things</stuff> it'll set $_CONFIG['stuff'] = things 
	Why not even use just a space or comma separated file ?? */
	
	/* We can't directly use the path, the function takes a path relative to the including file
	 We then get the absolute path to config/config.php instead, 
	and go up one directory, to end up in the site root */
	$configDoc = simplexml_load_file(__DIR__ . '/../' . $configFile);
	foreach($configDoc->children() as $item) {
		$_CONFIG[$item->getName()] = $item;
	}

	/* Lets clean up the variables used so they don't annoy us in other pages */
	unset($configDoc);
	unset($configPath);
	unset($item);
?>
