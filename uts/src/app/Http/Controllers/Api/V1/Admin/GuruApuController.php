<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGuruRequest;
use App\Http\Requests\UpdateGuruRequest;
use App\Http\Resources\Admin\GuruResource;
use App\Models\Guru;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GuruApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('guru_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GuruResource(Guru::all());
    }

    public function store(StoreGuruRequest $request)
    {
        $guru = Guru::create($request->all());

        return (new GuruResource($guru))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Guru $guru)
    {
        abort_if(Gate::denies('guru_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GuruResource($guru);
    }

    public function update(UpdateGuruRequest $request, Guru $guru)
    {
        $guru->update($request->all());

        return (new GuruResource($guru))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Guru $guru)
    {
        abort_if(Gate::denies('guru_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $guru->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
