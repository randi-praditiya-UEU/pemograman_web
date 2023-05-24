@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.guru.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.gurus.update", [$guru->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="nip">{{ trans('cruds.guru.fields.nip') }}</label>
                <input class="form-control {{ $errors->has('nip') ? 'is-invalid' : '' }}" type="text" name="nip" id="nip" value="{{ old('nip', $guru->nip) }}" required>
                @if($errors->has('nip'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nip') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.guru.fields.nip_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="nama">{{ trans('cruds.guru.fields.nama') }}</label>
                <input class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}" type="text" name="nama" id="nama" value="{{ old('nama', $guru->nama) }}" required>
                @if($errors->has('nama'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nama') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.guru.fields.nama_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="pangkat">{{ trans('cruds.guru.fields.pangkat') }}</label>
                <input class="form-control {{ $errors->has('pangkat') ? 'is-invalid' : '' }}" type="text" name="pangkat" id="pangkat" value="{{ old('pangkat', $guru->pangkat) }}" required>
                @if($errors->has('pangkat'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pangkat') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.guru.fields.pangkat_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection