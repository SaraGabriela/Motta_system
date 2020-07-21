<?php

namespace App\Http\Controllers\Admin;

use App\Ingreso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreIngresosRequest;
use App\Http\Requests\Admin\UpdateIngresosRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class IngresosController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Ingreso.
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
            $ingresos = Ingreso::onlyTrashed()->get();
        } else {
            $ingresos = Ingreso::all();
            $ingresos = Ingreso::whereBetween('created_at', [$request->get('from'), $request->get('to')])->get();   
        }

        return view('admin.ingresos.index', compact('ingresos'));
    }

    /**
     * Show the form for creating new Ingreso.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }
        
        $workers = \App\Worker::get()->pluck('nombre_del_trabajador', 'id');

        return view('admin.ingresos.create', compact('workers'));
    }

    /**
     * Store a newly created Ingreso in storage.
     *
     * @param  \App\Http\Requests\StoreIngresosRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIngresosRequest $request)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $request  = $this->saveFiles($request);
        $ingreso = Ingreso::create($request->all());


        return redirect()->route('admin.ingresos.index');
    }


    /**
     * Show the form for editing Ingreso.
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
        $ingreso   = Ingreso::findOrFail($id);

        return view('admin.ingresos.edit', compact('ingreso', 'workers'));
    }

    /**
     * Update Ingreso in storage.
     *
     * @param  \App\Http\Requests\UpdateIngresosRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIngresosRequest $request, $id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $request  = $this->saveFiles($request);
        $ingreso = Ingreso::findOrFail($id);
        $ingreso->update($request->all());


        return redirect()->route('admin.ingresos.index');
    }


    /**
     * Display Ingreso.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $ingreso = Ingreso::findOrFail($id);

        return view('admin.ingresos.show', compact('ingreso'));
    }


    /**
     * Remove Ingreso from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $ingreso = Ingreso::findOrFail($id);
        $ingreso->delete();

        return redirect()->route('admin.ingresos.index');
    }

    /**
     * Delete all selected Ingreso at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        if ($request->input('ids')) {
            $entries = Ingreso::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Ingreso from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $ingreso = Ingreso::onlyTrashed()->findOrFail($id);
        $ingreso->restore();

        return redirect()->route('admin.ingresos.index');
    }

    /**
     * Permanently delete Ingreso from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $ingreso = Ingreso::onlyTrashed()->findOrFail($id);
        $ingreso->forceDelete();

        return redirect()->route('admin.ingresos.index');
    }
}
