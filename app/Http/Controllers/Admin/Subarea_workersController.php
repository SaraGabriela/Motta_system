<?php

namespace App\Http\Controllers\Admin;

use App\Subarea_worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSubarea_workersRequest;
use App\Http\Requests\Admin\UpdateSubarea_workersRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class Subarea_workersController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Subarea_worker.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('planilla')) {
                return abort(401);
            }
            $subarea_workers = Subarea_worker::onlyTrashed()->get();
        } else {
            $subarea_workers = Subarea_worker::all();
        }

        return view('admin.subarea_workers.index', compact('subarea_workers'));
    }
    
   /**
     * Show the form for creating new Subarea_worker.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $area_workers = \App\Area_worker::get()->pluck('nombre', 'id');
        
        return view('admin.subarea_workers.create', compact('area_workers'));
    }

        /**
     * Store a newly created Subarea_worker in storage.
     *
     * @param  \App\Http\Requests\StoreSubarea_workersRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubarea_workersRequest $request)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }
        
        $request  = $this->saveFiles($request);
        $subarea_workers = Subarea_worker::create($request->all());
        $subarea_workers->area_worker()->sync(array_filter((array)$request->input('area_worker')));

        return redirect()->route('admin.subarea_workers.index');
    }
    
    /**
     * Show the form for editing Subarea_worker.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $subarea_worker = Subarea_worker::findOrFail($id);

        return view('admin.subarea_workers.edit', compact('subarea_worker'));
    }

    /**
     * Update Subarea_worker in storage.
     *
     * @param  \App\Http\Requests\UpdateSubarea_workersRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubarea_workersRequest $request, $id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $subarea_workers = Subarea_worker::findOrFail($id);
        $subarea_workers->update($request->all());
        $subarea_workers->area_worker()->sync(array_filter((array)$request->input('role')));

        return redirect()->route('admin.subarea_workers.index');
    }


    /**
     * Display Subarea_worker.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $subarea_worker  = Subarea_worker::findOrFail($id);

        return view('admin.subarea_workers.show', compact('subarea_worker'));
    }


    /**
     * Remove Subarea_worker from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $subarea_worker = Subarea_worker::findOrFail($id);
        $subarea_worker->delete();

        return redirect()->route('admin.subarea_workers.index');
    }

    /**
     * Delete all selected Subarea_worker at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        if ($request->input('ids')) {
            $entries = Subarea_worker::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    
    /**
     * Delete all selected Subarea_worker at once.
     *
     * @param Request $request
     */
    public function massQR(Request $request)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        if ($request->input('ids')) {
            $entries = Subarea_worker::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry = QrCode::size(300)->generate("$subarea_worker->code_qr");

               // <td field-key='codigo_qr'>{!!QrCode::size(300)->generate("$subarea_worker->code_qr") !!}
               download($entry, 'filename.png');
                
               //return Response::download( $file , 'logo.png' , array( 'Content-Type' => 'image/png' ) )->setContentDisposition('inline');

            }
        }
    }







    /**
     * Restore Subarea_worker from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $subarea_worker = Subarea_worker::onlyTrashed()->findOrFail($id);
        $subarea_worker->restore();

        return redirect()->route('admin.subarea_workers.index');
    }

    /**
     * Permanently delete Subarea_worker from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $subarea_worker = Subarea_worker::onlyTrashed()->findOrFail($id);
        $subarea_worker->forceDelete();

        return redirect()->route('admin.subarea_workers.index');
    }


}
