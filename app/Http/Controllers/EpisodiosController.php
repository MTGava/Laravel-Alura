<?php

namespace App\Http\Controllers;

use App\Models\Episodio;
use App\Models\Temporada;
use App\Serie;
use Illuminate\Http\Request;

class EpisodiosController extends Controller
{

    public function index(Temporada $temporada, Request $request)
    {
        $episodios = $temporada->episodios;
        $temporadaId = $temporada->id;
        $temporadaNumero = $temporada->numero;
        $mensagem = $request->session()->get('mensagem');
        return view('episodios.index', compact('episodios', 'temporadaId', 'temporadaNumero','mensagem'));
    }

    public function assistir(Temporada $temporada, Request $request)
    {
        $episodiosAssistidos = $request->episodios;
        $temporada->episodios->each(function (Episodio $episodio) use ($episodiosAssistidos) {
            $episodio->assistido = in_array($episodio->id, $episodiosAssistidos);
        });

        $temporada->push();
        $request->session()->flash('mensagem', 'Episódios marcados como assistidos');

        return redirect()->back();
    }

}
