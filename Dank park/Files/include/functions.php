<?php

//Get all friends from specified user and return as num array
function getFriends($userid) {
	$sql = "SELECT user_from FROM friends WHERE user_to = '$userid' UNION SELECT user_to FROM friends WHERE user_from = '$userid'";
	$result = mysql_query($sql);
	global $all_friends;
	$all_friends = array();

	while($friendrow = mysql_fetch_assoc($result)) {
			$friendname = $friendrow['user_from'];
			array_push($all_friends,$friendname);
	}
}

//Get all information from specified user etc. first name, avatar, email
function getInfo($name, $column='all') {
	global $user_info;
	$sqlusername = mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE username = '$name'"));
	$sqlid = mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE id = '$name'"));

	if ($column != 'all') {
		if (is_string($name)) {
			return $sqlusername[$column];
		} else {
			return $sqlid[$column];
		}
	} else {
		global $user_info;
		if (is_string($name)) {
			return $sqlusername;
			$user_info = $sqlusername;
		} else {
			return $sqlid;
			$user_info = $sqlid;
		}
	}
}

//Check if the two specified users are friends
function checkFriends($name1, $name2) {
	$number = mysql_num_rows(mysql_query("SELECT id FROM friends WHERE user_to = '$name1' AND user_from = '$name2' OR user_to = '$name2' AND user_from = '$name1'"));
	if ($number == 1) {
			return true;
	} else {
			return false;
	}
}

//Check if the two specified users' friendship has been accepted
function checkAccepted($name1, $name2) {
	$accepted_array = mysql_fetch_row(mysql_query("SELECT accepted FROM friends WHERE user_from = '$name1' AND user_to = '$name2' OR user_to = '$name2' AND user_from = '$name1'"));
	$accepted = $accepted_array[0];
	if ($accepted == '0') {
			return false;
	} else {
			return true;
	}
}

function verifyPass($username, $password) {
    $sql = mysql_query("SELECT * FROM users WHERE username = '$username'");
    $user_info = mysql_fetch_assoc($sql);
	$hash = crypt($password, '$6$rounds=5000$'.$user_info['salt'].'$');
	
	if ($user_info['password']==$hash) {
		return true;
	} else {
		return false;
	}
}

//Insert notification into database
function notify($userid, $type, $userfrom, $idfrom) {
	mysql_query("INSERT INTO notifications (userid, type, user_from, id_from) VALUES ('$userid','$type','$userfrom','$idfrom')");
}

//Parse text entered by users
function filter($text, $mentionid='6'){
	//Prevent xss
	$text = htmlspecialchars($text);
	
	//Star out bad words
	if (getInfo((int) @$_SESSION['id'], 'filter') == '1' || !@$_SESSION['id']) {
		$filterWords = array(																																																			'fuck','mother fucker','motherfucking','motherfucker','fucked','shit','hell','bitch','bitches','goddamn','dick','dicks','whore','vagina','vaginas','pussy','damn','tit','tits','crap','fag','fucker','fuckable','fuckboy','fucky','nigger','nigga','ass','boobies','cunt','boobs','porn','fucking','retarded','sex','truffle butter','sexy','poussey','cum','cumm','cumming','jizz','arse','arsehole','arse hole','g-spot','g spot','wanker','penis');
		$filterCount = sizeof($filterWords);

		for($i=0; $i<$filterCount; $i++){
			$text = preg_replace('/\b'.$filterWords[$i].'\b/ie',"str_repeat('*',strlen('$0'))",$text);
		}
	}
		
	//Make links clickable
	$text = linkify($text, $mentionid);

	//Preserve line breaks
	$text = nl2br($text);

	return $text;
}

//Convert any timestamp into easily readable times, ex 'Just now', '2m', '4h'
function easyTime($timestamp) {
	$timestamp = strtotime($timestamp);
	$currenttime = time();
	$messAge = $currenttime - $timestamp;

	global $easyTime;

	if ($messAge < '60') {
		$easyTime = 'Just now';
	} else if ($messAge/60 < '60') {
		$easyTime = floor($messAge/60).'m';
	} else if ($messAge/3600 < '24') {
		$easyTime = floor($messAge/3600).'h';
	} else if ($messAge/86400 < '7') {
		$easyTime = floor($messAge/86400).'d';
	} else if ($messAge/605500 < '52') {
		$easyTime = floor($messAge/605500).'w';
	} else {
		$easyTime = floor($messAge/31536000).'y';
	}
	
	return $easyTime;
}

