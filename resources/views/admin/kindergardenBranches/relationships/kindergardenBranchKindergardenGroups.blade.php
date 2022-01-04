@can('kindergarden_group_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.kindergarden-groups.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.kindergardenGroup.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.kindergardenGroup.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-kindergardenBranchKindergardenGroups">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.kindergardenGroup.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.kindergardenGroup.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.kindergardenGroup.fields.vacancy') }}
                        </th>
                        <th>
                            {{ trans('cruds.kindergardenGroup.fields.kindergarden_branch') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kindergardenGroups as $key => $kindergardenGroup)
                        <tr data-entry-id="{{ $kindergardenGroup->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $kindergardenGroup->id ?? '' }}
                            </td>
                            <td>
                                {{ $kindergardenGroup->name ?? '' }}
                            </td>
                            <td>
                                {{ $kindergardenGroup->vacancy ?? '' }}
                            </td>
                            <td>
                                {{ $kindergardenGroup->kindergarden_branch->name ?? '' }}
                            </td>
                            <td>
                                @can('kindergarden_group_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.kindergarden-groups.show', $kindergardenGroup->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('kindergarden_group_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.kindergarden-groups.edit', $kindergardenGroup->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('kindergarden_group_delete')
                                    <form action="{{ route('admin.kindergarden-groups.destroy', $kindergardenGroup->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('kindergarden_group_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.kindergarden-groups.massDestroy') }}",
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
  let table = $('.datatable-kindergardenBranchKindergardenGroups:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection