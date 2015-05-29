<?php
	require_once('include/upload_file.php');
	require_once('custom/modules/Accusoft/acsApiKey.php');
	require_once('custom/modules/Accusoft/acsViewerParams.php');

	if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

	function createViewingSession() {
		$str_post = '{"render":{"html5":{"alwaysUseRaster":false}}}';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, ACS_API_URL);
		curl_setopt($ch, CURLOPT_POST, true);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	    	'acs-api-key: '.ACS_API_KEY,
			'Content-Type: application/json'
		));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $str_post);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($code != 200) {
        	echo "<br>Error creating viewing session.<br>Return Code = ".$code;
        	throw new Exception('Error posting create viewing session request to ACS proxy.');
        }
        return $response;
    }

	function putDocument($viewing_session, $file_size, $upload_location ) {
		$fp = fopen ($upload_location, "r");
		$endpoint = ACS_API_URL."/u".$viewing_session."/SourceFile";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_URL, $endpoint);
		curl_setopt($ch, CURLOPT_PUT, 1);
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'acs-api-key: '.ACS_API_KEY,
		));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_INFILE, $fp);
		curl_setopt($ch, CURLOPT_INFILESIZE, $file_size);

		$response = curl_exec($ch);
		$error = curl_error($ch);
		$header_info = curl_getinfo($ch,CURLINFO_HEADER_OUT);
		$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
		$header = substr($response, 0, $header_size);
		$body = substr($response, $header_size);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        fclose($fp);

		if ($error) {
   			echo "<br>Error sending file.<br>error = ".$error;
   			throw new Exception('Error posting create viewing session request to ACS proxy.');
		}
    if ($code != 200) {
	    echo "<br>Error sending file.<br>Return Code = ".$code;
    	throw new Exception('Error posting create viewing session request to ACS proxy.');
    }
    return $response;
	}

	echo "<br>One moment please while your document is being prepared...";

	$file_id = $_GET["id"];
	$doc = new Document();
	$doc->retrieve($file_id);
	$upload_location = "upload://{$doc->document_revision_id}";
	if (strlen($upload_location) < 36) {
		$upload_location .= $file_id;
	}

	$file_contents = file_get_contents($upload_location);
	$file_size = mb_strlen($file_contents, 'latin1');

	$resp = json_decode(createViewingSession());
	$viewing_session = $resp->viewingSessionId;

	putDocument($viewing_session, $file_size, $upload_location );

	echo '<script type="text/javascript" language="javascript">
		window.location.href = "'.VIEWER_URL.'/?key='.ACS_API_KEY.'&viewingSessionId='.$viewing_session.'&logoimage=&viewertype=html5&viewerwidth='.VIEWER_WIDTH.'&viewerheight='.VIEWER_HEIGHT.'&upperToolbarColor='.UPPER_TOOLBAR_COLOR.'&lowerToolbarColor='.LOWER_TOOLBAR_COLOR.'&bottomToolbarColor='.BOTTOM_TOOLBAR_COLOR.'&backgroundColor='.BACKGROUND_COLOR.'&fontColor='.FONT_COLOR.'&buttonColor='.BUTTON_COLOR.'";
	</script>';
?>

