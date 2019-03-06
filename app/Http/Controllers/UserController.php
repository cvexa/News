<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('Role')->get();
        return view('users.index',['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create',['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'user_role' => 'required|numeric',
        ]);
        $newUser = new User;
        $newUser->name = $request->name;
        $newUser->email = $request->email;
        $newUser->password = Hash::make($request->password);
        $newUser->role_id = $request->user_role;
        $newUser->save();

        $message = __("Succeffully created user!");
        return redirect('/users')->with('success', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id)->load('Role');
        $roles = Role::all();

        return view('users.edit',['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|max:50',
            'user_role' => 'required|numeric',
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        
        if ($request->email !== $user->email) {
            $validatorUnique = Validator::make($request->all(), [
                'email' => 'email|unique:users'
            ]);
            $user->email = $request->email;
        }
        $user->role_id = $request->user_role;
        $user->save();

        $message = __("Succeffully edited user!");
        return redirect('/users')->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        $message = __("Succeffully deleted user");
        return redirect('/users')->with('success', $message);

    }

    public function validateEmail(Request $request)
    {
        $validatorMail = Validator::make($request->all(), [
                'email' => 'email'
        ]);
        $validatorUnique = Validator::make($request->all(), [
                'email' => 'unique:users'
        ]);
        if ($validatorMail->fails()) {
            return response()->json(['status' => 'not_valid']);
        }
        if ($validatorUnique->fails()) {
            return response()->json(['status' => 'taken']);
        }
        return response()->json(['status' => 'free']);
    }
}
