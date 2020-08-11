<?php

namespace App\Http\Controllers\Admin;
use DB;
use App\User;
use App\ManifestCustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreManifestCustomersRequest;
use App\Http\Requests\Admin\UpdateManifestCustomersRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ManifestCustomersController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of Bath.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('manifiestos')) {
            return abort(401);
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('manifiestos')) {
                return abort(401);
            }
            $manifestcustomers = ManifestCustomer::onlyTrashed()->get();
        } else {
            $manifestcustomers = ManifestCustomer::all();
        }

        return view('admin.manifestcustomers.index', compact('manifestcustomers'));
    }
    
   /**
     * Show the form for creating new Bath.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('manifiestos')) {
            return abort(401);
        }

        $sector = \App\Sector::get()->pluck('name', 'id');

        return view('admin.manifestcustomers.create', compact('sector'));
    }

        /**
     * Store a newly created Bath in storage.
     *
     * @param  \App\Http\Requests\StoreManifestCustomersRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreManifestCustomersRequest $request)
    {
        if (! Gate::allows('manifiestos')) {
            return abort(401);
        }

        $request  = $this->saveFiles($request);
        $manifestcustomers = ManifestCustomer::create($request->all());
        $manifestcustiname = str_replace(' ', '',Str::lower($manifestcustomers->name));

        $password = Hash::make($manifestcustomers->ruc);

        $var = DB::table('users')->insertGetId(
            ['name' => $manifestcustomers->name,'email' => $manifestcustiname.'@serviciosmotta.com', 'password' => $password ,'company' => $manifestcustomers->name,'manifest_customers_id' => $manifestcustomers->id]
        );

        DB::table('role_user')->insertGetId(
           ['role_id' => 5, 'user_id' => $var]
        );


        return redirect()->route('admin.manifestcustomers.index');
    }
    
    /**
     * Show the form for editing Bath.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('manifiestos')) {
            return abort(401);
        }

        $manifestcustomer = ManifestCustomer::findOrFail($id);

        $sector = \App\Sector::get()->pluck('name', 'id');

        return view('admin.manifestcustomers.edit', compact('manifestcustomer','sector'));
    }

    /**
     * Update Bath in storage.
     *
     * @param  \App\Http\Requests\UpdateManifestCustomersRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateManifestCustomersRequest $request, $id)
    {
        if (! Gate::allows('manifiestos')) {
            return abort(401);
        }

        $request  = $this->saveFiles($request);
        $manifestcustomer = ManifestCustomer::findOrFail($id);
        $manifestcustomer->update($request->all());

        return redirect()->route('admin.manifestcustomers.index');
    }


    /**
     * Display Bath.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('manifiestos')) {
            return abort(401);
        }

        $manifestcustomer  = ManifestCustomer::findOrFail($id);

        return view('admin.manifestcustomers.show', compact('manifestcustomer'));
    }


    /**
     * Remove Bath from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('manifiestos')) {
            return abort(401);
        }

        $manifestcustomer = ManifestCustomer::findOrFail($id);
        $manifestcustomer->delete();

        return redirect()->route('admin.manifestcustomers.index');
    }

    /**
     * Delete all selected Bath at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('manifiestos')) {
            return abort(401);
        }

        if ($request->input('ids')) {
            $entries = ManifestCustomer::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }




    /**
     * Restore Bath from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('manifiestos')) {
            return abort(401);
        }

        $manifestcustomer = ManifestCustomer::onlyTrashed()->findOrFail($id);
        $manifestcustomer->restore();

        return redirect()->route('admin.manifestcustomers.index');
    }

    /**
     * Permanently delete Bath from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('manifiestos')) {
            return abort(401);
        }

        $manifestcustomer = ManifestCustomer::onlyTrashed()->findOrFail($id);
        $manifestcustomer->forceDelete();

        return redirect()->route('admin.manifestcustomers.index');
    }


}
