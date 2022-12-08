<?php

namespace App\Http\Controllers;

use App\Dto\Antena\AntenaRequestDto;
use App\Dto\Response\MessageDto;
use App\Http\Requests\AntenaRequest;
use App\Http\Requests\AntenaWorkplaceRequest;
use App\Models\Antena;
use App\Models\Workplace;
use App\Services\Antena\AntenaServiceInterface;
use App\Services\Workplace\WorkplaceServiceInterface;

class WorkplaceAntentaController extends Controller
{
    public WorkplaceServiceInterface $workplaceService;
    public AntenaServiceInterface $antenaService;


    public function __construct(
        WorkplaceServiceInterface $workplaceService,
        AntenaServiceInterface $antenaService
    )
    {
        $this->workplaceService = $workplaceService;
        $this->antenaService = $antenaService;
    }

    public function create(Workplace $workplace, AntenaWorkplaceRequest $request)
    {
        $this->workplaceService->addAntena(
            $workplace,
            Antena::findOrFail($request->get('antena_id')),
            $request->get('type')
        );

        return redirect(route('workplace.show',$workplace))->with([
            'message' => new MessageDto(
                trans('message.antena.success_message'),
                MessageDto::TYPE_SUCCESS
            ),
        ]);
    }

    public function destroy(Workplace $workplace, Antena $antena)
    {
        $this->workplaceService->deleteAntena($workplace,$antena);

        return redirect(route('workplace.show',$workplace))->with([
            'message' => new MessageDto(
                trans('message.antena.success_message'),
                MessageDto::TYPE_SUCCESS
            ),
        ]);
    }

    public function edit(Workplace $workplace, Antena $antena)
    {
        return view('workplace.antena.edit', compact('antena','workplace'));
    }

    public function update(AntenaRequest $request, Workplace $workplace, Antena $antena)
    {
        $this->antenaService->updateAntena(AntenaRequestDto::createRequest($request->all()), $antena);

        return redirect(route('workplace.show',$workplace))->with([
            'message' => new MessageDto(
                trans('message.antena.success_message'),
                MessageDto::TYPE_SUCCESS
            ),
        ]);
    }
}
