<?php

namespace App\Http\Controllers\token;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateRequest;
use App\Http\Requests\Users\UpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\Users;
use App\Services\TokenService;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class UserController extends Controller
{
    private UserService $userService;
    private TokenService $tokenService;

    /**
     * @param UserService $userService
     * @param TokenService $tokenService
     */
    public function __construct(UserService $userService, TokenService $tokenService)
    {
        $this->userService = $userService;
        $this->tokenService = $tokenService;
    }

    /**
     * @param CreateRequest $request
     * @return JsonResponse
     */
    public function create(CreateRequest $request): JsonResponse
    {
        $tokenFromRequest = $request->get('token');

        $resultCheckToken = $this->tokenService->checkToken($tokenFromRequest);
        if (is_string($resultCheckToken) ) {
            return response()->json([
                ['errors' =>
                    [
                        'description' => $resultCheckToken
                    ]
                ]
            ], 406);
        }

        $user = $this->userService->create($request->validated());
        $this->tokenService->writeOffToken($resultCheckToken);
        return response()->json([
            ['data' =>
                [
                    'users' => $user
                ],
            ]
        ], 201);
    }

    /**
     * @param int $id
     * @param UpdateRequest $updateRequest
     * @return JsonResponse
     */
    public function update(int $id, UpdateRequest $updateRequest): JsonResponse
    {
        $tokenFromRequest = $updateRequest->get('token');

        $resultCheckToken = $this->tokenService->checkToken($tokenFromRequest);
        if (is_string($resultCheckToken)) {
            return response()->json([
                ['errors' =>
                    [
                        'description' => $resultCheckToken
                    ]
                ]
            ], 406);
        }

        $params = $updateRequest->validated();
        $user = $this->userService->update($id, $params);

        $this->tokenService->writeOffToken($resultCheckToken);
        return response()->json([
            'data' =>
                [
                    'users' => $user,
                ],

        ], 201);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $tokenFromRequest = $request->get('token');

        $resultCheckToken = $this->tokenService->checkToken($tokenFromRequest);
        if (gettype($resultCheckToken) === 'string') {
            return response()->json([
                ['errors' =>
                    [
                        'description' => $resultCheckToken
                    ]
                ]
            ], 406);
        }
        $users = UserResource::collection(Users::all());
        $this->tokenService->writeOffToken($resultCheckToken);
        return response()->json([
            'data' =>
                [
                    'users' => $users
                ],
        ]);
    }

    /**
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function view(int $id, Request $request): JsonResponse
    {
        $tokenFromRequest = $request->get('token');

        $resultCheckToken = $this->tokenService->checkToken($tokenFromRequest);//
        if (gettype($resultCheckToken) === 'string') {
            return response()->json([
                ['errors' =>
                    [
                        'description' => $resultCheckToken
                    ]
                ]
            ], 406);
        }
        $this->tokenService->writeOffToken($resultCheckToken);
        $user = UserResource::collection(Users::where('id', $id)->first());
        return response()->json([
            'data' =>
                [
                    'user' => $user
                ],

        ]);
    }

    /**
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(int $id, Request $request): JsonResponse
    {
        $tokenFromRequest = $request->get('token');

        $resultCheckToken = $this->tokenService->checkToken($tokenFromRequest);//
        if (gettype($resultCheckToken) === 'string') {
            return response()->json([
                ['errors' =>
                    [
                        'description' => $resultCheckToken
                    ]
                ]
            ], 406);
        }
        $this->tokenService->writeOffToken($resultCheckToken);
        Users::where('id', $id)->delete();
        return response()->json([
            'result' => 'success'
        ]);
    }
}
