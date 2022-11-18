<?php

namespace App\Services\Antena;

use App\Dto\Antena\AntenaRequestDto;
use App\Models\Antena;

class AntenaService implements AntenaServiceInterface
{
    public function addAntena(AntenaRequestDto $antenaRequestDto): void
    {
        Antena::create($antenaRequestDto->toArray());
    }

    public function updateAntena(AntenaRequestDto $antenaRequestDto, Antena $antena): void
    {
        $antena->update($antenaRequestDto->toArray());
    }

    public function deleteAntena(Antena $antena): void
    {
        $antena->delete();
    }

    public function  updateAntennaStatus(array $macAddressStatus): void
    {
        foreach ($macAddressStatus ?? [] as $key => $data) {
            Antena::where('mac_address', $key)->update(['is_online' => $data]);
        }
    }
}
