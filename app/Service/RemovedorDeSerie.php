<?php

namespace App\Service;

use Illuminate\Support\Facades\DB;
use App\{Models\Episodio, Models\Temporada, Serie};

class RemovedorDeSerie
{
    public function removerSerie(int $serieId): string
    {
        DB::beginTransaction();
        $serie = Serie::find($serieId);
        $nomeSerie = $serie->nome;

        $this->removerTemporadas($serie);
        $serie->delete();
        DB::commit();

        return $nomeSerie;
    }

    private function removerTemporadas($serie): void
    {
        $serie->temporadas->each(function (Temporada $temporada) {

            $this->removerEpisodios($temporada);
            $temporada->delete();

        });

    }

    private function removerEpisodios(Temporada $temporada): void
    {
        $temporada->episodios()->each(function (Episodio $episodio) {
            $episodio->delete();
        });

    }
}
