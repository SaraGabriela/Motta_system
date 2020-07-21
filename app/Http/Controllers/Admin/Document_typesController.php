<?php

namespace App\Http\Controllers\Admin;

use App\Document_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDocument_typesRequest;
use App\Http\Requests\Admin\UpdateDocument_typesRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class Document_typesController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of Bath.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('administrador')) {
            return abort(401);
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('administrador')) {
                return abort(401);
            }
            $document_types = Document_type::onlyTrashed()->get();
        } else {
            $document_types = Document_type::all();
        }

        return view('admin.document_types.index', compact('document_types'));
    }
    
   /**
     * Show the form for creating new Bath.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('administrador')) {
            return abort(401);
        }

        return view('admin.document_types.create');
    }

        /**
     * Store a newly created Bath in storage.
     *
     * @param  \App\Http\Requests\StoreDocument_typesRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDocument_typesRequest $request)
    {
        if (! Gate::allows('administrador')) {
            return abort(401);
        }
        $request  = $this->saveFiles($request);
        $document_types = Document_type::create($request->all());

        return redirect()->route('admin.document_types.index');
    }
    
    /**
     * Show the form for editing Bath.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('administrador')) {
            return abort(401);
        }

        $document_type = Document_type::findOrFail($id);

        return view('admin.document_types.edit', compact('document_type'));
    }

    /**
     * Update Bath in storage.
     *
     * @param  \App\Http\Requests\UpdateDocument_typesRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDocument_typesRequest $request, $id)
    {
        if (! Gate::allows('administrador')) {
            return abort(401);
        }
        $request  = $this->saveFiles($request);
        $document_type = Document_type::findOrFail($id);
        $document_type->update($request->all());

        return redirect()->route('admin.document_types.index');
    }


    /**
     * Display Bath.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('administrador')) {
            return abort(401);
        }

        $document_type  = Document_type::findOrFail($id);

        return view('admin.document_types.show', compact('document_type'));
    }


    /**
     * Remove Bath from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('administrador')) {
            return abort(401);
        }

        $document_type = Document_type::findOrFail($id);
        $document_type->delete();

        return redirect()->route('admin.document_types.index');
    }

    /**
     * Delete all selected Bath at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('administrador')) {
            return abort(401);
        }

        if ($request->input('ids')) {
            $entries = Document_type::whereIn('id', $request->input('ids'))->get();

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
        if (! Gate::allows('administrador')) {
            return abort(401);
        }

        $document_type = Document_type::onlyTrashed()->findOrFail($id);
        $document_type->restore();

        return redirect()->route('admin.document_types.index');
    }

    /**
     * Permanently delete Bath from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    
    public function perma_del($id)
    {
        if (! Gate::allows('administrador')) {
            return abort(401);
        }

        $document_type = Document_type::onlyTrashed()->findOrFail($id);
        $document_type->forceDelete();

        return redirect()->route('admin.document_types.index');
    }


}
