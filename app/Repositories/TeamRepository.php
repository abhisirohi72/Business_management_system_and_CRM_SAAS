<?php 
namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

    public function updateTeamMember($team, array $data){
        if(empty($data['password'])){
            unset($data['password']);
        }
        return $team->update($data);
    }

    public function deleteTeamMember($team){
        return $team->delete();
    }
}
?>