<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return $this->showAll($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ];

        $this->validate($request, $rules);

        $fields = $request->all();
        $fields['password'] = bcrypt($request->password);
        $fields['verified'] = User::USER_NOT_VERIFIED;
        $fields['verification_token'] = User::generateVerificationToken();
        $fields['admin'] = User::USER_REGULAR;

        $user = User::create($fields);

        return $this->showOne($user, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return $this->showOne($user);
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
        $user = User::findOrFail($id);

        $rules = [
            'email' => 'email|unique:users,email,'.$user->id,
            'password' => 'min:8|confirmed',
        ];

        $this->validate($request, $rules);
        if($request->has('name')){
            $user->name = $request->name;
        }
        if($request->has('email') && $user->email != $request->email) {
            $user->verified = User::USER_NOT_VERIFIED;
            $user->verification_token = User::generateVerificationToken();
            $user->email = $request->email;
        }
        if($request->has('password')){
            $user->password = bcrypt($request->password);
        }
        if($request->has('phone')){
            $user->phone = $request->phone;
        }
        if(!$user->isDirty()){
            return $this->errorResponse('At least one different value must be specified to update', 422);
        }

        $user->save();
        return $this->showOne($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return $this->showOne($user);

    }
}
