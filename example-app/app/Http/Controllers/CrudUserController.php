<?php

namespace App\Http\Controllers;

use App\Models\Favorities;
use Hash;
use Session;
use App\Models\User;
use App\Models\Posts;
use App\Models\Profile;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Illuminate\Support\Facades\Session as FacadesSession;



/**
 * CRUD User controller
 */
class CrudUserController extends Controller
{

    /**
     * Login page
     */
    public function login()
    {
        return view('crud_user.login');
    }

    /**
     * User submit form login
     */
    public function authUser(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('list')
                ->withSuccess('Signed in');
        }

        return redirect("login")->withSuccess('Login details are not valid');
    }

    /**
     * Registration page
     */
    public function createUser()
    {
        return view('crud_user.create');
    }

    /**
     * User submit form register
     */
    public function postUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $check = User::create([
            'name' => $data['name'],
            'email' => $data['email'], 
            'password' => FacadesHash::make($data['password'])
        ]);

        return redirect("login");
    }
    public function readUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect("list")->withError('Người dùng không tồn tại');
        }
        
    $user_profile = Profile::where('user_id', $id)->first();
    if (!$user_profile) {
        // Tạo một thông tin hồ sơ giả định nếu không tìm thấy thông tin hồ sơ
        $user_profile = (object) [
            'user_profile_id' => 'N/A',
            'user_id' => $user->id,
            'first_name' => 'N/A',
            'last_name' => 'N/A',
            'sex' => 'N/A',
            'phone' => 'N/A',
            'address' => 'N/A',
        ];
    }
        $favorities = $user->favorities()->get();
        $posts = Posts::where('user_id', $id)->get(); 

         return view('crud_user.read', ['user' => $user, 'user_profile' => $user_profile, 'posts' => $posts, 'favorities' => $favorities]);
    }
    



    /**
     * Delete user by id
     */
    public function deleteUser(Request $request)
    {

        $user_id = $request->get('id');
        $posts = Posts::where('user_id', $user_id)->count();
        if ($posts > 0) {
            return redirect("list")->withError('Người dùng đã có bài đăng, không thể xóa');
        }

        $nguoidung = User::find($user_id);
        $sothich = Favorities::find($nguoidung);
        if ($sothich == $nguoidung) {
            return redirect("list")->withError('Người dùng có sở thích, không thể xóa');
        }
        $user = User::destroy($user_id);
        return redirect("list")->withSuccess('xóa thành công');
    }

    /**
     * Form update user page
     */
    public function updateUser(Request $request)
    {
        $user_id = $request->get('id');
        $user = User::find($user_id);

        return view('crud_user.update', ['user' => $user]);
    }

    /**
     * Submit form update user
     */
    public function postUpdateUser(Request $request)
    {
        $input = $request->all();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,id,' . $input['id'],
            'password' => 'required|min:6',
        ]);

        $user = User::find($input['id']);
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->password = $input['password'];
        $user->save();

        return redirect("list")->withSuccess('You have signed-in');
    }

    /**
     * List of users
     */
    public function listUser()
    {
        if (Auth::check()) {
            $users = User::all();
            return view('crud_user.list', ['users' => $users]);
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    /**
     * Sign out
     */
    public function signOut()
    {
        FacadesSession::flush();
        Auth::logout();

        return Redirect('login');
    }

    public function listpost()
    {
        if (Auth::check()) {
            $posts = Posts::all();
            return view('listPost', ['posts' => $posts]);
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function listFavorities()
    {

        $favorities = Favorities::all();
        return view('listfavorities', ['favorities' => $favorities]);


        //return redirect("login")->withSuccess('You are not allowed to access');
    }
}