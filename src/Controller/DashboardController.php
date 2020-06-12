<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Model\Spotify;

class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $spotify = new Spotify();
        $releases = $spotify->getReleases();

        return $this->render('dashboard/index.html.twig', [
            'title' => 'Nuevos Lanzamientos',
            'releases' => $releases,
        ]);
    }

    /**
     * @Route("/artist/{id}", name="artist", methods={"GET"})
     */
    public function artist(string $id){
        $spotify = new Spotify();
        $artist = $spotify->getArtist($id);

        return $this->render('dashboard/artist.html.twig',[
            'title' => 'Artista',
            'artist' => $artist
        ]);
    }
}
