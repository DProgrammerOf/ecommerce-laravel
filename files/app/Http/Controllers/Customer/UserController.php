<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
    public function get(Request $request, int $id): JsonResponse
    {
        // params
        $user = $this->userService->getUserById($id);
        if ($user === null) {
            return $this->to_response(
                false, 'user not found'
            );
        }

        return $this->to_response(
            true, '', 200, ['user' => $user]
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
        // params
        $user_id = 0;
        [$status, $message] = [false, 'save failed'];
        // create user
        try {
            $user_id = $this->userService->create($request->all())
            && $message = 'user created successfully'
            && $status = true;
        } catch (\Throwable $throwable) {
            return $this->to_response(
                false, $throwable->getMessage()
            );
        }
        return $this->to_response(
            $status, $message, 200, ['user_id' => $user_id]
        );
    }

    /**
     * edit user
     */
    public function edit(Request $request): JsonResponse
    {
        // validate params to create
        $request->validate([
            'id' => 'required|integer|exists:users',
            'username' => [
                'nullable', 'string', 'max:255',
                Rule::unique('users', 'id')->ignore($request->input('id'))
            ],
            'password' => 'nullable|string|min:6',
            'full_name' => 'nullable|string|max:255',
            'email' => [
                'nullable', 'email',
                Rule::unique('users', 'id')->ignore($request->input('id'))
            ],
            'cpf' => [
                'nullable', 'string', 'min:9', 'max:9',
                Rule::unique('users', 'id')->ignore($request->input('id'))
            ],
            'date_of_birth' => 'nullable|date',
            'reference' => 'nullable|string',
        ]);
        // params
        [$id, $data] = [$request->input('id'), $request->except('id')];
        [$status, $message] = [false, 'update failed'];
        // edit user
        try {
            $this->userService->edit($id, $data)
            && $message = 'user edited'
            && $status = true;
        } catch (\Throwable $throwable) {
            return $this->to_response(
                false, $throwable->getMessage()
            );
        }
        return $this->to_response(
            $status, $message
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
        // params
        $id = $request->input('id');
        $status = false;
        $message = 'delete failed';
        // remove user
        try {
            $this->userService->remove($id)
            && $message = 'user deleted'
            && $status = true;
        } catch (\Throwable $throwable) {
            return $this->to_response(
                false, $throwable->getMessage()
            );
        }
        return $this->to_response(
            $status, $message
        );
    }
}
