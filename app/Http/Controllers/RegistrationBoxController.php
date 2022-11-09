<?php

namespace App\Http\Controllers;

use App\Dto\RegistrationBox\RegistrationBoxCreateRequestDto;
use App\Dto\RegistrationBox\RegistrationBoxUpdateRequestDto;
use App\Dto\Response\MessageDto;
use App\Http\Requests\RegistrationBoxCreateRequest;
use App\Http\Requests\RegistrationBoxUpdateRequest;
use App\Http\Resources\AntennaDataResource;
use App\Models\Antena;
use App\Models\Item;
use App\Models\RegistrationBox;
use App\Repositories\Antenna\AntennaRepositoryInterface;
use App\Services\RegistrationBox\RegistrationBoxServiceInterface;
use Illuminate\Http\Request;

class RegistrationBoxController extends Controller
{
    const PAGE = 10;

    private array $rssiRange;

    public RegistrationBoxServiceInterface $registrationBoxService;
    public AntennaRepositoryInterface $antennaRepository;

    public function __construct(
        RegistrationBoxServiceInterface $registrationBoxService,
        AntennaRepositoryInterface $antennaRepository
    )
    {
        $this->rssiRange = range(0, 100);
        $this->registrationBoxService = $registrationBoxService;
        $this->antennaRepository = $antennaRepository;
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

    public function show(RegistrationBox $registrationBox)
    {
        $antennaData = $registrationBox->antenna ?
            collect(AntennaDataResource::collection(
                $this->antennaRepository->getAntennaData(
                    $registrationBox->antenna,
                    $registrationBox->rssi_throttle
                )
            )) : [];
        if(request()->ajax()) {
            $mac = $registrationBox?->antenna?->mac_address;
            return ['antennaData' => $antennaData, 'mac' => $mac];
        }
        $items = Item::all()->pluck( 'name', 'id')->toArray();
        $mac = $registrationBox?->antenna?->mac_address;
        $data = compact('registrationBox','antennaData', 'items', 'mac');
        return view('registrationBox.show', $data ?? []);
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

    public function listDeleted()
    {
        $boxes = RegistrationBox::onlyTrashed()->paginate(self::PAGE);
        return view('registrationBox.listDeleted', compact('boxes'));
    }

    public function restore(string $registrationBoxId)
    {
        $this->registrationBoxService->restoreRegistrationBox($registrationBoxId);

        return redirect('registrationBox')->with([
            'message' => new MessageDto(
                trans('message.antena.success_message'),
                MessageDto::TYPE_SUCCESS
            ),
        ]);
    }

    public function rssiStore(Request $request, RegistrationBox $registrationBox)
    {
        $this->registrationBoxService->rssiStore($registrationBox, $request->get('rssiNumber'));
    }
}
