<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyGuruRequest;
use App\Http\Requests\StoreGuruRequest;
use App\Http\Requests\UpdateGuruRequest;
use App\Models\Guru;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('guru_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Guru::query()->select(sprintf('%s.*', (new Guru)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'guru_show';
                $editGate      = 'guru_edit';
                $deleteGate    = 'guru_delete';
                $crudRoutePart = 'gurus';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('nip', function ($row) {
                return $row->nip ? $row->nip : '';
            });
            $table->editColumn('nama', function ($row) {
                return $row->nama ? $row->nama : '';
            });
            $table->editColumn('pangkat', function ($row) {
                return $row->pangkat ? $row->pangkat : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.gurus.index');
    }

    public function create()
    {
        abort_if(Gate::denies('guru_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.gurus.create');
    }

    public function store(StoreGuruRequest $request)
    {
        $guru = Guru::create($request->all());

        return redirect()->route('admin.gurus.index');
    }

    public function edit(Guru $guru)
    {
        abort_if(Gate::denies('guru_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.gurus.edit', compact('guru'));
    }

    public function update(UpdateGuruRequest $request, Guru $guru)
    {
        $guru->update($request->all());

        return redirect()->route('admin.gurus.index');
    }

    public function show(Guru $guru)
    {
        abort_if(Gate::denies('guru_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.gurus.show', compact('guru'));
    }

    public function destroy(Guru $guru)
    {
        abort_if(Gate::denies('guru_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $guru->delete();

        return back();
    }

    public function massDestroy(MassDestroyGuruRequest $request)
    {
        $gurus = Guru::find(request('ids'));

        foreach ($gurus as $guru) {
            $guru->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}