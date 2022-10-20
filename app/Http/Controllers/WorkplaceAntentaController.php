<?php

namespace App\Http\Controllers;

use App\Dto\Response\MessageDto;
use App\Http\Requests\AntenaWorkplaceRequest;
use App\Models\Antena;
use App\Models\Workplace;
use App\Services\Workplace\WorkplaceServiceInterface;

class WorkplaceAntentaController extends Controller
{
    public WorkplaceServiceInterface $workplaceService;

    public function __construct(WorkplaceServiceInterface $workplaceService)
    {
        $this->workplaceService = $workplaceService;
    }

    public function create(Workplace $workplace, AntenaWorkplaceRequest $request)
    {
        $this->workplaceService->addAntena(
            $workplace,
            Antena::find($request->get('antena_id')),
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
}