//Truncate text with ellipsis
function truncate($text, $length) {
	$text = $text." ";
	$text = substr($text,0,$length);
	$text = substr($text,0,strrpos($text,' '));
	$text = $text."...";
	return $text;
}

//Convert to ordinal number ex. "1st, 3rd, 5th"
function ordinalNumber($num) {
	if (!in_array(($num % 100),array(11,12,13))){
		switch ($num % 10) {
			// 1st, 2nd, 3rd:
			case 1:  return $num.'st';
			case 2:  return $num.'nd';
			case 3:  return $num.'rd';
		}
	}
	return $num.'th';
}

//Write out block and period ex. "1st block, A day"
function formatPeriod($period, $ab=null) {
	$string = ordinalNumber($period).' block';
	if (isset($ab) and !empty($ab)) {
		$string .= ', '.strToUpper($ab).' day';
	}
	return $string;
}

//Remove special characters from string for URL's ex. "Hey I'm alex -> hey-im-alex"
function nonAlphaNum($string) {
	//Convert lain characters to regular equivilent
	$transliterationTable = array('á' => 'a', 'Á' => 'A', 'à' => 'a', 'À' => 'A', 'ă' => 'a', 'Ă' => 'A', 'â' => 'a', 'Â' => 'A', 'å' => 'a', 'Å' => 'A', 'ã' => 'a', 'Ã' => 'A', 'ą' => 'a', 'Ą' => 'A', 'ā' => 'a', 'Ā' => 'A', 'ä' => 'ae', 'Ä' => 'AE', 'æ' => 'ae', 'Æ' => 'AE', 'ḃ' => 'b', 'Ḃ' => 'B', 'ć' => 'c', 'Ć' => 'C', 'ĉ' => 'c', 'Ĉ' => 'C', 'č' => 'c', 'Č' => 'C', 'ċ' => 'c', 'Ċ' => 'C', 'ç' => 'c', 'Ç' => 'C', 'ď' => 'd', 'Ď' => 'D', 'ḋ' => 'd', 'Ḋ' => 'D', 'đ' => 'd', 'Đ' => 'D', 'ð' => 'dh', 'Ð' => 'Dh', 'é' => 'e', 'É' => 'E', 'è' => 'e', 'È' => 'E', 'ĕ' => 'e', 'Ĕ' => 'E', 'ê' => 'e', 'Ê' => 'E', 'ě' => 'e', 'Ě' => 'E', 'ë' => 'e', 'Ë' => 'E', 'ė' => 'e', 'Ė' => 'E', 'ę' => 'e', 'Ę' => 'E', 'ē' => 'e', 'Ē' => 'E', 'ḟ' => 'f', 'Ḟ' => 'F', 'ƒ' => 'f', 'Ƒ' => 'F', 'ğ' => 'g', 'Ğ' => 'G', 'ĝ' => 'g', 'Ĝ' => 'G', 'ġ' => 'g', 'Ġ' => 'G', 'ģ' => 'g', 'Ģ' => 'G', 'ĥ' => 'h', 'Ĥ' => 'H', 'ħ' => 'h', 'Ħ' => 'H', 'í' => 'i', 'Í' => 'I', 'ì' => 'i', 'Ì' => 'I', 'î' => 'i', 'Î' => 'I', 'ï' => 'i', 'Ï' => 'I', 'ĩ' => 'i', 'Ĩ' => 'I', 'į' => 'i', 'Į' => 'I', 'ī' => 'i', 'Ī' => 'I', 'ĵ' => 'j', 'Ĵ' => 'J', 'ķ' => 'k', 'Ķ' => 'K', 'ĺ' => 'l', 'Ĺ' => 'L', 'ľ' => 'l', 'Ľ' => 'L', 'ļ' => 'l', 'Ļ' => 'L', 'ł' => 'l', 'Ł' => 'L', 'ṁ' => 'm', 'Ṁ' => 'M', 'ń' => 'n', 'Ń' => 'N', 'ň' => 'n', 'Ň' => 'N', 'ñ' => 'n', 'Ñ' => 'N', 'ņ' => 'n', 'Ņ' => 'N', 'ó' => 'o', 'Ó' => 'O', 'ò' => 'o', 'Ò' => 'O', 'ô' => 'o', 'Ô' => 'O', 'ő' => 'o', 'Ő' => 'O', 'õ' => 'o', 'Õ' => 'O', 'ø' => 'oe', 'Ø' => 'OE', 'ō' => 'o', 'Ō' => 'O', 'ơ' => 'o', 'Ơ' => 'O', 'ö' => 'oe', 'Ö' => 'OE', 'ṗ' => 'p', 'Ṗ' => 'P', 'ŕ' => 'r', 'Ŕ' => 'R', 'ř' => 'r', 'Ř' => 'R', 'ŗ' => 'r', 'Ŗ' => 'R', 'ś' => 's', 'Ś' => 'S', 'ŝ' => 's', 'Ŝ' => 'S', 'š' => 's', 'Š' => 'S', 'ṡ' => 's', 'Ṡ' => 'S', 'ş' => 's', 'Ş' => 'S', 'ș' => 's', 'Ș' => 'S', 'ß' => 'SS', 'ť' => 't', 'Ť' => 'T', 'ṫ' => 't', 'Ṫ' => 'T', 'ţ' => 't', 'Ţ' => 'T', 'ț' => 't', 'Ț' => 'T', 'ŧ' => 't', 'Ŧ' => 'T', 'ú' => 'u', 'Ú' => 'U', 'ù' => 'u', 'Ù' => 'U', 'ŭ' => 'u', 'Ŭ' => 'U', 'û' => 'u', 'Û' => 'U', 'ů' => 'u', 'Ů' => 'U', 'ű' => 'u', 'Ű' => 'U', 'ũ' => 'u', 'Ũ' => 'U', 'ų' => 'u', 'Ų' => 'U', 'ū' => 'u', 'Ū' => 'U', 'ư' => 'u', 'Ư' => 'U', 'ü' => 'ue', 'Ü' => 'UE', 'ẃ' => 'w', 'Ẃ' => 'W', 'ẁ' => 'w', 'Ẁ' => 'W', 'ŵ' => 'w', 'Ŵ' => 'W', 'ẅ' => 'w', 'Ẅ' => 'W', 'ý' => 'y', 'Ý' => 'Y', 'ỳ' => 'y', 'Ỳ' => 'Y', 'ŷ' => 'y', 'Ŷ' => 'Y', 'ÿ' => 'y', 'Ÿ' => 'Y', 'ź' => 'z', 'Ź' => 'Z', 'ž' => 'z', 'Ž' => 'Z', 'ż' => 'z', 'Ż' => 'Z', 'þ' => 'th', 'Þ' => 'Th', 'µ' => 'u', 'а' => 'a', 'А' => 'a', 'б' => 'b', 'Б' => 'b', 'в' => 'v', 'В' => 'v', 'г' => 'g', 'Г' => 'g', 'д' => 'd', 'Д' => 'd', 'е' => 'e', 'Е' => 'E', 'ё' => 'e', 'Ё' => 'E', 'ж' => 'zh', 'Ж' => 'zh', 'з' => 'z', 'З' => 'z', 'и' => 'i', 'И' => 'i', 'й' => 'j', 'Й' => 'j', 'к' => 'k', 'К' => 'k', 'л' => 'l', 'Л' => 'l', 'м' => 'm', 'М' => 'm', 'н' => 'n', 'Н' => 'n', 'о' => 'o', 'О' => 'o', 'п' => 'p', 'П' => 'p', 'р' => 'r', 'Р' => 'r', 'с' => 's', 'С' => 's', 'т' => 't', 'Т' => 't', 'у' => 'u', 'У' => 'u', 'ф' => 'f', 'Ф' => 'f', 'х' => 'h', 'Х' => 'h', 'ц' => 'c', 'Ц' => 'c', 'ч' => 'ch', 'Ч' => 'ch', 'ш' => 'sh', 'Ш' => 'sh', 'щ' => 'sch', 'Щ' => 'sch', 'ъ' => '', 'Ъ' => '', 'ы' => 'y', 'Ы' => 'y', 'ь' => '', 'Ь' => '', 'э' => 'e', 'Э' => 'e', 'ю' => 'ju', 'Ю' => 'ju', 'я' => 'ja', 'Я' => 'ja');
    $string = str_replace(array_keys($transliterationTable), array_values($transliterationTable), $string);
	
	//Remove a - at the beginning or end and make lowercase
	$string = preg_replace('/\W+/', '-', strtolower($string));
	
	return $string;
}

