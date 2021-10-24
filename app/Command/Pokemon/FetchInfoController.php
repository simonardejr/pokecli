<?php

namespace App\Command\Pokemon;

use Minicli\Command\CommandController;
use Minicli\Output\Filter\ColorOutputFilter;
use Minicli\Output\Helper\TableHelper;

class FetchInfoController extends CommandController
{
    public $baseApi = 'https://pokeapi.co/api/v2';

    public function handle()
    {
        if( empty($this->hasParam('name')) ) {
            $this->getPrinter()->error("Please, inform the name of Pokemon you want to fetch info.");
            $this->getPrinter()->error("Usage: ./minicli pokemon fetchinfo name=\"bulbasaur\"");
            return;
        }

        $name = $this->getParam('name');

        $this->getPrinter()->display('Showing info about ' . $name);

        $this->fetchPokemonInfo($name);

    }

    public function fetchPokemonInfo($name)
    {
        $pokemonInfo = $this->get($this->baseApi . '/pokemon/' . $name);

        $this->printPokemonTableInfo($pokemonInfo);
    }

    public function printPokemonTableInfo($info)
    {
        $info = json_decode($info, true);

        $table = new TableHelper();
        
        $table->addHeader(['Name', 'Height', 'Weight']);
        $table->addRow([ucfirst($info['name']), $info['height'], $info['weight']]);

        $table->addHeader(['Type', '', '']);

        array_map(function($item) use ($table) {
            $table->addRow([$item['type']['name']]);
        }, $info['types']);

        $table->addHeader(['Moves', '', '']);

        array_map(function($item) use ($table) {
            $table->addRow([str_replace('-', ' ', $item['move']['name'])]);
        }, $info['moves']);

        // $this->getPrinter()->newline();
        $this->getPrinter()->rawOutput($table->getFormattedTable(new ColorOutputFilter()));
        $this->getPrinter()->newline();
    }

    public function get($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}