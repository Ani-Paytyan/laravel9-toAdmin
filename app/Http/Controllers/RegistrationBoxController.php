<?php

namespace App\Http\Controllers;

use App\Dto\RegistrationBox\RegistrationBoxCreateRequestDto;
use App\Dto\RegistrationBox\RegistrationBoxUpdateRequestDto;
use App\Dto\Response\MessageDto;
use App\Http\Requests\RegistrationBoxCreateRequest;
use App\Http\Requests\RegistrationBoxUpdateRequest;
use App\Models\Antena;
use App\Models\RegistrationBox;
use App\Services\RegistrationBox\RegistrationBoxServiceInterface;

class RegistrationBoxController extends Controller
{
    const PAGE = 10;

    private array $rssiRange;

    public RegistrationBoxServiceInterface $registrationBoxService;

    public function __construct(RegistrationBoxServiceInterface $registrationBoxService)
    {
        $this->rssiRange = range(0, 100);
        $this->registrationBoxService = $registrationBoxService;
    }

    public function index()
    {
        $boxes = RegistrationBox::paginate(self::PAGE);
        return view('registrationBox.index', compact('boxes'));
    }

    public function create()
    {
        return view('registrationBox.create')->with([
            'antenas' => Antena::all()->pluck('mac_address', 'id')->toArray(),
            'rssiRange' => $this->rssiRange
        ]);
    }

    public function store(RegistrationBoxCreateRequest $request)
    {
        $this->registrationBoxService->addRegistrationBox(
            RegistrationBoxCreateRequestDto::createRequest($request->all())
        );

        return redirect(route('registrationBox.index'))->with([
            'message' => new MessageDto(
                trans('message.antena.success_message'),
                MessageDto::TYPE_SUCCESS
            ),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    public function edit(RegistrationBox $registrationBox)
    {
        return view('registrationBox.edit')->with([
            'registrationBox' => $registrationBox,
            'antenas' => Antena::all()->pluck( 'mac_address', 'id')->toArray(),
            'rssiRange' => $this->rssiRange
        ]);
    }

    public function update(RegistrationBoxUpdateRequest $request, RegistrationBox $registrationBox)
    {
        $this->registrationBoxService->updateRegistrationBox(
            RegistrationBoxUpdateRequestDto::createRequest(
                $request->all()
            ), $registrationBox);

        return redirect(route('registrationBox.index'))->with([
            'message' => new MessageDto(
                trans('message.antena.success_message'),
                MessageDto::TYPE_SUCCESS
            ),
        ]);
    }

    public function destroy(RegistrationBox $registrationBox)
    {
        $this->registrationBoxService->deleteRegistrationBox($registrationBox);

        return redirect('registrationBox')->with([
            'message' => new MessageDto(
                trans('message.antena.success_message'),
                MessageDto::TYPE_SUCCESS
            ),
        ]);
    }
}
