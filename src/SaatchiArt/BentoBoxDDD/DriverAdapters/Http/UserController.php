<?php

declare(strict_types=1);

namespace SaatchiArt\BentoBoxDDD\DriverAdapters\Http;

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use SaatchiArt\BentoBoxDDD\Exceptions\UserNotFoundException;
use SaatchiArt\BentoBoxDDD\Services\UserActions\UserService;

final class UserController
{
    /** @var UserService */
    private $userService;

    public function __construct(
        UserService $userService
    ) {
        $this->userService = $userService;
    }

    public function goOnVacation(Request $request): Response
    {
        $requestBody = \json_decode($request->getBody()->getContents());
        try {
            $this->userService->goOnVacation($requestBody['user_id']);
        } catch (UserNotFoundException $exception) {
            return \response()->json([
                'success' => false,
                'error' => $exception->getMessage(),
            ], 404);
        }

        return \response()->json(['success' => true]);
    }
}
