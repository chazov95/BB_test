<?php


namespace App\Utils;


class Validator
{
    public static function validateCreditData(array $product): array
    {
        //TODO реализовать проверку не только на пустоту, при более конкретных требованиях к валидации
        $errors = [];

        foreach ($product as $key => $field) {
            if (empty($field)) {
                $errors[] = "не заполненно поле $key";
            }
        }

        return $errors;
    }

    /**
     * @param $product
     * @return array
     */
    public static function validateDepositData(array $product): array
    {
        //TODO
        return self::validateCreditData($product);
    }

    /**
     * @param array $client
     * @return array
     */
    public static function validateNaturalData(array $client): array
    {
        //TODO
        return self::validateCreditData($client);
    }

    /**
     * @param array $client
     * @return array
     */
    public static function validateLegalData(array $client): array
    {
        //TODO
        return self::validateCreditData($client);
    }

    /**
     * @param array $product
     * @return string[]|null
     */
    public static function validateProductData(array $product): ?array
    {
        $errors = [];

        if (!isset($product['type'])) {
            return ['не выбран тип продукта'];
        }

        switch ($product['type']) {
            case $product['type'] === 'credit':
                $errors = array_merge($errors, self::validateCreditData($product));
                break;
            case $product['type'] === 'deposit':
                $errors = array_merge($errors, self::validateDepositData($product));
                break;
            default:
                return ['не выбран тип продукта'];
        }

        if (count($errors) > 0) {
            return $errors;
        }

        return null;
    }

    /**
     * @param array $client
     * @return string[]|null
     */
    public static function validateClientData(array $client): ?array
    {
        $errors = [];

        if (!isset($client['type'])) {
            return ['тип клиента не выбран'];
        }

        switch ($client['type']) {
            case $client['type'] === 'natural':
                $errors = array_merge($errors, self::validateNaturalData($client));
                break;
            case $client['type'] === 'legal':
                $errors = array_merge($errors, self::validateLegalData($client));
                break;
            default:
                return ['тип клиента не выбран'];
        }

        if (count($errors) > 0) {
            return $errors;
        }

        return null;
    }
}
