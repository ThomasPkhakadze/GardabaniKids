@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.parentGuardian.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.parent-guardians.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.parentGuardian.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.parentGuardian.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="lastname">{{ trans('cruds.parentGuardian.fields.lastname') }}</label>
                <input class="form-control {{ $errors->has('lastname') ? 'is-invalid' : '' }}" type="text" name="lastname" id="lastname" value="{{ old('lastname', '') }}" required>
                @if($errors->has('lastname'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lastname') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.parentGuardian.fields.lastname_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.parentGuardian.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.parentGuardian.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="id_number">{{ trans('cruds.parentGuardian.fields.id_number') }}</label>
                <input class="form-control {{ $errors->has('id_number') ? 'is-invalid' : '' }}" type="number" name="id_number" id="id_number" value="{{ old('id_number', '') }}" step="1" required>
                @if($errors->has('id_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('id_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.parentGuardian.fields.id_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="guardian_type">{{ trans('cruds.parentGuardian.fields.guardian_type') }}</label>
                <input class="form-control {{ $errors->has('guardian_type') ? 'is-invalid' : '' }}" type="text" name="guardian_type" id="guardian_type" value="{{ old('guardian_type', '') }}" required>
                @if($errors->has('guardian_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('guardian_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.parentGuardian.fields.guardian_type_helper') }}</span>
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