@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.parentGuardian.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.parent-guardians.update", [$parentGuardian->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.parentGuardian.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $parentGuardian->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.parentGuardian.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="lastname">{{ trans('cruds.parentGuardian.fields.lastname') }}</label>
                <input class="form-control {{ $errors->has('lastname') ? 'is-invalid' : '' }}" type="text" name="lastname" id="lastname" value="{{ old('lastname', $parentGuardian->lastname) }}" required>
                @if($errors->has('lastname'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lastname') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.parentGuardian.fields.lastname_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.parentGuardian.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $parentGuardian->email) }}">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.parentGuardian.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="guardian_type">{{ trans('cruds.parentGuardian.fields.guardian_type') }}</label>
                <select class="form-select" class="form-control {{ $errors->has('guardian_type') ? 'is-invalid' : '' }}" type="text" name="guardian_type" id="guardian_type" value="{{ old('guardian_type', '') }}" required>
                    <option selected>მეურვის ტიპი</option>
                    <option value="1">დედა</option>
                    <option value="2">მამა</option>
                    <option value="3">მეურვე</option>
                </select>
                @if($errors->has('guardian_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('guardian_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.parentGuardian.fields.guardian_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="id_number">{{ trans('cruds.parentGuardian.fields.id_number') }}</label>
                <input class="form-control {{ $errors->has('id_number') ? 'is-invalid' : '' }}" type="text" name="id_number" id="id_number" value="{{ old('id_number', $parentGuardian->id_number) }}" required>
                @if($errors->has('id_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('id_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.parentGuardian.fields.id_number_helper') }}</span>
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