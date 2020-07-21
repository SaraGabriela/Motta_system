<?php

namespace App\Http\Controllers\Admin;
use App\Ingresos_extra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreIngresos_extrasRequest;
use App\Http\Requests\Admin\UpdateIngresos_extrasRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class Ingresos_extrasController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Ingresos_extra.
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
            $ingresos_extras = Ingresos_extra::onlyTrashed()->get();
        } else {
            $ingresos_extras = Ingresos_extra::all();
            $ingresos_extras = Ingresos_extra::whereBetween('created_at', [$request->get('from'), $request->get('to')])->get();   
        }

        return view('admin.ingresos_extras.index', compact('ingresos_extras'));
    }

    /**
     * Show the form for creating new Ingresos_extra.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }
        
        $workers = \App\Worker::get()->pluck('nombre_del_trabajador', 'id');

        return view('admin.ingresos_extras.create', compact('workers'));
    }

    /**
     * Store a newly created Ingresos_extra in storage.
     *
     * @param  \App\Http\Requests\StoreIngresos_extrasRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIngresos_extrasRequest $request)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $request  = $this->saveFiles($request);
        $ingresos_extra = Ingresos_extra::create($request->all());


        return redirect()->route('admin.ingresos_extras.index');
    }


    /**
     * Show the form for editing Ingresos_extra.
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
        $ingresos_extra   = Ingresos_extra::findOrFail($id);

        return view('admin.ingresos_extras.edit', compact('ingresos_extra', 'workers'));
    }

    /**
     * Update Ingresos_extra in storage.
     *
     * @param  \App\Http\Requests\UpdateIngresos_extrasRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIngresos_extrasRequest $request, $id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $request  = $this->saveFiles($request);
        $ingresos_extra = Ingresos_extra::findOrFail($id);
        $ingresos_extra->update($request->all());


        return redirect()->route('admin.ingresos_extras.index');
    }


    /**
     * Display Ingresos_extra.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $ingresos_extra = Ingresos_extra::findOrFail($id);

        return view('admin.ingresos_extras.show', compact('ingresos_extra'));
    }


    /**
     * Remove Ingresos_extra from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $ingresos_extra = Ingresos_extra::findOrFail($id);
        $ingresos_extra->delete();

        return redirect()->route('admin.ingresos_extras.index');
    }

    /**
     * Delete all selected Ingresos_extra at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        if ($request->input('ids')) {
            $entries = Ingresos_extra::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Ingresos_extra from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $ingresos_extra = Ingresos_extra::onlyTrashed()->findOrFail($id);
        $ingresos_extra->restore();

        return redirect()->route('admin.ingresos_extras.index');
    }

    /**
     * Permanently delete Ingresos_extra from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('planilla')) {
            return abort(401);
        }
        
        $ingresos_extra = Ingresos_extra::onlyTrashed()->findOrFail($id);
        $ingresos_extra->forceDelete();

        return redirect()->route('admin.ingresos_extras.index');
    }
}
