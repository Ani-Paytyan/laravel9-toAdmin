<?php

namespace App\Http\Controllers;

use App\Dto\Antena\AntenaRequestDto;
use App\Dto\Response\MessageDto;
use App\Http\Requests\AntenaRequest;
use App\Models\Antena;
use App\Services\Antena\AntenaServiceInterface;

class AntenaController extends Controller
{
    public AntenaServiceInterface $antenaService;

    public function __construct(AntenaServiceInterface $antenaService)
    {
        $this->antenaService = $antenaService;
    }

    public function index()
    {
        $antenas = Antena::with('manufactureType')->paginate(AntenaRequestDto::PAGE);
        return view('antena.index', compact('antenas'));
    }

    public function create()
    {
        return view('antena.create');
    }

    public function store(AntenaRequest $request)
    {
        $this->antenaService->addAntena(AntenaRequestDto::createRequest($request->all()));

        return redirect('antena')->with([
            'message' => new MessageDto(
                trans('message.antena.success_message'),
                MessageDto::TYPE_SUCCESS
            ),
        ]);
    }

    public function show(Antena $antena)
    {
        return view('antena.show', compact('antena'));
    }

    public function edit(Antena $antena)
    {
        return view('antena.edit', compact('antena'));
    }

    public function update(AntenaRequest $request, Antena $antena)
    {
        $this->antenaService->updateAntena(AntenaRequestDto::createRequest($request->all()), $antena);

        return redirect('antena')->with([
            'message' => new MessageDto(
                trans('message.antena.success_message'),
                MessageDto::TYPE_SUCCESS
            ),
        ]);
    }

    public function destroy(Antena $antena)
    {
        $this->antenaService->deleteAntena($antena);

        return redirect('antena')->with([
            'message' => new MessageDto(
                trans('message.antena.success_message'),
                MessageDto::TYPE_SUCCESS
            ),
        ]);
    }
}
