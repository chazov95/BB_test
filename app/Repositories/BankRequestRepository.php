<?php


namespace App\Repositories;


use App\Models\Client;
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

        $query = "INSERT INTO clients (name,inn,type)
                        VALUES(
                            '$client->name',
                            $client->inn,
                            '$client->type'
                        )";
        $query .= "SELECT MAX(id) FROM clients";

        $db = new BankRequestRepository();

        if ($client->type === 'natural') {
            $quer = "INSERT INTO clients_natural
                        (client_id,birthday,passSeries,passNumber,passDate)
                        VALUES(
                            20,
                            '$client->birthday',
                            $client->passSeries,
                            $client->passNumber,
                            '$client->passDate')";

            /*$db->connect()->query($query);*/
            /*$db->connect()->query($queryNewClient);*/



        }
        echo '<pre>';

$db->connect()->begin_transaction();
        var_dump($db->connect()->multi_query($query));
        $db->connect()->commit();
        echo '</pre>';
        die();

        if ($client->type === 'legal') {
            $query = "BEGIN;
                        INSERT INTO clients (name,inn,type)
                        VALUES(
                            '$client->name',
                            $client->inn,
                            '$client->type'
                        );
                        INSERT INTO clients_natural 
                        (client_id,address,ogrn,kpp,directorInn,directorName)
                        VALUES(
                            LAST_INSERT_ID(),
                            '$client->address',
                            $client->ogrn,
                            $client->kpp,
                            $client->directorInn,
                            '$client->directorName');
                        COMMIT";
            $clientId = $clientData->client->id = $db->connect()->query($query)->fetch_object()->id;
        }

        if ($product->type === 'credit' && !empty($clientId)) {
            $query = "BEGIN;
                        INSERT INTO products (client_id,dataOpen,dataClose,month,type)
                        VALUES(
                            $clientId,
                            '$product->dataOpen',
                            '$product->dataClose',
                            $product->month,
                            '$product->type');
                        INSERT INTO credits (product_id, summ)
                        VALUES (LAST_INSERT_ID(),
                                $product->summ);
                        COMMIT";
            $db->connect()->query($query);

        }

        if ($product->type === 'deposit' && !empty($clientId)) {
            $query = "BEGIN;
                        INSERT INTO products (client_id,dataOpen,dataClose,month,type)
                        VALUES(
                            $clientId,
                            '$product->dataOpen',
                            '$product->dataClose',
                            $product->month,
                            '$product->type');
                        INSERT INTO deposits
                        (product_id, rate,capitalization)
                        VALUES (LAST_INSERT_ID(),
                                $product->rate,
                                $product->capitalization);
                        COMMIT";
            $db->connect()->query($query);
        }

        return $clientData;
    }
}
