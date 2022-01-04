@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.kindergardenBranch.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.kindergarden-branches.update", [$kindergardenBranch->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.kindergardenBranch.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $kindergardenBranch->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kindergardenBranch.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="address">{{ trans('cruds.kindergardenBranch.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $kindergardenBranch->address) }}" required>
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kindergardenBranch.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="branch_manager">{{ trans('cruds.kindergardenBranch.fields.branch_manager') }}</label>
                <input class="form-control {{ $errors->has('branch_manager') ? 'is-invalid' : '' }}" type="text" name="branch_manager" id="branch_manager" value="{{ old('branch_manager', $kindergardenBranch->branch_manager) }}" required>
                @if($errors->has('branch_manager'))
                    <div class="invalid-feedback">
                        {{ $errors->first('branch_manager') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kindergardenBranch.fields.branch_manager_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone">{{ trans('cruds.kindergardenBranch.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="number" name="phone" id="phone" value="{{ old('phone', $kindergardenBranch->phone) }}" step="1">
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kindergardenBranch.fields.phone_helper') }}</span>
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