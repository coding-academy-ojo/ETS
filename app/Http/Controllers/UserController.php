<?php

namespace App\Http\Controllers;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
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
        // $users = User::with('employmentStatus')->get();

        return view('user_role.admin');
    }

    public function viewUser(){
        $users = User::get();
//        dd($users);
        return view('user_role.mange_user',compact('users'));
    }
    public function update_user_data($id){
        $user_info=User::findOrFail($id);
        return view('user_role.update_user_info',['user_info'=>$user_info]);
    }
    public function user_store_data(Request $request, $id){
        $user = User::findOrFail($id);

        // Update name
        $user->name = $request->user_name;

        // Update password only if input is provided
        if ($request->filled('user_pass')) {
            $user->password = Hash::make($request->user_pass);
        }

        // Save changes
        $user->save();

        // Redirect with success message
        return redirect()->route('user_details.user_update_info', $id)
            ->with('success', 'User entry updated successfully');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_role=Role::get();
        return view('auth.register',compact('user_role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
        return redirect()->route('user_details.manageUser')->with('success', 'User deleted successfully.');

    }
    public function notification(){
        return view('user_role.notification_page');
    }
}
