<?php

namespace App\Controller;

use Revel\Revel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RevelSyncController extends AbstractController
{
    /**
     * @Route("/revel_sync", name="revelApi")
     */
    public function revelSync()
    {
        $revel = new Revel('trustangle',
            '895ac1f180454bc5bc13986c07aa178212940546ba0f4241b4b24aceaf4e6a69',
            'cfaa87ae4a4a446ca253668b63f4e96f');
        //echo "<pre>";

        // Get all products.
        $products = $revel->modifiers()->all();
        echo '<pre>';
        dump($products);
        die;

        // Get an establishment.
        //$establishment = $revel->establishments()->findById(1);
    }
}