function formalName($lname, $gender='m') {
	if ($gender=='m') {
		return 'Mr. '.$lname;
	} else {
		return 'Mrs. '.$lname;
	}
}

//Generate email confirmation token
function generateToken($length = 24) {
	if (function_exists('openssl_random_pseudo_bytes')) {
		$token = base64_encode(openssl_random_pseudo_bytes($length, $strong));
		if ($strong == TRUE) {
			return strtr(substr($token, 0, $length), '+/=', '-_,'); //base64 is about 33% longer, so we need to truncate the result
		}
	} else {
		//Fallback to mt_rand if openssl isn't avaiable
		$characters = '0123456789';
		$characters .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz/+'; 
		$charactersLength = strlen($characters)-1;
		$token = '';

		//Select some random characters
		for ($i = 0; $i < $length; $i++) {
			$token .= $characters[mt_rand(0, $charactersLength)];
		}        

		return $token;
	}
}

//Creates class codes
function generateCode($length = 6) {
	/* Only select from letters and numbers that are readable - no 0 or O etc..*/
	$characters = "23456789ABCDEFGHJKLMNPRTVWXYZabcdefghjkmnopqrstuwxyz";
	for ($p = 0; $p < $length; $p++) {
	   $string .= $characters[mt_rand(0, strlen($characters)-1)];
	}
	//Check if already exists in classcodes
	if (mysql_num_rows(mysql_query("SELECT * FROM classcodes WHERE code='$string'")) == 0) {
		return $string;
	} else {
		generateCode($length);
	}
}

