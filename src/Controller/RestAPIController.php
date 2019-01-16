<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Category;

class RestAPIController extends AbstractController
{
    /**
     * @Route("/v1/api/category", name="salisaApprequest")
     */
    public function getCategories(Request $request)
    {
        $apiKey = '445dcfa295847ebbb77011ab264b4aa9';
        $response = new Response();
        $allowedModels = array('Category');
        $allowedOperations = array('Read');

        if ($request->getMethod() != 'POST') {

            $response->setContent(json_encode(array('responce' => array(
                'error' => $request->getMethod() . ' is not allowed, Only POST method allowed'
            ))));

            $response->setStatusCode(JsonResponse::HTTP_BAD_REQUEST);
            goto result;
        }
        $errors = array();
        if ($content = $request->getContent()) {
            $requestContent = json_decode($request->getContent(), true);
        }

        if (empty($requestContent)) {
            $errors['error'] = 'No request body content';
            $response->setStatusCode(JsonResponse::HTTP_BAD_REQUEST);
            $response->setContent(json_encode(array('responce' => $errors)));
            goto result;
        }

        if (empty($requestContent['ApiKey']) || $requestContent['ApiKey'] != $apiKey) {
            $errors['error'] = 'Invalid API key';
            $response->setStatusCode(JsonResponse::HTTP_BAD_REQUEST);
            $response->setContent(json_encode(array('responce' => $errors)));
            goto result;
        }
        //dump(in_array($requestContent['Model'],$allowedModels)); die;

        if (empty($requestContent['Command']) || !in_array($requestContent['Command'], $allowedOperations)) {
            $errors['error'] = $requestContent['Command'] . ' - Command is not supporting';
            $response->setStatusCode(JsonResponse::HTTP_BAD_REQUEST);
            $response->setContent(json_encode(array('responce' => $errors)));
            goto result;
        }

        if (empty($requestContent['Model']) || !in_array($requestContent['Model'], $allowedModels)) {
            $errors['error'] = $requestContent['Model'] . ' - model is not supporting';
            $response->setStatusCode(JsonResponse::HTTP_BAD_REQUEST);
            $response->setContent(json_encode(array('responce' => $errors)));
            goto result;
        }

        $parent = 0;
        if (isset($requestContent['ViewData']['Fieldset'])) {
            $parent = $requestContent['ViewData']['Fieldset']['parent'];
        }
        $page = 1;
        $limit = 1000;
        if (isset($requestContent['ViewData']['SearchPaging'])) {
            $page = $requestContent['ViewData']['SearchPaging']['Offset'];
            $limit = $requestContent['ViewData']['SearchPaging']['Limit'];
        }

        $categories = $this->getDoctrine()->getRepository(Category::class)->findAllCategory($parent, $page, $limit);

        $response->setContent(json_encode(array('responce' => array(
            'data' => $categories
        ))));

        $response->headers->set('Content-Type', 'application/json');
        $response->setStatusCode(JsonResponse::HTTP_OK);

        return $response;

        result:
        return $response;
    }
}
