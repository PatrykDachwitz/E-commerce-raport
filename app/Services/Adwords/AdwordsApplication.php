<?php
declare(strict_types=1);
namespace App\Services\Adwords;

abstract class AdwordsApplication
{

    protected string|array $country = '*';
    protected string|array $params = '*';
    abstract protected function getDataAdwords() : array;

    public function setCountry(string|array $country) : void
    {
        $this->country = $country;
    }

    public function setParams(string|array $params) : void
    {
        $this->params = $params;
    }
}
