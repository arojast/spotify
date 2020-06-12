<?php

namespace App\Model;

class Spotify {

    private $token;
    private $api;

    public function __construct(){
        $session = new \SpotifyWebAPI\Session(
            'cb23aa4bf05f49c9ae5b9ead07a9b60e',
            'e8de016359c6446da79724e00a1ff062',
            'localhost'
        );
        $session->requestCredentialsToken();
        //conexion a api
        $this->api = new \SpotifyWebAPI\SpotifyWebAPI();
        $this->token = $session->getAccessToken();
        $this->api->setAccessToken($this->token);
    }

    public function getToken(){
        return $this->token;
    }

    /**
     * @return releases object
    */
    public function getReleases(){
        $releases = $this->api->getNewReleases();
        return $releases->albums->items;
    }

    /** 
     * @params id string id artista spotify
     * @return artist object devuleve objeto artista con las canciones mas escuchadas por pais
    */
    public function getArtist($id){
        $artist = $this->api->getArtist($id);
        $tracks = $this->api->getArtistTopTracks($id,[
            'country' => 'co'
        ]);
        $artist->tracks = $tracks->tracks;

        return $artist;
    }
    
}
