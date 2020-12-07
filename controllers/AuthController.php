<?php


namespace app\controllers;

use app\core\Controller;
use app\models\LoginModel;
use app\models\RegisterModel;
use Application;

class AuthController extends Controller
{
    // ===== AuthController is used for pages for User Login/Registration use the Spotify API on a profile =====

    /**
     * /register endpoint
     * Handles GET and POST request
     * GET produces the view page
     * POST receives registration form input
     *
     * @param $request
     * @return int|string|string[]
     */
    public function register($request)
    {
        $registerModel = new RegisterModel();

        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $registerModel->loadData($request->getBody());

            if ($registerModel->validate() && $registerModel->register())
            {
                Application::$app->session->setFlash('success', 'Thanks for registering!');
                Application::$app->response->redirect('/login');
                return 0;
            }

            return $this->render('register', [
                'model' => $registerModel
            ]);
        }

        // GET request
        // return register view
        // $this->setLayout('auth');
        return $this->render('register', [
            'model' => $registerModel
        ]);
    }

    /**
     * /login endpoint
     * Handles GET and POST request
     * GET produces the login view page
     * POST receives login form input and validates
     *
     * @param $request
     * @param $response
     * @return int|string|string[]
     */
    public function login($request, $response)
    {
        $loginForm = new LoginModel();
        if ($_POST)
        {
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $loginForm->login())
            {
                $response->redirect('/profile');
                return 0;
            }
        }
        // GET request
        // return login view
        // $this->setLayout('auth');
        return $this->render('login', [
            'model' => $loginForm
        ]);
    }

    /**
     * /logout
     * Logs out the user, calls necessary logout method to remove session
     * Redirects to home page
     *
     * @param $request
     * @param $response
     */
    public function logout($request, $response)
    {
        Application::$app->logout();
        $response->redirect('/');
    }

    /**
     * /profile
     * User profile page
     * Logged in users receive their account info and spotify account
     * Users not signed in are redirected to /login
     *
     * @param $request
     * @param $response
     * @return int|string|string[]
     */
    public function profile($request, $response)
    {
        // GET request
        // return profile view
        $params = array();

        // If not logged in, return to login page
        if (!isset($_SESSION['user']))
        {
            $response->redirect('/login');
            return 0;
        }

        $params['spotify_active'] = false;

        if (isset($_SESSION['spotify_active']) && $_SESSION['spotify_active'] == true)
        {
            $user_data = $this->getSpotifyProfile();
            if (isset($user_data['display_name']))
            {
                $params['spotify_active'] = true;
                $params['spotify_name'] = $user_data['display_name'];
                $params['spotify_followers'] = $user_data['followers']['total'];
                $params['spotify_product'] = ucfirst($user_data['product']);
                $params['spotify_account_url'] = $user_data['external_urls']['spotify'];
                $params['spotify_profile_img'] = $user_data['images'][0]['url'] ?? 'img/profile-picture.png';
            }
        }

        return $this->render('profile', $params);
    }

    /**
     * /personalized
     * If user is logged in and connected their profile with spotify
     *      Get their favourite tracks using the API
     * Else
     *      Displays our favourite tracks from a saved json file
     *
     * @param $request
     * @param $response
     * @return string|string[]
     */
    public function personalized($request, $response)
    {
        $params = array();

        $spotify_connected = isset($_SESSION['spotify_active']);
        $params['connected'] = $spotify_connected;

        if (isset($_SESSION['user']) && $spotify_connected)
        {
            // User is logged in and connected their Spotify account, use their actual data
            $params['tracks'] = $this->getTopTracks();
        }
        else
        {
            // Spotify Account not connected, use defaults
            $tracks_json = file_get_contents("../temp-json/tracks.json");
            $tracks = json_decode($tracks_json, true);
            $params['tracks'] = $tracks;
        }
        return $this->render('personalized', $params);
    }

    /**
     * /recommendations
     *
     * If user is logged in and connected to Spotify,
     *      Find their favourite artists, gets their favourite genres from artists,
     *      Then find songs using those artists and genres using Spotify API
     * Else
     *      Gets our favourite genres and artists, and finds recommendations based on them
     *
     * @param $request
     * @param $response
     * @return string|string[]
     */
    public function recommendations($request, $response)
    {
        {
            $params = array();

            // Available Genres to search by on spotify
            $avail_genres = [
                "acoustic", "afrobeat", "alt-rock", "alternative", "ambient", "anime", "black-metal", "bluegrass",
                "blues", "bossanova", "brazil", "breakbeat", "british", "cantopop", "chicago-house", "children", "chill",
                "classical", "club", "comedy", "country", "dance", "dancehall", "death-metal", "deep-house", "detroit-techno",
                "disco", "disney", "drum-and-bass", "dub", "dubstep", "edm", "electro", "electronic", "emo", "folk", "forro",
                "french", "funk", "garage", "german", "gospel", "goth", "grindcore", "groove", "grunge", "guitar",
                "happy", "hard-rock", "hardcore", "hardstyle", "heavy-metal", "hip-hop", "holidays", "honky-tonk", "house",
                "idm", "indian", "indie", "indie-pop", "industrial", "iranian", "j-dance", "j-idol", "j-pop", "j-rock",
                "jazz", "k-pop", "kids", "latin", "latino", "malay", "mandopop", "metal", "metal-misc", "metalcore",
                "minimal-techno", "movies", "mpb", "new-age", "new-release", "opera", "pagode", "party", "philippines-opm",
                "piano", "pop", "pop-film", "post-dubstep", "power-pop", "progressive-house", "psych-rock", "punk",
                "punk-rock", "r-n-b", "rainy-day", "reggae", "reggaeton", "road-trip", "rock", "rock-n-roll", "rockabilly", "romance", "sad",
                "salsa", "samba", "sertanejo", "show-tunes", "singer-songwriter", "ska", "sleep", "songwriter", "soul",
                "soundtracks", "spanish", "study", "summer", "swedish", "synth-pop", "tango", "techno", "trance", "trip-hop",
                "turkish", "work-out", "world-music"
            ];

            $spotify_connected = isset($_SESSION['spotify_active']);
            $params['connected'] = $spotify_connected;

            $params['music'] = array();

            if (isset($_SESSION['user']) && $spotify_connected)
            {
                // User is logged in and connected their Spotify account, use their actual data

                // Get their top artists
                $artists = $this->getTopArtists();

                // Using top tracks, create an array of their top genres and artist ids
                $genres = array();
                $artist_arr = array();

                foreach($artists['items'] as $artist)
                {
                    // Save artist id and name to use for artist recommendations
                    $artist_arr[$artist['id']] = $artist['name'];

                    foreach($artist['genres'] as $genre_name)
                    {
                        // Filter genres to genres that is available to search by on Spotify $avail_genres
                        $name = str_replace(' ', '-', $genre_name);
                        if (in_array($name, $avail_genres))
                        {
                            // Add to array of $genres
                            if (isset($genres[$name]))
                            {
                                $genres[$name] += 1;
                            }
                            else
                            {
                                $genres[$name] = 1;
                            }
                        }
                    }
                }

                // Sort list of genres by values
                arsort($genres);

                // Slice array to get top 4 genres and artists
                $genres = array_slice($genres, 0, 4);
                $artist_arr = array_slice($artist_arr, 0 , 4);
            }
            else
            {
                // Spotify Account not Account, use defaults genres
                $genres = array('r-n-b' => 1, 'pop' => 2, 'hip-hop' => 3, 'indie-pop' => 4);
                $artist_arr = array('3TVXtAsR1Inumwj472S9r4' => 'Drake', '0C0XlULifJtAgn6ZNCW2eu' => 'The Killers',
                    '0MeLMJJcouYXCymQSHPn8g' => 'Sleeping At Last');
            }

            $genre_tracks = array();
            $artist_tracks = array();

            // Get recommendations based on GENRES
            foreach ($genres as $gen => $amount)
            {
                $view_name = ucwords(str_replace('-', ' ', $gen));
                $genre_tracks[$view_name] = $this->getTrackRecommendations('seed_genres', $gen);
            }
            $params['music']['Genres'] = $genre_tracks;

            // Get recommendations based on ARTISTS
            foreach ($artist_arr as $art_id => $art_name)
            {
                $artist_tracks[$art_name] = $this->getTrackRecommendations('seed_artists', $art_id);
            }
            $params['music']['Artists'] = $artist_tracks;

            return $this->render('recommendations', $params);
        }
    }

    /**
     * Spotify API call to get a users favourite songs
     * User must be logged in
     *
     * @return mixed
     */
    protected function getTopTracks()
    {
        Application::$app->checkSpotifyToken();
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.spotify.com/v1/me/top/tracks',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Content-Type: application/json',
                'Authorization: Bearer ' . $_SESSION['user_token']
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true);
    }

    /**
     * Spotify API call to get a users favourite artists
     * User must be logged in
     *
     * @return mixed
     */
    protected function getTopArtists()
    {
        Application::$app->checkSpotifyToken();
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.spotify.com/v1/me/top/artists',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Content-Type: application/json',
                'Authorization: Bearer ' . $_SESSION['user_token']
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true);
    }

    /**
     * Spotify API call to get recommended songs based on $type:$value input (genres or artists: id)
     * User must be logged in
     *
     * @param $type
     * @param $value
     * @return mixed
     */
    protected function getTrackRecommendations($type, $value)
    {
        Application::$app->checkSpotifyToken();
        $curl = curl_init();

        $url = "https://api.spotify.com/v1/recommendations?" . $type . "=" . $value . "&limit=4&market=CA";
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Content-Type: application/json',
                'Authorization: Bearer ' . $_SESSION['access_token']
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true);
    }


    // ===== ===== Spotify OAuth2 ===== =====

    /**
     * Starts request to Spotify for OAuth
     * By redirecting user to authorization on Spotify
     *
     * @param $request
     * @param $response
     * @return mixed
     */
    public function spotifyAuth($request, $response)
    {
        $url      = "https://accounts.spotify.com/authorize";
        $client   = "client_id=" . Application::$app->config['client_id'];
        $resp     = "response_type=code";
        $redirect = "redirect_uri=" . Application::$app->config['client_redirect'];
        $scope    = "scope=user-read-private%20user-read-email%20user-top-read";
        $state    = "state=" . Application::$app->config['client_redirect'];;

        return $response->redirect("$url?$client&$resp&$redirect&$scope&$state");
    }

    /**
     * Callback after user logs into Spotify, user is retured to /callback
     * Requests Spotify for a user access token associated with their account
     *
     * @param $request
     * @param $response
     */
    public function spotifyCallback($request, $response)
    {
        if (isset($_GET['error']) && trim($_GET['error']) == 'access_denied')
        {
            $response->redirect('/profile');
        }

        $state = $_GET['state'] ?? '';
        if ($state == "STATE")
        {
            Application::$app->response->redirect('/error');
        }

        $code = $_GET['code'] ?? '';
        $redirect = "redirect_uri=" . Application::$app->config['client_redirect'];

        $auth = base64_encode(Application::$app->config['client_id'] . ":" .  Application::$app->config['client_secret']);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://accounts.spotify.com/api/token",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "grant_type=authorization_code&code=$code&$redirect",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Basic " . $auth,
                "Content-Type: application/x-www-form-urlencoded"
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        // Save token to session to be available on all pages
        $arr_response = json_decode($response, true);

        if (isset($arr_response['access_token']))
        {
            // Save access token to session
            $user_id = $_SESSION['user'];
            $_SESSION['user_token'] = $arr_response['access_token'];
            $_SESSION['user_token_time'] = time();
            $_SESSION['refresh_token'] = $arr_response['refresh_token'];

            // Save token to database
            Application::$app->db->connectSpotify($arr_response['refresh_token'], $user_id);
            $activated = Application::$app->db->getSpotifyConnection($user_id);

            $_SESSION['spotify_active'] = $activated['spotify_connected'] == 1;
            Application::$app->response->redirect('/profile');
            return;
        }
        Application::$app->response->redirect('/error');
    }

    /**
     * Spotify API call to get a users profile information
     * User must be logged in
     *
     * @return mixed
     */
    private function getSpotifyProfile()
    {
        Application::$app->checkSpotifyToken();
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.spotify.com/v1/me',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Content-Type: application/json',
                'Authorization: Bearer ' . $_SESSION['user_token']
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true);
    }

}
