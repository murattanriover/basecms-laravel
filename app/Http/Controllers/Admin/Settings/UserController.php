<?php namespace App\Http\Controllers\Admin\Settings;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Groups;
use Illuminate\Http\Request;
use App\User;
use Bllim\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;




class UserController extends Controller {

    /**
     * User Model
     * @var User
     */
    protected $user;

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view("cms.settings.users.index");
	}

    public function getIndex(){
        $users = User::select(['id','name','surname','email'])->live()->orderBy('id','DESC');
        return Datatables::of($users)
        ->add_column('groups',function($user){
            return implode(', ',$user->Groups()->lists('name')->all());
        })
        ->add_column('actions',function($row){
            return permshtml('settings/users/'.$row->id.'/edit','<a href="'.url('settings/users/'.$row->id.'/edit').'" class="btn btn-xs btn-default">'.trans('app.edit').'</a>') . "   " . permshtml('settings/users/'.$row->id,'<a href="'.url('settings/users/'.$row->id).'" data-token="'.csrf_token().'" class="del-item btn btn-xs btn-danger">'.trans('app.delete').'</a>',"delete");
        })
        ->removeColumn('id')
        ->make();
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $groups = Groups::live()->lists('name','id');
		return view("cms.settings.users.create")->withGroups($groups);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
        $this->validate($request,[
            'name' => "required|min:2",
            'surname' => "required|min:2",
            'email' => "required|email|unique:users,email",
            'password' => 'required|min:6',
            'password_repeat' => 'required|same:password'
        ]);

        $request->offsetSet('status',1);
        $request->offsetSet('password',bcrypt($request->input('password')));

        if($user = User::create($request->only(['name','surname','email','password','status']))){
            $user->Groups()->attach($request->input('groups'));
            return redirect('settings/users')->with('custom_success',trans('app.user').trans('app.successfully_saved'));
        }else{
            return redirect('settings/users/create')->withErrors(['email' => trans('app.an_error_occured')])->withInput($request->input());
        }

	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $user = User::where('id','=',$id)->live()->firstOrFail();
        $groups = Groups::live()->lists('name','id')->all();
        return view("cms.settings.users.edit")->withUser($user)->withGroups($groups);
	}

    public function getProfile(){
        $user = User::where('id','=',Auth::user()->id)->live()->firstOrFail();
        return view("cms.settings.users.profile")->withUser($user);
    }

    public function postProfile(Request $request)
    {
        $id = Auth::user()->id;
        $this->validate($request,[
            'name' => "required|min:2",
            'surname' => "required|min:2",
            'password' => '',
            'password_repeat' => 'same:password'
        ]);

        $user = User::where('id','=',$id)->live()->firstOrFail();
        $user->name     = $request->input('name');
        $user->surname  = $request->input('surname');
        if(strlen($request->input('password'))>0) $user->password = bcrypt($request->input('password'));

        if($user->save()) {
            return back()->with('custom_success', trans('app.user').trans('app.successfully_saved'));
        }else
            return back()->withErrors(['name' => trans('app.an_error_occured')])->withInput($request->input());
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id,Request $request)
	{
        $this->validate($request,[
            'name' => "required|min:2",
            'surname' => "required|min:2",
            'email' => "required|email|unique:users,email,".$id.",id",
            'password' => '',
            'password_repeat' => 'same:password'
        ]);

        $user = User::where('id','=',$id)->live()->firstOrFail();
        $user->name     = $request->input('name');
        $user->surname  = $request->input('surname');
        $user->email    = $request->input('email');
        if(strlen($request->input('password'))>0) $user->password = bcrypt($request->input('password'));

        if($user->save()) {
            $user->Groups()->sync((array)$request->input('groups'));
            return redirect('settings/users/' . $user->id . '/edit')->with('custom_success', trans('app.user').trans('app.successfully_saved'));
        }else
            return redirect('settings/users/'.$user->id.'/edit')->withErrors([trans('app.an_error_occured')])->withInput($request->input());
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id, Request $request)
	{
        if($request->ajax()){
            $user = User::where('id','=',$id)->live()->firstOrFail();
            $user->status = -1;
            $user->save();
            echo "ok";
        }
	}

}
