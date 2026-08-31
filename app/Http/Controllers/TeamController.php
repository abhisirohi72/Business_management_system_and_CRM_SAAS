<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Repositories\TeamRepository;
use App\Models\Role;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TeamController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        protected TeamRepository $teamRepository
    ){

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->role?->slug==="super_admin"){
            $users = User::withoutSuperAdmin()
            ->with("role", "company")
            ->latest()
            ->paginate(10);
        }else{
            $users = User::forCompany(Auth::user()->company_id)
            ->withoutSuperAdmin()
            ->with("role")
            ->latest()
            ->paginate(10);
        }
        
        return view("teams.index", [
            'teams'=>$users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', User::class);
        $roles = Role::withoutSuperAdmin()->forCompany(Auth::user()->company_id)->get();
        return view("teams.create", ['roles'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeamRequest $request)
    {
        $this->authorize('create', User::class);

        $data= $request->validated();

        $create_user= $this->teamRepository->addingTeamMember([
            'company_id'=> Auth::user()->company_id,

            "name"=>$data['name'],
            "email"=>$data['email'],
            'password'=> Hash::make($data['password']),
            'role_id'=>$data['role_id'] ?? null
        ]);

        if($create_user){
            return redirect()
                    ->route('teams.index')
                    ->with('success', 'User Created Successfully.');
        }
        return redirect()
                ->route('teams.index')
                ->with('error', 'There is some issue on inserting');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
