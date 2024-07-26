<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * inject user service
     */
    public function __construct(
        protected userService $userService
    )
    {}

    /**
     * get data all users
     */
    public function all(): JsonResponse
    {
        $users = $this->userService->getUsers();
        return $this->to_response(
            true, '', 200, $users
        );
    }

    /**
     * get data one user
     */
    public function get(int $id): JsonResponse
    {
        $user = $this->userService->getUserById($id);
        $message = $user ? '' : 'user not found';

        return $this->to_response(
            (bool)$user, $message, 200, ['user' => $user]
        );
    }

    /**
     * create user
     */
    public function create(Request $request): JsonResponse
    {
        // validate params to create
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6',
            'full_name' => 'required|string|max:255',
            'email' => 'email|unique:users',
            'cpf' => 'required|string|min:9|max:9|unique:users',
            'date_of_birth' => 'required|date',
            'reference' => 'nullable|string',
        ]);

        // create user
        $user_id = 0;
        $message = '';
        try {
            $user_id = $this->userService->create($request->all());
        } catch (\Throwable $throwable) {
            return $this->to_response(
                false, $throwable->getMessage()
            );
        }
        return $this->to_response(
            true, $message, 200, ['user_id' => $user_id]
        );
    }

    /**
     * remove user
     */
    public function remove(Request $request): JsonResponse
    {
        // validate params to create
        $request->validate([
            'id' => 'required|integer'
        ]);

        // create user
        $id = $request->input('id');
        $message = '';
        try {
            $this->userService->remove($id) && $message = 'user deleted';
        } catch (\Throwable $throwable) {
            return $this->to_response(
                false, $throwable->getMessage()
            );
        }
        return $this->to_response(
            true, $message
        );
    }
}
