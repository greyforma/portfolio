<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Google_Client;
use Google_Service_Calendar;

class CalendarController extends Controller
{
    /**
     * @Route("/calendar", name="calendar")
     */
    public function index()
    {


        //Build the client object
        $client = new Google_Client();
        $client->setAuthConfig('../.certificates/client_secret.json');
        $client->addScope('Google_Service_Calendar'::CALENDAR);


        define('APPLICATION_NAME', 'Pi calendars by ALD');
        define('CREDENTIALS_PATH', __DIR__ . '/credentials/calendar-php-quickstart.json');
        define('CLIENT_SECRET_PATH', __DIR__ . '/credentials/client_secret.json');
        // If modifying these scopes, delete your previously saved credentials
        // at __DIR__ . '/credentials/calendar-php-quickstart.json
        define('SCOPES', implode(' ', array(
          Google_Service_Calendar::CALENDAR) // CALENDAR_READONLY
));



// if (php_sapi_name() != 'cli') {
//   throw new Exception('This application must be run on the command line.');
// }

// data for the function
$title = "19.8°C chez Pi Nautilus";
$cal_id = "parcours-performance.com_CCCC@group.calendar.google.com" ;

$create_event = al_pi_create_quick_event( $title, $cal_id ) ;
echo "event ID : " . $create_event . "\r\n" ;


function al_pi_create_quick_event( $title, $cal_id ) {

	// Get the API client and construct the service object.
	$client = getClient();
	$service = new Google_Service_Calendar($client);

	// https://developers.google.com/google-apps/calendar/v3/reference/events/quickAdd

	$optParams = Array(
			'sendNotifications' => true,
	);

	$createdEvent = $service->events->quickAdd(
		$cal_id,
		$title,
		$optParams
	);

	return $createdEvent->getId();

}

/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
function getClient() {
  $client = new Google_Client();
  $client->setApplicationName(APPLICATION_NAME);
  $client->setScopes(SCOPES);
  $client->setAuthConfig(CLIENT_SECRET_PATH);
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
    $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);

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
    $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
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

    //     } else {
    //         return redirect('/oauth');
    //     }
    //
    //
    // public function oauth()
    // {
    //     $rul = action('CalendarController@auth');
    //     $client = new Google_Client();
    //     $client->setAuthConfigFile('../client_secret.json');
    //     $client->setRedirectUri($url);
    //     $client->addScope(Google_Service_Calendar::CALENDAR);
    //
    //
    //     if (!isset($_GET['code'])) {
    //         $auth_url = $client->createAuthUrl();
    //         $filtred_url = filter_var($auth_url, FILTER_SANITIZE_URL);
    //         return redirect($filtered_url);
    //     } else {
    //         $client->authenticate($_GET['code']);
    //         $_SESSION['access_token'] = $client->getAccessToken();
    //         returl redirect('/cal');
    //     }
    //
    // }

        return $this->render('calendar/calendar.html.twig', [
            'controller_name' => 'CalendarController',
        ]);
    }
}
