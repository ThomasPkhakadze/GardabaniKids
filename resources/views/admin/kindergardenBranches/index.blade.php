@extends('layouts.admin')
@section('content')
@can('kindergarden_branch_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.kindergarden-branches.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.kindergardenBranch.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.kindergardenBranch.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-KindergardenBranch">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.kindergardenBranch.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.kindergardenBranch.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.kindergardenBranch.fields.address') }}
                        </th>
                        <th>
                            {{ trans('cruds.kindergardenBranch.fields.branch_manager') }}
                        </th>
                        <th>
                            {{ trans('cruds.kindergardenBranch.fields.phone') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kindergardenBranches as $key => $kindergardenBranch)
                        <tr data-entry-id="{{ $kindergardenBranch->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $kindergardenBranch->id ?? '' }}
                            </td>
                            <td>
                                {{ $kindergardenBranch->name ?? '' }}
                            </td>
                            <td>
                                {{ $kindergardenBranch->address ?? '' }}
                            </td>
                            <td>
                                {{ $kindergardenBranch->branch_manager ?? '' }}
                            </td>
                            <td>
                                {{ $kindergardenBranch->phone ?? '' }}
                            </td>
                            <td>
                                @can('kindergarden_branch_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.kindergarden-branches.show', $kindergardenBranch->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('kindergarden_branch_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.kindergarden-branches.edit', $kindergardenBranch->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('kindergarden_branch_delete')
                                    <form action="{{ route('admin.kindergarden-branches.destroy', $kindergardenBranch->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('kindergarden_branch_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.kindergarden-branches.massDestroy') }}",
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
  let table = $('.datatable-KindergardenBranch:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection