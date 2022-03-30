<?php

namespace App\Models;

use \stdClass;

class Pokemon
{
    public static function getPokemonByName(string $pokemonName)
    {
        $url = 'https://pokeapi.co/api/v2/pokemon/' . $pokemonName;

        $response = file_get_contents($url);

        if ($response !== false) {
            return $response;
        } else {
            throw new \Exception("Pokémon não encontrato");
        }
    }

    public static function adaptPokemon($pokemonData)
    {
        $decodedData = json_decode($pokemonData);

        $pokemonObj = new stdClass();
        $pokemonObj->name = $decodedData->name;
        $pokemonObj->order = $decodedData->order;
        $pokemonObj->height = $decodedData->height;
        $pokemonObj->weight = $decodedData->weight;
        $pokemonObj->img_front = $decodedData->sprites->front_default;
        $pokemonObj->img_back = $decodedData->sprites->back_default;

        $dirtyAbilities = $decodedData->abilities;
        $cleanAbilities = [];
        foreach ($dirtyAbilities as $ability) {
            array_push($cleanAbilities, $ability->ability->name);
        }
        $pokemonObj->abilities = $cleanAbilities;
        sort($pokemonObj->abilities);

        $dirtyTypes = $decodedData->types;
        $cleanTypes = [];
        foreach ($dirtyTypes as $type) {
            array_push($cleanTypes, $type->type->name);
        }
        $pokemonObj->types = $cleanTypes;


        return $pokemonObj;
    }
}
