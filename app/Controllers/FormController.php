<?php


namespace App\Controllers;


use App\Services\BankRequestService;
use App\Utils\Request;
use App\Utils\Validator;

/**
 * Class FormController
 * @package App\Controllers
 */
class FormController
{
    /**
     * @param Request $request
     * @return array|string[]
     */
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

        return ['Заявка оформлена'];
        //TODO возвращать посчитанные данные, когда будет реализован метод calculateProduct()
        /*return $bankRequestService->calculateProduct($newClient);*/
    }
}
