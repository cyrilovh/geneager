<?php
	require "../src/inc/root.php";
	//die( class\url::pathFolders());
	if(isset($_GET["name"]) && !empty($_GET["name"])){
		$filename = \class\security::cleanStr($_GET["name"]); // clean the string
		$filename_fullpath = str_replace('//', '/', UPLOAD_DIR_FULLPATH.class\url::pathFolderStr().$filename); // full path of the file

		$cacheExpiration = $gng_paramList->get("pictureMaxAge"); // cache expiration for pictures
		$cacheExpirationStale = intval($gng_paramList->get("pictureMaxAge"))+3600; // if error HTTP 5xx, cache for 1 hour more
		header("Cache-Control: private, max-age=$cacheExpiration, stale-if-error=$cacheExpirationStale"); // cache expiration for pictures

		$defaultPicture = (array_reverse(explode("/", \class\url::pathFolderStr()))[1] == "ancestor") ? UPLOAD_DIR_FULLPATH."unknownAncestor.webp" : DEFAULTPICTURE; // default picture

		if(file_exists($filename_fullpath)){ // if the file exists
			// if(\model\picture::fileExistInDatabase($filename)){ // if the file exists in database
				$extension = pathinfo($filename, PATHINFO_EXTENSION);	// get the extension of the file
				
				switch ($extension) {
				  case "jpg":
				  case "jpeg":
					header("Content-Type: image/jpeg");
					break;
				  case "png":
					header("Content-Type: image/png");
					break;
				  case "gif":
					header("Content-Type: image/gif");
					break;
				case "webp":
					header("Content-Type: image/webp");
					break;
				  default:
					header("Content-Type: image/webp");
					header('Content-Length: ' . filesize($defaultPicture));
					readfile($defaultPicture);
					exit();
				}

				header('Content-Disposition: inline; filename="'.$filename.'"'); // send the filename
				header('Content-Length: ' . filesize($filename_fullpath)); // send the file size
				readfile($filename_fullpath); // send the file
			// }else{
			// 	header("Content-Type: image/webp");
			// 	header('Content-Length: ' . filesize($defaultPicture));
			// 	readfile(DEFAULTPICTURE);
			// }
		}else{
			header("Content-Type: image/webp");
			readfile($defaultPicture);
		}
	}else{
		header("Content-Type: image/webp");
		readfile($defaultPicture);
	}
?>