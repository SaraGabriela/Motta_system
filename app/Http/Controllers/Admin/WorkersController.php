<?php

namespace App\Http\Controllers\Admin;

use App\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreWorkersRequest;
use App\Http\Requests\Admin\UpdateWorkersRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class WorkersController extends Controller
{
    use FileUploadTrait;

    

    
    /**
     * Display a listing of Worker.
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
            $workers = Worker::onlyTrashed()->get();
        } else {
            $workers = Worker::all();
        }

        return view('admin.workers.index', compact('workers'));
    }
    
   /**
     * Show the form for creating new Worker.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $job_titles = \App\Job_title::get()->pluck('nombre', 'id');
        
        $area_workers = \App\Area_worker::get()->pluck('nombre', 'id');

        $subarea_workers = \App\Subarea_worker::get()->pluck('nombre', 'id');



        $pensions = \App\Pension::get()->pluck('nombre', 'id');


        return view('admin.workers.create', compact('job_titles','area_workers','subarea_workers','pensions'));
    }

        /**
     * Store a newly created Worker in storage.
     *
     * @param  \App\Http\Requests\StoreWorkersRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWorkersRequest $request)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }


        $request  = $this->saveFiles($request);
        $workers = Worker::create($request->all());
        $workers->job_title()->sync(array_filter((array)$request->input('job_title')));
        $workers->area_worker()->sync(array_filter((array)$request->input('area_worker')));
        $workers->subarea_worker()->sync(array_filter((array)$request->input('subarea_worker')));

        return redirect()->route('admin.workers.index');
    }
    
    /**
     * Show the form for editing Worker.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $job_titles = \App\Job_title::get()->pluck('nombre', 'id');
        
        $area_workers = \App\Area_worker::get()->pluck('nombre', 'id');

        $subarea_workers = \App\Subarea_worker::get()->pluck('nombre', 'id');

        $pensions = \App\Pension::get()->pluck('nombre', 'id');

        $worker = Worker::findOrFail($id);

        return view('admin.workers.edit', compact('worker','job_titles','area_workers','subarea_workers','pensions'));
    }

    /**
     * Update Worker in storage.
     *
     * @param  \App\Http\Requests\UpdateWorkersRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWorkersRequest $request, $id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $request  = $this->saveFiles($request);
        $worker = Worker::findOrFail($id);
        $worker->update($request->all());

        return redirect()->route('admin.workers.index');
    }


    /**
     * Display Worker.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $worker  = Worker::findOrFail($id);

        return view('admin.workers.show', compact('worker'));
    }


    /**
     * Remove Worker from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $worker = Worker::findOrFail($id);
        $worker->delete();

        return redirect()->route('admin.workers.index');
    }

    /**
     * Delete all selected Worker at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        if ($request->input('ids')) {
            $entries = Worker::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    
    /**
     * Delete all selected Worker at once.
     *
     * @param Request $request
     */
    public function massQR(Request $request)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        if ($request->input('ids')) {
            $entries = Worker::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry = QrCode::size(300)->generate("$worker->code_qr");

               // <td field-key='codigo_qr'>{!!QrCode::size(300)->generate("$worker->code_qr") !!}
               download($entry, 'filename.png');
                
               //return Response::download( $file , 'logo.png' , array( 'Content-Type' => 'image/png' ) )->setContentDisposition('inline');

            }
        }
    }







    /**
     * Restore Worker from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $worker = Worker::onlyTrashed()->findOrFail($id);
        $worker->restore();

        return redirect()->route('admin.workers.index');
    }

    /**
     * Permanently delete Worker from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $worker = Worker::onlyTrashed()->findOrFail($id);
        $worker->forceDelete();

        return redirect()->route('admin.workers.index');
    }


}