//Make links clickable
function linkify($message, $mentionid) {
	/*$parsed = preg_replace(array('/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:\'".,<>?«»“”‘’]))/', '/(^|[^a-z0-9_])@([a-z0-9_]+)/i', '/(^|[^a-z0-9_])#([a-z0-9_]+)/i'), array('<a href="$1" target="_blank">$1</a>', '$1<a href="profile.php?u='.getInfo('kasimir','id').'">@$2</a>', '$1<a href="index.php?hashtag=$2">#$2</a>'), $message);*/
	$parsed = preg_replace_callback(array('/@+([a-zA-Z0-9_]+)/','/#+([a-zA-Z-0-9_]+)/','!(((f|ht)tp(s)?://)[-a-zA-Zа-яА-Я()0-9@:%_+.~#?&;//=]+)!i'), function($matches) {
		if (strpos($matches[0], '@') === 0) {
			return '<a href="profile.php?u='.getInfo($matches[1],'id').'">'.$matches[0].'</a>';
		} else if (strpos($matches[0], '#') === 0) {
			//Contains a #hashtag
			return '<a href="hashtag.php?tag='.$matches[1].'">'.$matches[0].'</a>';
		} else {
			//Contains a http(s)://link.com/
			return '<a href="'.$matches[1].'" target="_blank">'.$matches[1].'</a>';
		}
	}, $message);

	return $parsed;
}

//Detect whether to use black or white text on any given color
function readableColor($hex){
    $r = hexdec(substr($hex,0,2));
    $g = hexdec(substr($hex,2,2));
    $b = hexdec(substr($hex,4,2));

    $contrast = sqrt(
        $r * $r * .241 +
        $g * $g * .691 +
        $b * $b * .068
    );

    if ($contrast > 130) {
        return '000000';
    } else{
        return 'ffffff';
    }
}

?>
