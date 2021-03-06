<?php

require_once("parameters/parameters.php");

$filename = RESPONSE_FILE;
$response = RESPONSE_MESSAGE;
$data = array($_REQUEST['From'], $_REQUEST['Body'], date('Y-m-d'), date('H:i:s'));

// Write the response to the file
if (file_exists($filename)) {
    $responses = fopen($filename, 'a');
} else {
    $responses = fopen($filename, 'w');
    fputcsv($responses, array('number', 'message', 'date', 'time'));
}

fputcsv($responses, $data);
fclose($responses);

// XML response for Twilio's API
header("content-type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";

?>
<Response>
    <Message><?php echo $response; ?></Message>
</Response>