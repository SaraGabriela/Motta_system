<?php

namespace App\Http\Controllers\Admin;
use DB;
use App\Manifest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreManifestsRequest;
use App\Http\Requests\Admin\UpdateManifestsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class ManifestsController extends Controller
{
    use FileUploadTrait;
    
    /**
     * Display a listing of Manifest.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        if (! Gate::allows('manifiestos_cliente')) {
            return abort(401);
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('manifiestos_cliente')) {
                return abort(401);
            }
            $manifests = Manifest::onlyTrashed()->get();

        } else {
            
            if (Gate::allows('manifiestos')) {
                //dd($request->get('to'));
                if($request->get('from')  == null && $request->get('to') == null){
                    $manifests = Manifest::whereBetween('manifests.created_at', ['1999-01-01', '2999-01-01'])
                    ->join('manifest_customers', 'manifest_customers.id', '=', 'manifests.id_customer')
                    ->join('document_types', 'manifests.id_typedocument', '=', 'document_types.id')
                    ->join('sectors', 'manifest_customers.id_sector', '=', 'sectors.id')
                    ->select('manifests.id','manifest_customers.name as manifest_customersname','manifests.attached','manifests.pick_date','document_types.name as document_typesname','sectors.name as sector_name','manifest_customers.ruc as ruc_customer')
                    ->get();

                    return view('admin.manifests.index', compact('manifests'));
                }
                $manifests = Manifest::whereBetween('manifests.created_at', [$request->get('from'), $request->get('to')])
                ->join('manifest_customers', 'manifest_customers.id', '=', 'manifests.id_customer')
                ->join('document_types', 'manifests.id_typedocument', '=', 'document_types.id')
                ->join('sectors', 'manifest_customers.id_sector', '=', 'sectors.id')
                ->select('manifests.id','manifest_customers.name as manifest_customersname','manifests.attached','manifests.pick_date','document_types.name as document_typesname','sectors.name as sector_name')
                ->get();


                return view('admin.manifests.index', compact('manifests'));
            }
            
            $user = \Auth::user();
            if($request->get('from')  == null && $request->get('to') == null){
                $manifests = Manifest::whereBetween('manifests.created_at', ['1999-01-01', '2999-01-01'])
                ->join('manifest_customers', 'manifest_customers.id', '=', 'manifests.id_customer')
                ->join('document_types', 'manifests.id_typedocument', '=', 'document_types.id')
                ->join('sectors', 'manifest_customers.id_sector', '=', 'sectors.id')
                ->select('manifests.id','manifest_customers.name as manifest_customersname','manifests.attached','manifests.pick_date','document_types.name as document_typesname','sectors.name as sector_name')
                ->where('manifest_customers.name','=', $user->company)
                ->get();


                return view('admin.manifests.index', compact('manifests'));
            }
            $manifests = Manifest::whereBetween('manifests.created_at', [$request->get('from'), $request->get('to')])
            ->join('manifest_customers', 'manifest_customers.id', '=', 'manifests.id_customer')
            ->join('document_types', 'manifests.id_typedocument', '=', 'document_types.id')
            ->join('sectors', 'manifest_customers.id_sector', '=', 'sectors.id')
            ->select('manifests.id','manifest_customers.name as manifest_customersname','manifests.attached','manifests.pick_date','document_types.name as document_typesname','sectors.name as sector_name')
            ->where('manifest_customers.name','=', $user->company)
            ->get();

            $fechas = Manifest::whereBetween('created_at', [$request->get('from'), $request->get('to')])->get(); 




            
        }

        return view('admin.manifests.index', compact('manifests'));
    }



    /**
     * Show the form for creating new Manifest.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('manifiestos_cliente')) {
            return abort(401);
        }
        
        $user = \App\User::get()->pluck('name', 'id');
       
        $document_type = \App\Document_type::get()->pluck('name', 'id');

        $manifestcustomer = \App\ManifestCustomer::get()->pluck('name', 'id');
        $customer_addresses = \App\Customer_address::get()->pluck('name_address', 'id');

        return view('admin.manifests.create', compact('user','manifestcustomer','document_type','customer_addresses'));
    }

    /**
     * Store a newly created Manifest in storage.
     *
     * @param  \App\Http\Requests\StoreManifestsRequest $request
     * @return \Illuminate\Http\Response
     */

    public function store(StoreManifestsRequest $request)
    {
        if (! Gate::allows('manifiestos_cliente')) {
            return abort(401);
        }

        $request  = $this->saveFiles($request);
        $manifest = Manifest::create($request->all());



        return redirect()->route('admin.manifests.index');
    }

    /**
     * Show the form for editing Manifest.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('manifiestos_cliente')) {
            return abort(401);
        }

        $user = \App\User::get()->pluck('name', 'id');
        $manifestcustomer = \App\ManifestCustomer::get()->pluck('name', 'id');
        $document_type = \App\Document_type::get()->pluck('name', 'id');

        $manifest   = Manifest::findOrFail($id);

        return view('admin.manifests.edit', compact('manifest', 'user','manifestcustomer','document_type'));
    }

    /**
     * Update Manifest in storage.
     *
     * @param  \App\Http\Requests\UpdateManifestsRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateManifestsRequest $request, $id)
    {
        if (! Gate::allows('manifiestos_cliente')) {
            return abort(401);
        }

        $request  = $this->saveFiles($request);
        $manifest = Manifest::findOrFail($id);
        $manifest->update($request->all());


        return redirect()->route('admin.manifests.index');
    }


    /**
     * Display Manifest.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('manifiestos_cliente')) {
            return abort(401);
        }
        
        $manifest = Manifest::findOrFail($id);

        return view('admin.manifests.show', compact('manifest'));
    }


    /**
     * Remove Manifest from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('manifiestos_cliente')) {
            return abort(401);
        }

        $manifest = Manifest::findOrFail($id);
        $manifest->delete();

        return redirect()->route('admin.manifests.index');
    }

    /**
     * Delete all selected Manifest at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('manifiestos_cliente')) {
            return abort(401);
        }

        if ($request->input('ids')) {
            $entries = Manifest::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Manifest from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('manifiestos_cliente')) {
            return abort(401);
        }

        $manifest = Manifest::onlyTrashed()->findOrFail($id);
        
        $manifest->restore();

        return redirect()->route('admin.manifests.index');
    }

    /**
     * Permanently delete Manifest from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('manifiestos_cliente')) {
            return abort(401);
        }
        
        $manifest = Manifest::onlyTrashed()->findOrFail($id);
        $manifest->forceDelete();

        return redirect()->route('admin.manifests.index');
    }
}
