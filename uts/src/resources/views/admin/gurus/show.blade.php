@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.guru.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.gurus.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.guru.fields.id') }}
                        </th>
                        <td>
                            {{ $book->id }}
                        </td>
                        <th>
                            {{ trans('cruds.guru.fields.nip') }}
                        </th>
                        <td>
                            {{ $guru->nip }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.guru.fields.nama') }}
                        </th>
                        <td>
                            {{ $guru->nama }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.guru.fields.pangkat') }}
                        </th>
                        <td>
                            {{ $guru->pangkat }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.gurus.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection