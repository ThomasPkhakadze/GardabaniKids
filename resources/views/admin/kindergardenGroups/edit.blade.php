@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.kindergardenGroup.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.kindergarden-groups.update", [$kindergardenGroup->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.kindergardenGroup.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $kindergardenGroup->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kindergardenGroup.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="vacancy">{{ trans('cruds.kindergardenGroup.fields.vacancy') }}</label>
                <input class="form-control {{ $errors->has('vacancy') ? 'is-invalid' : '' }}" type="number" name="vacancy" id="vacancy" value="{{ old('vacancy', $kindergardenGroup->vacancy) }}" step="1" required>
                @if($errors->has('vacancy'))
                    <div class="invalid-feedback">
                        {{ $errors->first('vacancy') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kindergardenGroup.fields.vacancy_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="kindergarden_branch_id">{{ trans('cruds.kindergardenGroup.fields.kindergarden_branch') }}</label>
                <select class="form-control select2 {{ $errors->has('kindergarden_branch') ? 'is-invalid' : '' }}" name="kindergarden_branch_id" id="kindergarden_branch_id" required>
                    @foreach($kindergarden_branches as $id => $entry)
                        <option value="{{ $id }}" {{ (old('kindergarden_branch_id') ? old('kindergarden_branch_id') : $kindergardenGroup->kindergarden_branch->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('kindergarden_branch'))
                    <div class="invalid-feedback">
                        {{ $errors->first('kindergarden_branch') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kindergardenGroup.fields.kindergarden_branch_helper') }}</span>
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