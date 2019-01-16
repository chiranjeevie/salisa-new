<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use ApiPlatform\Core\Annotation\ApiResource;


class DummyDataDumpController extends AbstractController
{
    /**
     * @Route("/dumpDummyData", name="dumpDummyData")
     */
    public function dumpDummyData()
    {
        echo "";
    }
}
