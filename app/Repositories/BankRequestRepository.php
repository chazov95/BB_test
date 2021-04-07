<?php


namespace App\Repositories;


use App\Models\ClientData;

class BankRequestRepository extends AbstractRepository
{
    /**
     * @param ClientData $clientData
     */
    public function saveNewBankRequest(ClientData $clientData)
    {
        $product = $clientData->product;
        $client = $clientData->client;


        $queryClient = "INSERT INTO clients (name,inn,type)
                        VALUES(
                            '$client->name',
                            $client->inn,
                            '$client->type'
                        )";

        $db = $this->connect();
        $db->begin_transaction();
        $db->query($queryClient);
        $clientId = $db->insert_id;


        if ($client->type === 'natural') {
            $queryClientType = "INSERT INTO clients_natural
                        (client_id,birthday,passSeries,passNumber,passDate)
                        VALUES(
                            $clientId,
                            '$client->birthday',
                            $client->passSeries,
                            $client->passNumber,
                            '$client->passDate')";

        }

        if ($client->type === 'legal') {
            $queryClientType = "INSERT INTO clients_legal
                        (client_id,address,ogrn,kpp,directorInn,directorName)
                        VALUES(
                            $clientId,
                            '$client->address',
                            $client->ogrn,
                            $client->kpp,
                            $client->directorInn,
                            '$client->directorName')";
        }

        $queryProduct = "INSERT INTO products (client_id,dataOpen,dataClose,month,type)
                        VALUES(
                            $clientId,
                            '$product->dataOpen',
                            '$product->dataClose',
                            $product->month,
                            '$product->type')";

        $db->query($queryProduct);
        $productId = $db->insert_id;

        if ($product->type === 'credit' && !empty($clientId)) {
            $queryProductType = "INSERT INTO credits (product_id, summ)
                        VALUES ($productId,
                                $product->summ);
                        ";

        }

        if ($product->type === 'deposit' && !empty($clientId)) {
            $queryProductType = "INSERT INTO deposits
                        (product_id, rate,capitalization)
                        VALUES (LAST_INSERT_ID(),
                                $product->rate,
                                $product->capitalization);
                        ";

        }

        $db->query($queryClientType);
        $db->query($queryProductType);
        $db->commit();

        return $clientData;
    }
}
