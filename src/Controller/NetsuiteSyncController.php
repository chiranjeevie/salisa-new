<?php

namespace App\Controller;

use Revel\Revel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use NetSuite\NetSuiteService;
use NetSuite\Classes\GetRequest;
use NetSuite\Classes\RecordRef;
use NetSuite\Classes\Customer;
use NetSuite\Classes\AddRequest;

class NetsuiteSyncController extends AbstractController
{
    /**
     * @Route("/netsuite_sync", name="netSuiteApi")
     */
    public function netSuiteSync()
    {
        $config = array(
            // required -------------------------------------
            'endpoint' => '2017_1',
            'host' => 'https://webservices.netsuite.com',
            'account' => 'TSTDRV1896181',
            'consumerKey' => '68e6c3b5355723e2f73b675c438494d7128146757d8093026ac533ecffa26c7b',
            'consumerSecret' => '68cfed56ed591c7d57c9ae30e36dfa581a1224352d3d8365b3de0d0487a9bcf5',
            'token' => 'de12ca124d0ab4ba2cc469f620d711fbd850d322404d9ae08bdffb3e910637f9',
            'tokenSecret' => '67826897e102c68e9d0dcec4efcbf0e36122cf674079e7a7a92fb6e2c3222a66',
            // optional -------------------------------------
            'signatureAlgorithm' => 'sha256', // Defaults to 'sha256'
        );

        $service = new NetSuiteService($config);

        $request = new GetRequest();
        $request->baseRef = new RecordRef();
        $request->baseRef->internalId = '1';
        $request->baseRef->type = 'account';

        $getResponse = $service->get($request);

        if (!$getResponse->readResponse->status->isSuccess) {
            echo '<pre>';
            dump($getResponse->readResponse);
        } else {
            $customer = $getResponse->readResponse->record;
            echo '<pre>';
            dump($customer);
        }

        /*$customer = new Customer();
        $customer->lastName = "Doe";
        $customer->firstName = "John";
        $customer->companyName = "ABC company";
        $customer->phone = "123456789";
        $customer->email = "joe.doe@abc.com";

        $customer->customForm = new RecordRef();
        $customer->customForm->internalId = -8;

        $request = new AddRequest();
        $request->record = $customer;

        $addResponse = $service->add($request);

        if (!$addResponse->writeResponse->status->isSuccess) {
            echo "<pre>";
            print_r($addResponse->writeResponse);
        } else {
            echo "ADD SUCCESS, id " . $addResponse->writeResponse->baseRef->internalId;
        }*/

        die;
        $revel = new Revel('domain', 'secret', 'key');
        // Get all products.
        $products = $revel->products()->all();
        echo '<pre>';
        print_r($products);
        die;

        // Get an establishment.
        //$establishment = $revel->establishments()->findById(1);
    }
}
