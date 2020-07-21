<?php

namespace App\Http\Controllers\Admin;

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
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('planilla')) {
                return abort(401);
            }
            $manifests = Manifest::onlyTrashed()->get();

        } else {
            
            $manifests = Manifest::all();
            //dd($manifests);
            
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
        if (! Gate::allows('planilla')) {
            return abort(401);
        }
        
        $user = \App\User::get()->pluck('name', 'id');

        return view('admin.manifests.create', compact('user'));
    }

    /**
     * Store a newly created Manifest in storage.
     *
     * @param  \App\Http\Requests\StoreManifestsRequest $request
     * @return \Illuminate\Http\Response
     */

    public function store(StoreManifestsRequest $request)
    {
        if (! Gate::allows('planilla')) {
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
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $user = \App\User::get()->pluck('name', 'id');
        $manifest   = Manifest::findOrFail($id);

        return view('admin.manifests.edit', compact('manifest', 'user'));
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
        if (! Gate::allows('planilla')) {
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
        if (! Gate::allows('planilla')) {
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
        if (! Gate::allows('planilla')) {
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
        if (! Gate::allows('planilla')) {
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
        if (! Gate::allows('planilla')) {
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
        if (! Gate::allows('planilla')) {
            return abort(401);
        }

        $manifest = Manifest::onlyTrashed()->findOrFail($id);
        $manifest->forceDelete();

        return redirect()->route('admin.manifests.index');
    }
}
