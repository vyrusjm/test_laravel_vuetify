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
    /**
    * @OA\Get(
    *     path="/api/users",
    *       tags={"users"},
    *     summary="shows the complete list of users",
    *     @OA\Response(
    *         response=200,
    *         description="Show list of users."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="An error has occurred."
    *     )
    * )
    */
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
        /**
    * @OA\Post(
    *     path="/api/users",
    *       tags={"users"},
    *     summary="Create a user",
    *   @OA\Parameter(
    *         name="name",
    *         in="query",
    *         description="The user name, and unique",
    *         required=true,
    *         @OA\Schema(
    *           type="string",
    *         ),
    *         style="form"
    *     ),
    *   @OA\Parameter(
    *         name="email",
    *         in="query",
    *         description="The user email",
    *         required=true,
    *         @OA\Schema(
    *           type="email",
    *         ),
    *         style="form"
    *     ),
    *   @OA\Parameter(
    *         name="password",
    *         in="query",
    *         description="Encerypt password, min 8 characters",
    *         required=true,
    *         @OA\Schema(
    *           type="string",
    *         ),
    *         style="form"
    *     ),
    *   @OA\Parameter(
    *         name="password_confirmation",
    *         in="query",
    *         description="Macth password and password confirmation",
    *         required=true,
    *         @OA\Schema(
    *           type="string",
    *         ),
    *         style="form"
    *     ),
    *   @OA\Parameter(
    *         name="phone",
    *         in="query",
    *         description="Phone number",
    *         required=false,
    *         @OA\Schema(
    *           type="integer",
    *         ),
    *         style="form"
    *     ),
    *   @OA\Parameter(
    *         name="admin",
    *         in="path",
    *         description="For default is USER REGULAR",
    *         required=false,
    *         @OA\Schema(
    *           type="string",
    *         ),
    *     ),
    *   @OA\Response(
    *         response=200,
    *         description="successful operation."
    *     ),
    *   @OA\Response(
    *         response=405,
    *         description="Invalid input."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="An error has occurred."
    *     )
    * )
    */
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ];

        $this->validate($request, $rules);

        $fields = $request->all();
        $fields['password'] = bcrypt($request->password);
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
    /**
    * @OA\Delete(
    *     path="/api/users/{id}",
    *       tags={"users"},
    *     summary="delete a specific user",
    *   @OA\Parameter(
    *         name="id",
    *         in="query",
    *         description="The user id",
    *         required=true,
    *         @OA\Schema(
    *           type="string",
    *         ),
    *         style="form"
    *     ),
    *      @OA\Response(
    *         response=200,
    *         description="successful operation."
    *     ),
    *   @OA\Response(
    *         response=404,
    *         description="user no found."
    *     ),
    *   @OA\Response(
    *         response=405,
    *         description="Invalid input."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="An error has occurred."
    *     )
    * )
    */
        $user = User::findOrFail($id);

        $user->delete();

        return $this->showOne($user);

    }
}
