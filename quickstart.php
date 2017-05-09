
<?php
require_once __DIR__ . '/vendor/autoload.php';


define('APPLICATION_NAME', 'Google Apps Script Execution API PHP Quickstart');
define('CREDENTIALS_PATH', '~/.credentials/script-php-quickstart.json');
define('CLIENT_SECRET_PATH', __DIR__ . '/client_secret.json');
// If modifying these scopes, delete your previously saved credentials
// at ~/.credentials/script-php-quickstart.json
define('SCOPES', implode(' ', array(
  "https://www.googleapis.com/auth/drive")
));

if (php_sapi_name() != 'cli') {
  throw new Exception('This application must be run on the command line.');
}

/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
function getClient() {
  $client = new Google_Client();
  $client->setApplicationName(APPLICATION_NAME);
  $client->setScopes(SCOPES);
  $client->setAuthConfig('{"installed":{"client_id":"523061264563-mdevajkbu1rbs54hamsrhjss21pj24l9.apps.googleusercontent.com","project_id":"project-id-1006435552041980444","auth_uri":"https://accounts.google.com/o/oauth2/auth","token_uri":"https://accounts.google.com/o/oauth2/token","auth_provider_x509_cert_url":"https://www.googleapis.com/oauth2/v1/certs","client_secret":"z2FJJhZpMYF-yKs8t4XVCrht","redirect_uris":["urn:ietf:wg:oauth:2.0:oob","http://localhost"]}}');
  $client->setAccessType('offline');

  // Load previously authorized credentials from a file.
  $credentialsPath = expandHomeDirectory(CREDENTIALS_PATH);
  if (file_exists($credentialsPath)) {
    $accessToken = json_decode(file_get_contents($credentialsPath), true);
  } else {
    // Request authorization from the user.
    $authUrl = $client->createAuthUrl();
    printf("Open the following link in your browser:\n%s\n", $authUrl);
    print 'Enter verification code: ';
    $authCode = trim(fgets(STDIN));

    // Exchange authorization code for an access token.
    $accessToken = $client->authenticate($authCode);

    // Store the credentials to disk.
    if(!file_exists(dirname($credentialsPath))) {
      mkdir(dirname($credentialsPath), 0700, true);
    }
    file_put_contents($credentialsPath, json_encode($accessToken));
    printf("Credentials saved to %s\n", $credentialsPath);
  }
  $client->setAccessToken($accessToken);

  // Refresh the token if it's expired.
  if ($client->isAccessTokenExpired()) {
    $client->authenticate($client->getRefreshToken());
    file_put_contents($credentialsPath, json_encode($client->getAccessToken()));
  }
  return $client;
}

/**
 * Expands the home directory alias '~' to the full path.
 * @param string $path the path to expand.
 * @return string the expanded path.
 */
function expandHomeDirectory($path) {
  $homeDirectory = getenv('HOME');
  if (empty($homeDirectory)) {
    $homeDirectory = getenv('HOMEDRIVE') . getenv('HOMEPATH');
  }
  return str_replace('~', realpath($homeDirectory), $path);
}

// Get the API client and construct the service object.
$client = getClient();
$service = new Google_Service_Script($client);

$scriptId = 'MgcfxzT3ebFjN_fC02ehLb6AZcoUUyC-k';

// Create an execution request object.
$request = new Google_Service_Script_ExecutionRequest();
$request->setFunction('getFoldersUnderRoot');

try {
  // Make the API request.
  $response = $service->scripts->run($scriptId, $request);

  if ($response->getError()) {
    // The API executed, but the script returned an error.

    // Extract the first (and only) set of error details. The values of this
    // object are the script's 'errorMessage' and 'errorType', and an array of
    // stack trace elements.
    $error = $response->getError()['details'][0];
    printf("Script error message: %s\n", $error['errorMessage']);

    if (array_key_exists('scriptStackTraceElements', $error)) {
      // There may not be a stacktrace if the script didn't start executing.
      print "Script error stacktrace:\n";
      foreach($error['scriptStackTraceElements'] as $trace) {
        printf("\t%s: %d\n", $trace['function'], $trace['lineNumber']);
      }
    }
  } else {
    // The structure of the result will depend upon what the Apps Script
    // function returns. Here, the function returns an Apps Script Object
    // with String keys and values, and so the result is treated as a
    // PHP array (folderSet).
    $resp = $response->getResponse();
    $folderSet = $resp['result'];
    if (count($folderSet) == 0) {
      print "No folders returned!\n";
    } else {
      print "Folders under your root folder:\n";
      foreach($folderSet as $id => $folder) {
        printf("\t%s (%s)\n", $folder, $id);
      }
    }
  }
} catch (Exception $e) {
  // The API encountered a problem before the script started executing.
  echo 'Caught exception: ', $e->getMessage(), "\n";
}