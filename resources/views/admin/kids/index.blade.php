@extends('layouts.admin')
@section('content')
@can('kid_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.kids.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.kid.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.kid.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Kid">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.kid.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.kid.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.kid.fields.lastname') }}
                        </th>
                        <th>
                            {{ trans('cruds.kid.fields.id_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.kid.fields.date_of_birth') }}
                        </th>
                        <th>
                            {{ trans('cruds.kid.fields.parent_guardian') }}
                        </th>
                        <th>
                            {{ trans('cruds.parentGuardian.fields.id_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.kid.fields.branch') }}
                        </th>
                        <th>
                            {{ trans('cruds.kid.fields.group') }}
                        </th>
                        <th>
                            {{ trans('cruds.kindergardenGroup.fields.vacancy') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kids as $key => $kid)
                        <tr data-entry-id="{{ $kid->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $kid->id ?? '' }}
                            </td>
                            <td>
                                {{ $kid->name ?? '' }}
                            </td>
                            <td>
                                {{ $kid->lastname ?? '' }}
                            </td>
                            <td>
                                {{ $kid->id_number ?? '' }}
                            </td>
                            <td>
                                {{ $kid->date_of_birth ?? '' }}
                            </td>
                            <td>
                                {{ $kid->parent_guardian->id_number ?? '' }}
                            </td>
                            <td>
                                {{ $kid->parent_guardian->id_number ?? '' }}
                            </td>
                            <td>
                                {{ $kid->branch->name ?? '' }}
                            </td>
                            <td>
                                {{ $kid->group->name ?? '' }}
                            </td>
                            <td>
                                {{ $kid->group->vacancy ?? '' }}
                            </td>
                            <td>
                                @can('kid_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.kids.show', $kid->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('kid_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.kids.edit', $kid->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('kid_delete')
                                    <form action="{{ route('admin.kids.destroy', $kid->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('kid_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.kids.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Kid:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection