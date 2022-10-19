<?php

namespace App\Http\Controllers;

use App\Models\Workplace;
use App\Queries\AntennaQueriesInterface;
use App\Services\Workplace\WorkplaceServiceInterface;

class WorkplaceController extends Controller
{
    const PAGE = 10;

    public WorkplaceServiceInterface $workplaceService;
    public AntennaQueriesInterface $antennaQueries;

    public function __construct(
        WorkplaceServiceInterface $workplaceService,
        AntennaQueriesInterface $antennaQueries
    )
    {
        $this->workplaceService = $workplaceService;
        $this->antennaQueries = $antennaQueries;
    }
    public function index()
    {
        $workplaces = Workplace::withCount('antenas')->with('company')->paginate(self::PAGE);
        return view('workplace/index', compact('workplaces'));
    }

    public function show(Workplace $workplace)
    {
        $antenas = $workplace->antenas;
        $filterAntena = $this->antennaQueries
            ->getAntenasWhichNotBelongsToWorkplace($workplace)
            ->get()->pluck( 'mac_address', 'id')
            ->toArray();

        return view('workplace/show', compact('antenas','workplace', 'filterAntena'));
    }
}
