<?php 
namespace App\Repositories;

use App\Models\User;

class TeamRepository
{
    public function getTeamMembers(int $companyId){
        return User::forCompany($companyId)
                ->withoutSuperAdmin()
                ->with("role")
                ->latest()
                ->paginate(10);
    }

    public function addingTeamMember(array $data){
        return User::create($data);
    }
}
?>