<?php

namespace App\Http\Controllers\Admin;
use App\Asistencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAsistenciasRequest;
use App\Http\Requests\Admin\UpdateAsistenciasRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class AsistenciasController extends Controller 
{
    use FileUploadTrait;

    /**
     * Display a listing of Asistencia.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }
        
        if (request('show_deleted') == 1) {
            if (! Gate::allows('planilla')) {
                return abort(401);
            }
            $asistencias = Asistencia::onlyTrashed()->get();
        } else {
            $asistencias = Asistencia::all();
            $asistencias = Asistencia::whereBetween('created_at', [$request->get('from'), $request->get('to')])->get();   
        }

        return view('admin.asistencias.index', compact('asistencias'));
    }

    /**
     * Show the form for creating new Asistencia.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }
        
        $workers = \App\Worker::get()->pluck('nombre_del_trabajador', 'id');

        return view('admin.asistencias.create', compact('workers'));
    }

    /**
     * Store a newly created Asistencia in storage.
     *
     * @param  \App\Http\Requests\StoreAsistenciasRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAsistenciasRequest $request)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $request  = $this->saveFiles($request);
        $asistencia = Asistencia::create($request->all());


        return redirect()->route('admin.asistencias.index');
    }


    /**
     * Show the form for editing Asistencia.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $workers = \App\Worker::get()->pluck('nombre_del_trabajador', 'id');
        $asistencia   = Asistencia::findOrFail($id);

        return view('admin.asistencias.edit', compact('asistencia', 'workers'));
    }

    /**
     * Update Asistencia in storage.
     *
     * @param  \App\Http\Requests\UpdateAsistenciasRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAsistenciasRequest $request, $id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $request  = $this->saveFiles($request);
        $asistencia = Asistencia::findOrFail($id);
        $asistencia->update($request->all());


        return redirect()->route('admin.asistencias.index');
    }


    /**
     * Display Asistencia.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $asistencia = Asistencia::findOrFail($id);

        return view('admin.asistencias.show', compact('asistencia'));
    }


    /**
     * Remove Asistencia from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $asistencia = Asistencia::findOrFail($id);
        $asistencia->delete();

        return redirect()->route('admin.asistencias.index');
    }

    /**
     * Delete all selected Asistencia at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        if ($request->input('ids')) {
            $entries = Asistencia::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Asistencia from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $asistencia = Asistencia::onlyTrashed()->findOrFail($id);
        $asistencia->restore();

        return redirect()->route('admin.asistencias.index');
    }

    /**
     * Permanently delete Asistencia from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $asistencia = Asistencia::onlyTrashed()->findOrFail($id);
        $asistencia->forceDelete();

        return redirect()->route('admin.asistencias.index');
    }
}
