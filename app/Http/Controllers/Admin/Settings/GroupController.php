<?php namespace App\Http\Controllers\Admin\Settings;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\GroupPerms;
use App\Model\Groups;
use Illuminate\Http\Request;
use Bllim\Datatables\Datatables;
use App\Library\PermsLib;


class GroupController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view("cms.settings.groups.index");
	}

    public function getIndex(){
        $groups = Groups::select(['id','name'])->live()->orderBy('id','DESC');
        return Datatables::of($groups)
        ->add_column('actions',function($row){
            return permslink('settings/groups/data/perms/'.$row->id.'/edit',trans('app.edit_perms'),['class'=>'btn btn-xs btn-warning']). "&nbsp;&nbsp;" .
            permslink('settings/groups/'.$row->id.'/edit',trans('app.edit'),['class'=>"btn btn-xs btn-default"]) . "&nbsp;&nbsp;" .
            permslink('settings/groups/'.$row->id,trans('app.delete'),['class'=>"del-item btn btn-xs btn-danger",'data-token'=>csrf_token()]);
        })
        ->removeColumn('id')
        ->make();
    }

    public function getPerms($id){
        $group = Groups::where('id','=',$id)->live()->firstOrFail();;
        $currentPerms = [];
        foreach (GroupPerms::where('group_id','=',$group->id)->get() as $row=>$p) {
            $controllername = (strlen($p->controller)<1) ? "all" : $p->controller;
            $actionname     = (strlen($p->action)<1) ? "all" : $p->action;
            $currentPerms[$controllername."___".$actionname] = $p->id;
        }
        $ControllerFiles = (PermsLib::mapSystemClasses(null,true)); // true = just public func
        return view('cms.settings.groups.perms')->withGroup($group)->withControllers($ControllerFiles)->withCurrentperms($currentPerms);
    }

    public function postPerms($id,Request $request){
        $group = Groups::where('id','=',$id)->live()->firstOrFail();;

        if($request->input('allperms')=="1") {
            GroupPerms::where("group_id", "=", $group->id)->delete(); // remove all records
            GroupPerms::create(['group_id' => $group->id, 'controller' => null, 'action' => null]);
        }elseif(!is_array($request->input('perms'))){
            GroupPerms::where("group_id","=",$group->id)->delete(); // remove all records
        }else{
            $currentPerms = [];
            foreach (GroupPerms::where('group_id','=',$group->id)->get() as $row=>$p) {
                $controllername = (strlen($p->controller)<1) ? "all" : $p->controller;
                $actionname     = (strlen($p->action)<1) ? "all" : $p->action;
                $currentPerms[$controllername."___".$actionname] = $p->id;
            }
            $postperms = $request->input('perms');
            if(is_array($postperms)){
                foreach ($postperms as $r=>$perm) {
                    if(isset($currentPerms[$perm])) unset($currentPerms[$perm]);
                    else{
                        $str = explode('___',$perm);
                        if($str[0]=="all") $str[0] = null;
                        if($str[1]=="allmethods") $str[1] = null;
                        GroupPerms::create(['group_id'=>$group->id,'controller'=>$str[0],'action'=>$str[1]]);
                    }
                }
                GroupPerms::whereIn('id',array_values($currentPerms))->delete();
            }
        }
        return redirect('settings/groups/data/perms/'.$group->id)->with('custom_success',trans('app.perms').trans('app.successfully_saved'));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view("cms.settings.groups.create");
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
        ]);
        $request->offsetSet('status',1);

        if(Groups::create($request->only(['name','status']))){
            return redirect('settings/groups')->with('custom_success', trans('app.group').trans('app.successfully_saved'));
        }else{
            return redirect('settings/groups/create')->withErrors(['name' => trans('app.an_error_occured')])->withInput($request->input());
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
        $group = Groups::where('id','=',$id)->live()->firstOrFail();
        return view("cms.settings.groups.edit")->withGroup($group);
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
        ]);
        $group = Groups::where('id','=',$id)->live()->firstOrFail();
        $group->name    = $request->input('name');
        if($group->save()) {
            return redirect('settings/groups/' . $group->id . '/edit')->with('custom_success', trans('app.group').trans('app.successfully_saved'));
        }else
            return redirect('settings/groups/'.$group->id.'/edit')->withErrors(['name' => trans('app.an_error_occured')])->withInput($request->input());
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
            $group = Groups::where('id','=',$id)->live()->firstOrFail();
            $group->status = -1;
            $group->save();
            echo "ok";
        }
	}
}
