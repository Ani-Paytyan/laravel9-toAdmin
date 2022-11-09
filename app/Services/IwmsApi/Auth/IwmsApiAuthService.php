<?php

namespace App\Services\IwmsApi\Auth;

use App\Dto\IwmsApi\IwmsApiLoginDto;
use App\Dto\IwmsApi\IwmsApiUserDto;
use App\Services\IwmsApi\AbstractIwmsApi;

class IwmsApiAuthService extends AbstractIwmsApi implements IwmsApiAuthServiceInterface
{
    public function __construct()
    {
        $this->setUserToken(config('iwms.api_user_token'));
    }

    public function login(IwmsApiLoginDto $dto): IwmsApiUserDto
    {
        $response = $this->getRequestBuilder()->post('login', [
            'email' => $dto->getEmail(),
            'password' => $dto->getPassword(),
            'ip' => $dto->getIp(),
            'mac' => $dto->getMac(),
            'device' => $dto->getDevice(),
            'system' => $dto->getSystem()
        ]);

        return IwmsApiUserDto::createFromApiResponse($response->json());
    }

    public function logout(): void
    {
        $this->getRequestBuilder()->post('logout');
    }
}
