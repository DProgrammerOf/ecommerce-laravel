<?php

namespace App\Http\Controllers;

use App\Services\AdminService;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function __construct(
        protected UserService $userService,
        protected AdminService $adminService,
    )
    {}

    /**
     * authenticate test to customers
     */
    public function test_user(): JsonResponse
    {
        //
        return $this->to_response(
            true, 'Authenticated.'
        );
    }

    /**
     * authenticate test to admin
     */
    public function test_admin(): JsonResponse
    {
        //
        return $this->to_response(
            true, 'Authenticated.'
        );
    }

    /**
     * authenticate user by username, email and cpf
     */
    public function basic(Request $request): JsonResponse
    {
        // validate params to auth
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);
        // get credentials
        [$username, $password] = [
            $request->input('username'),
            $request->input('password')
        ];
        // check by name
        $user = $this->userService->checkUserByName($username, $password);
        // check by email
        !$user && $user = $this->userService->checkUserByEmail($username, $password);
        // check by cpf
        !$user && $user = $this->userService->checkUserByCpf($username, $password);
        // returns
        if ($user) {
            // token
            $token = $this->userService->createToken($user);
            return $this->to_response(
                true, 'Authenticated.', 200, [
                    'token' => $token
                ]
            );
        }
        else {
            return $this->to_response(
                false, 'Unauthenticated.'
            );
        }
    }

    /**
     * authenticate user by OAuth
     */
    public function oauth(Request $request): JsonResponse
    {
        //
        return $this->to_response(
            false, 'invalid request'
        );
    }

    /**
     * authenticate admin by username
     */
    public function admin(Request $request): JsonResponse
    {
        // validate params to auth
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);
        // get credentials
        [$username, $password] = [
            $request->input('username'),
            $request->input('password')
        ];
        // verify exist user and get if any
        $admin = $this->adminService->checkUserByName($username, $password);
        if ($admin) {
            // token
            $token = $this->adminService->createToken($admin);
            return $this->to_response(
                true, 'Authenticated.', 200, [
                    'token' => $token
                ]
            );
        }
        //
        return $this->to_response(
            false, 'Unauthenticated.'
        );
    }
}
