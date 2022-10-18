<?php

namespace App\Http\Controllers;

use App\Dto\AntenaWorkplace\AntenaWorkplaceRequestDto;
use App\Dto\Response\MessageDto;
use App\Models\Antena;
use App\Models\Workplace;
use App\Services\AntenaWorkplace\AntenaWorkplaceServiceInterface;
use Illuminate\Http\Request;

class WorkplaceAntentaController extends Controller
{
    public AntenaWorkplaceServiceInterface $antenaWorkplasceService;

    public function __construct(AntenaWorkplaceServiceInterface $antenaWorkplasceService)
    {
        $this->antenaWorkplasceService = $antenaWorkplasceService;
    }

    public function create(Workplace $workplace, Request $request)
    {
        $this->antenaWorkplasceService->addAntena(AntenaWorkplaceRequestDto::createRequest($request->all(),$workplace));

        return redirect(route('workplace.show',$workplace))->with([
            'message' => new MessageDto(
                trans('message.antena.success_message'),
                MessageDto::TYPE_SUCCESS
            ),
        ]);
    }

    public function destroy(Workplace $workplace, Antena $antena)
    {
        $this->antenaWorkplasceService->deleteAntena($workplace,$antena);
        return redirect(route('workplace.show',$workplace))->with([
            'message' => new MessageDto(
                trans('message.antena.success_message'),
                MessageDto::TYPE_SUCCESS
            ),
        ]);
    }
}
