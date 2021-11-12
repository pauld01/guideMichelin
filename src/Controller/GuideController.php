<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;

class GuideController {
    public function accueil() {
        return new Response("Bonjour : Guide Michelin .. trouvez un restaurant");
    }
}
