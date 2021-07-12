<?php

namespace App\Service;

use App\Serie;
use Illuminate\Support\Facades\DB;

class CriadorDeSerie
{
    public function criarSerie(string $nomeSerie, int $qtdTemporada, int $epPorTemporada) : Serie
    {
        DB::beginTransaction();
        $serie = Serie::create(['nome' => $nomeSerie]);
        $this->criaTemporadas($qtdTemporada, $serie, $epPorTemporada);
        DB::commit();

        return $serie;
    }

    private function criaTemporadas(int $qtdTemporada, $serie, int $epPorTemporada): void
    {
        for ($i = 1; $i <= $qtdTemporada; $i++) {
            $temporada = $serie->temporadas()->create(['numero' => $i]);

            $this->criaEpisodios($epPorTemporada, $temporada);
        }
    }

    private function criaEpisodios(int $epPorTemporada, $temporada): void
    {
        for ($j = 1; $j <= $epPorTemporada; $j++) {
            $temporada->episodios()->create(['numero' => $j]);
        }
    }
}
