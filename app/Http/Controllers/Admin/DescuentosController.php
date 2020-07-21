<?php

namespace App\Http\Controllers\Admin;
use App\Descuento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDescuentosRequest;
use App\Http\Requests\Admin\UpdateDescuentosRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class DescuentosController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Descuento.
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
            $descuentos = Descuento::onlyTrashed()->get();
        } else {
            $descuentos = Descuento::all();
            $descuentos = Descuento::whereBetween('created_at', [$request->get('from'), $request->get('to')])->get();   
        }

        return view('admin.descuentos.index', compact('descuentos'));
    }

    /**
     * Show the form for creating new Descuento.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }
        
        $workers = \App\Worker::get()->pluck('nombre_del_trabajador', 'id');

        return view('admin.descuentos.create', compact('workers'));
    }

    /**
     * Store a newly created Descuento in storage.
     *
     * @param  \App\Http\Requests\StoreDescuentosRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDescuentosRequest $request)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $request  = $this->saveFiles($request);
        $descuento = Descuento::create($request->all());


        return redirect()->route('admin.descuentos.index');
    }


    /**
     * Show the form for editing Descuento.
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
        $descuento   = Descuento::findOrFail($id);

        return view('admin.descuentos.edit', compact('descuento', 'workers'));
    }

    /**
     * Update Descuento in storage.
     *
     * @param  \App\Http\Requests\UpdateDescuentosRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDescuentosRequest $request, $id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $request  = $this->saveFiles($request);
        $descuento = Descuento::findOrFail($id);
        $descuento->update($request->all());


        return redirect()->route('admin.descuentos.index');
    }


    /**
     * Display Descuento.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $descuento = Descuento::findOrFail($id);

        return view('admin.descuentos.show', compact('descuento'));
    }


    /**
     * Remove Descuento from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $descuento = Descuento::findOrFail($id);
        $descuento->delete();

        return redirect()->route('admin.descuentos.index');
    }

    /**
     * Delete all selected Descuento at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        if ($request->input('ids')) {
            $entries = Descuento::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Descuento from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $descuento = Descuento::onlyTrashed()->findOrFail($id);
        $descuento->restore();

        return redirect()->route('admin.descuentos.index');
    }

    /**
     * Permanently delete Descuento from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $descuento = Descuento::onlyTrashed()->findOrFail($id);
        $descuento->forceDelete();

        return redirect()->route('admin.descuentos.index');
    }
}
