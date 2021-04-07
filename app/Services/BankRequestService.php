<?php


namespace App\Services;


use App\Models\LegalClient;
use App\Models\ClientData;
use App\Models\Credit;
use App\Models\Deposit;
use App\Models\NaturalClient;
use App\Repositories\BankRequestRepository;
use App\Utils\Request;

/**
 * Class BankRequestService
 * @package App\Services
 */
class BankRequestService
{
    /**
     * @param Request $request
     * @return ClientData|null
     */
    public function saveBankRequest(Request $request): ?ClientData
    {
        $clientData = new ClientData();
        $product = $request->get('product');
        $client = $request->get('client');

        if ($client['type'] === 'natural') {
            $clientData->client = new NaturalClient();
            $clientData->client->name = $client['name'];
            $clientData->client->type = $client['type'];
            $clientData->client->inn = $client['inn'];
            $clientData->client->birthday = $client['birthday'];
            $clientData->client->passSeries = $client['passSeries'];
            $clientData->client->passNumber = $client['passNumber'];
            $clientData->client->passDate = $client['passDate'];
        }

        if ($client['type'] === 'legal') {
            $clientData->client = new LegalClient();
            $clientData->client->name = $client['name'];
            $clientData->client->type = $client['type'];
            $clientData->client->inn = $client['INN'];
            $clientData->client->address = $client['address'];
            $clientData->client->ogrn = $client['ogrn'];
            $clientData->client->kpp = $client['kpp'];
            $clientData->client->directorName = $client['directorName'];
            $clientData->client->directorInn = $client['directorInn'];

        }
        if ($product['type'] === 'credit') {
            $clientData->product = new Credit();
            $clientData->product->type = $product['type'];
            $clientData->product->dataOpen = $product['dataOpen'];
            $clientData->product->dataClose = $product['dataClose'];
            $clientData->product->month = $product['month'];
            $clientData->product->summ = $product['summ'];
        }
        if ($product['type'] === 'deposit') {
            $clientData->product = new Deposit();
            $clientData->product->type = $product['type'];
            $clientData->product->dataOpen = $product['dataOpen'];
            $clientData->product->dataClose = $product['dataClose'];
            $clientData->product->month = $product['month'];
            $clientData->product->rate = $product['rate'];
            $clientData->product->capitalization = $product['capitalization'];
        }

        $repository = new BankRequestRepository();
        $repository->saveNewBankRequest($clientData);

        return $clientData;
    }

    public function calculateProduct(ClientData $newClient)
    {
        //TODO метод для проведения расчетов
    }
}
