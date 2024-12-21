<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use App\Traits\HttpResponse;

class UserController extends Controller
{

    use HttpResponse;
     public function __construct(public UserService $userService){}

          /**
         * status
         *  1 => Active,
         *  2 => Inactive,
         */
    public function index()
    {
        $data = $this->userService->index();
        return $this->paginatedResponse($data, UserResource::class);
    }


    public function store(UserRequest $request)
    {
        $data = $this->userService->store($request->validated());

        return $this->okResponse(new UserResource($data) ,code:201);
    }


    public function show(string $id)
    {
        $data = $this->userService->show($id);

        return $this->okResponse(new UserResource($data));
    }


    public function update(UserRequest $request, string $id)
    {
        $data = $this->userService->update($id, $request->validated());

        return $this->okResponse(new UserResource($data));
    }


    public function destroy(string $id)
    {
        $this->userService->destroy($id);

        return $this->okResponse(message: 'Deleted Successfully');
    }
}
