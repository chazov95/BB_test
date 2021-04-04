<?php


namespace App\Controllers;


use App\Services\BankRequestService;
use App\Utils\Request;
use App\Utils\Validator;

class FormController
{
    public function addBankRequest(Request $request): array
    {
        $product = $request->get('product');
        $client = $request->get('client');

        $productValidateResult = Validator::validateProductData($product);

        if (is_array($productValidateResult)) {
            return $productValidateResult;
        }

        $clientValidateResult = Validator::validateClientData($client);

        if (is_array($clientValidateResult)) {
            return $clientValidateResult;
        }
        $bankRequestService = new BankRequestService();
        $newClient = $bankRequestService->saveBankRequest($request);

        if ($newClient === null) {
            return ['ошибка при сохранении'];
        }

        return $bankRequestService->calculateProduct($newClient);
    }
}
