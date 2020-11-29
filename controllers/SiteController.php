<?php

namespace app\controllers;

use app\core\Controller;

class SiteController extends Controller
{
    public function home()
    {
        $data = "Spotify";
        $params = [
            'title' => 'Home',
            'song' => 'Song1',
            'songTitle' => $data
        ];
        return $this->render('home', $params);
    }

    public function about()
    {
        return $this->render('about');
    }

    public function team()
    {
        return $this->render('team');
    }

    public function midi()
    {
        return $this->render('midi');
    }

    public function personalized()
    {
        $tracks = '{
            "items" : [ 
                {
                    "external_urls" : {
                        "spotify" : "https://open.spotify.com/artist/0I2XqVXqHScXjHhk6AYYRe"
                    },
                    "followers" : {
                        "href" : null,
                      "total" : 7753
                    },
                    "genres" : [ "swedish hip hop" ],
                    "href" : "https://api.spotify.com/v1/artists/0I2XqVXqHScXjHhk6AYYRe",
                    "id" : "0I2XqVXqHScXjHhk6AYYRe",
                    "images" : [ {
                        "height" : 640,
                      "url" : "https://i.scdn.co/image/2c8c0cea05bf3d3c070b7498d8d0b957c4cdec20",
                      "width" : 640
                    }, {
                        "height" : 300,
                      "url" : "https://i.scdn.co/image/394302b42c4b894786943e028cdd46d7baaa29b7",
                      "width" : 300
                    }, {
                        "height" : 64,
                      "url" : "https://i.scdn.co/image/ca9df7225ade6e5dfc62e7076709ca3409a7cbbf",
                      "width" : 64
                    } ],
                    "name" : "Afasi & Filthy",
                    "popularity" : 54,
                    "type" : "artist",
                    "uri" : "spotify:artist:0I2XqVXqHScXjHhk6AYYRe"
                },
                {
                    "external_urls":{"spotify":"https://open.spotify.com/artist/0I2XqVXqHScXjHhk6AYYRe"},
                    "followers":{"href":null,"total":7753},
                    "genres":["swedishhiphop"],
                    "href":"https://api.spotify.com/v1/artists/0I2XqVXqHScXjHhk6AYYRe",
                    "id":"0I2XqVXqHScXjHhk6AYYRe",
                    "images":[{"height":640,"url":"https://i.scdn.co/image/2c8c0cea05bf3d3c070b7498d8d0b957c4cdec20","width":640},{
                    "height":300,"url":"https://i.scdn.co/image/394302b42c4b894786943e028cdd46d7baaa29b7","width":300},{
                    "height":64,"url":"https://i.scdn.co/image/ca9df7225ade6e5dfc62e7076709ca3409a7cbbf","width":64}],
                    "name":"Afasi&Filthy","popularity":54,"type":"artist","uri":"spotify:artist:0I2XqVXqHScXjHhk6AYYRe"
                },
                {
                    "external_urls":{"spotify":"https://open.spotify.com/artist/0I2XqVXqHScXjHhk6AYYRe"},
                    "followers":{"href":null,"total":7753},
                    "genres":["swedishhiphop"],
                    "href":"https://api.spotify.com/v1/artists/0I2XqVXqHScXjHhk6AYYRe",
                    "id":"0I2XqVXqHScXjHhk6AYYRe",
                    "images":[{"height":640,"url":"https://i.scdn.co/image/2c8c0cea05bf3d3c070b7498d8d0b957c4cdec20","width":640},{
                    "height":300,"url":"https://i.scdn.co/image/394302b42c4b894786943e028cdd46d7baaa29b7","width":300},{
                    "height":64,"url":"https://i.scdn.co/image/ca9df7225ade6e5dfc62e7076709ca3409a7cbbf","width":64}],
                    "name":"Afasi&Filthy","popularity":54,"type":"artist","uri":"spotify:artist:0I2XqVXqHScXjHhk6AYYRe"
                },
                {
                    "external_urls":{"spotify":"https://open.spotify.com/artist/0I2XqVXqHScXjHhk6AYYRe"},
                    "followers":{"href":null,"total":7753},
                    "genres":["swedishhiphop"],
                    "href":"https://api.spotify.com/v1/artists/0I2XqVXqHScXjHhk6AYYRe",
                    "id":"0I2XqVXqHScXjHhk6AYYRe",
                    "images":[{"height":640,"url":"https://i.scdn.co/image/2c8c0cea05bf3d3c070b7498d8d0b957c4cdec20","width":640},{
                    "height":300,"url":"https://i.scdn.co/image/394302b42c4b894786943e028cdd46d7baaa29b7","width":300},{
                    "height":64,"url":"https://i.scdn.co/image/ca9df7225ade6e5dfc62e7076709ca3409a7cbbf","width":64}],
                    "name":"Afasi&Filthy","popularity":54,"type":"artist","uri":"spotify:artist:0I2XqVXqHScXjHhk6AYYRe"
                },
                {
                    "external_urls":{"spotify":"https://open.spotify.com/artist/0I2XqVXqHScXjHhk6AYYRe"},
                    "followers":{"href":null,"total":7753},
                    "genres":["swedishhiphop"],
                    "href":"https://api.spotify.com/v1/artists/0I2XqVXqHScXjHhk6AYYRe",
                    "id":"0I2XqVXqHScXjHhk6AYYRe",
                    "images":[{"height":640,"url":"https://i.scdn.co/image/2c8c0cea05bf3d3c070b7498d8d0b957c4cdec20","width":640},{
                    "height":300,"url":"https://i.scdn.co/image/394302b42c4b894786943e028cdd46d7baaa29b7","width":300},{
                    "height":64,"url":"https://i.scdn.co/image/ca9df7225ade6e5dfc62e7076709ca3409a7cbbf","width":64}],
                    "name":"Afasi&Filthy","popularity":54,"type":"artist","uri":"spotify:artist:0I2XqVXqHScXjHhk6AYYRe"
                },
                {
                    "external_urls":{"spotify":"https://open.spotify.com/artist/0I2XqVXqHScXjHhk6AYYRe"},
                    "followers":{"href":null,"total":7753},
                    "genres":["swedishhiphop"],
                    "href":"https://api.spotify.com/v1/artists/0I2XqVXqHScXjHhk6AYYRe",
                    "id":"0I2XqVXqHScXjHhk6AYYRe",
                    "images":[{"height":640,"url":"https://i.scdn.co/image/2c8c0cea05bf3d3c070b7498d8d0b957c4cdec20","width":640},{
                    "height":300,"url":"https://i.scdn.co/image/394302b42c4b894786943e028cdd46d7baaa29b7","width":300},{
                    "height":64,"url":"https://i.scdn.co/image/ca9df7225ade6e5dfc62e7076709ca3409a7cbbf","width":64}],
                    "name":"Afasi&Filthy","popularity":54,"type":"artist","uri":"spotify:artist:0I2XqVXqHScXjHhk6AYYRe"
                },
                {
                    "external_urls":{"spotify":"https://open.spotify.com/artist/0I2XqVXqHScXjHhk6AYYRe"},
                    "followers":{"href":null,"total":7753},
                    "genres":["swedishhiphop"],
                    "href":"https://api.spotify.com/v1/artists/0I2XqVXqHScXjHhk6AYYRe",
                    "id":"0I2XqVXqHScXjHhk6AYYRe",
                    "images":[{"height":640,"url":"https://i.scdn.co/image/2c8c0cea05bf3d3c070b7498d8d0b957c4cdec20","width":640},{
                    "height":300,"url":"https://i.scdn.co/image/394302b42c4b894786943e028cdd46d7baaa29b7","width":300},{
                    "height":64,"url":"https://i.scdn.co/image/ca9df7225ade6e5dfc62e7076709ca3409a7cbbf","width":64}],
                    "name":"Afasi&Filthy","popularity":54,"type":"artist","uri":"spotify:artist:0I2XqVXqHScXjHhk6AYYRe"
                }
            ],
            "next" : "https://api.spotify.com/v1/me/top/artists?offset=20",
            "previous" : null,
            "total" : 50,
            "limit" : 20,
            "href" : "https://api.spotify.com/v1/me/top/artists"
        }';
        $encoded_data = json_encode($tracks);
        $decoded_data = json_decode($encoded_data, true);
        $params = [
            'tracks' => $tracks
        ];

        return $this->render('personalized', $params);
    }

    public function contact()
    {
        return $this->render('contact');
    }

    public function handleContact($request)
    {
        $body = $request->getBody();
        var_dump($body);
        return 'Handling Content';
    }
}
