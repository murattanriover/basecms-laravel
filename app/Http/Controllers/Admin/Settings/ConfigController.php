<?php namespace App\Http\Controllers\Admin\Settings;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Config;
use Illuminate\Http\Request;
use Bllim\Datatables\Datatables;


class ConfigController extends Controller {


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view("cms.settings.config.index");
	}

    public function getIndex(){
        $config = Config::select(['id','name','value'])->live()->orderBy('id','DESC');
        return Datatables::of($config)
        ->add_column('actions',function($row){
            return permshtml('settings/config/'.$row->id.'/edit','<a href="'.url('settings/config/'.$row->id.'/edit').'" class="btn btn-xs btn-default">'.trans('app.edit').'</a>') . "   " . permshtml('settings/config/'.$row->id,'<a href="'.url('settings/config/'.$row->id).'" data-token="'.csrf_token().'" class="del-item btn btn-xs btn-danger">'.trans('app.delete').'</a>',"delete");
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
		return view("cms.settings.config.create");
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
            'value' => "required|min:2",
        ]);
        $request->offsetSet('status',1);

        if(Config::create($request->only(['name','value','status']))){
            return redirect('settings/config')->with('custom_success', trans('app.definition').trans('app.successfully_saved'));
        }else{
            return redirect('settings/config/create')->withErrors(['name' => trans('app.an_error_occured')])->withInput($request->input());
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
        $config = Config::where('id','=',$id)->live()->firstOrFail();
        return view("cms.settings.config.edit")->withConfig($config);
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
            'value' => "required|min:2",
        ]);
        $config = Config::where('id','=',$id)->live()->firstOrFail();
        $config->name    = $request->input('name');
        $config->value   = $request->input('value');
        if($config->save()) {
            return redirect('settings/config/' . $config->id . '/edit')->with('custom_success', trans('app.definition').trans('app.successfully_saved'));
        }else
            return redirect('settings/config/'.$config->id.'/edit')->withErrors(['name' => trans('app.an_error_occured')])->withInput($request->input());
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
            $config = Config::where('id','=',$id)->live()->firstOrFail();
            $config->status = -1;
            $config->save();
            echo "ok";
        }
	}

}
