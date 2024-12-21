<?php
namespace App\Services;

use App\Models\User;

class UserService
{
    public function __construct(public User $user){}

        public function index()
        {
            return $this->user->paginate();
        }

        public function store(array $data)
        {
            return $this->user->create($data);
        }

        public function show($id)
        {
            return $this->user->findOrFail($id);
        }

        public function update($id, array $data)
        {
            $user = $this->show($id);
            $user->update($data);
            return $user;
        }
        public function destroy($id)
        {
            $user = $this->show($id);
            return $user->delete();
        }
}
