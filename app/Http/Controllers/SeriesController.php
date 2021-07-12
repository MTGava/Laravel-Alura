<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Serie;
use App\Service\{CriadorDeSerie, RemovedorDeSerie};
use Illuminate\Http\Request;

class SeriesController extends Controller
{

    public function index(Request $request) {
        $series = Serie::query()->orderBy('nome', 'ASC')->get();
        $mensagem = $request->session()->get('mensagem');
        return view('series.index', compact('series', 'mensagem'));
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request, CriadorDeSerie $criadorDeSerie)
    {
        $serie = $criadorDeSerie->criarSerie($request->nome, $request->qtd_temporadas, $request->ep_por_temporada);
        $nomeSerie = $serie->nome;
        $request->session()->flash('mensagem', "Série \"$nomeSerie\" criada com sucesso");

        return redirect()->route('listar_series');
    }

    public function destroy(Request $request, RemovedorDeSerie $removedorDeSerie)
    {
        $nomeSerie = $removedorDeSerie->removerSerie($request->id);
        $request->session()->flash('mensagem', "Série \"$nomeSerie\" excluida com sucesso");

        return redirect()->route('listar_series');
    }

    public function editaNome(int $id, Request $request)
    {
        $novoNome = $request->nome;
        $serie = Serie::find($id);
        $serie->nome = $novoNome;
        $serie->save();
    }
}
