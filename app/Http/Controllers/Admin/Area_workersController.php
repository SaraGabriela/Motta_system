<?php

namespace App\Http\Controllers\Admin;

use App\Area_worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreArea_workersRequest;
use App\Http\Requests\Admin\UpdateArea_workersRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class Area_workersController extends Controller
{
 
    use FileUploadTrait;

    /**
     * Display a listing of Area_worker.
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
            $area_workers = Area_worker::onlyTrashed()->get();
        } else {
            $area_workers = Area_worker::all();
        }

        return view('admin.area_workers.index', compact('area_workers'));
    }
    
   /**
     * Show the form for creating new Area_worker.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        return view('admin.area_workers.create');
    }

        /**
     * Store a newly created Area_worker in storage.
     *
     * @param  \App\Http\Requests\StoreArea_workersRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArea_workersRequest $request)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $request  = $this->saveFiles($request);
        $area_workers = Area_worker::create($request->all());

        return redirect()->route('admin.area_workers.index');
    }
    
    /**
     * Show the form for editing Area_worker.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $area_worker = Area_worker::findOrFail($id);

        return view('admin.area_workers.edit', compact('area_worker'));
    }

    /**
     * Update Area_worker in storage.
     *
     * @param  \App\Http\Requests\UpdateArea_workersRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArea_workersRequest $request, $id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $request  = $this->saveFiles($request);
        $area_worker = Area_worker::findOrFail($id);
        $area_worker->update($request->all());

        return redirect()->route('admin.area_workers.index');
    }


    /**
     * Display Area_worker.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $area_worker  = Area_worker::findOrFail($id);

        return view('admin.area_workers.show', compact('area_worker'));
    }


    /**
     * Remove Area_worker from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $area_worker = Area_worker::findOrFail($id);
        $area_worker->delete();

        return redirect()->route('admin.area_workers.index');
    }

    /**
     * Delete all selected Area_worker at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        if ($request->input('ids')) {
            $entries = Area_worker::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    
    /**
     * Delete all selected Area_worker at once.
     *
     * @param Request $request
     */
    public function massQR(Request $request)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        if ($request->input('ids')) {
            $entries = Area_worker::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry = QrCode::size(300)->generate("$area_worker->code_qr");

               // <td field-key='codigo_qr'>{!!QrCode::size(300)->generate("$area_worker->code_qr") !!}
               download($entry, 'filename.png');
                
               //return Response::download( $file , 'logo.png' , array( 'Content-Type' => 'image/png' ) )->setContentDisposition('inline');

            }
        }
    }







    /**
     * Restore Area_worker from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $area_worker = Area_worker::onlyTrashed()->findOrFail($id);
        $area_worker->restore();

        return redirect()->route('admin.area_workers.index');
    }

    /**
     * Permanently delete Area_worker from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $area_worker = Area_worker::onlyTrashed()->findOrFail($id);
        $area_worker->forceDelete();

        return redirect()->route('admin.area_workers.index');
    }
    

}
