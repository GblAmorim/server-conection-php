<?php

namespace App\Services;

include '../App/Models/Pokemon.php';

use App\Models\Pokemon;

class PokemonService
{
    public function get($pokemonName = null)
    {
        if ($pokemonName) {
            $pokemonData = Pokemon::getPokemonByName($pokemonName);

            return Pokemon::adaptPokemon($pokemonData);
        } else {
            throw new \Exception("Pokémon não encontrato");
        }
    }
}
