<?php
declare(strict_types=1);
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Repository\UserRepository as UserRepositoryInterface;
use App\Repository\Eloquent\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{

    private UserRepositoryInterface $user;
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response([
            'data' => $this->user
                ->index()
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        if(Gate::denies('checkSuperAdmin', Auth::user())) abort(403);

        $user = $this->user
            ->store($request->only([
                'email',
                'password',
                'name',
            ]));

        return response([
            "data" => $user
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
    public function destroy(int $id)
    {
        if(Gate::denies('checkSuperAdmin', Auth::user())) abort(403);
        return response([
            'data' => $this->user
            ->destroy($id)
        ], 100);
    }
}
