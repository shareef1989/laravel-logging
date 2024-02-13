@extends(config('db-logging.layout'))

@section(config('db-logging.content_area'))
    <div class="card">
        <div class="card-header bg-primary">
            <h2 class="text-light">@lang('Log')</h2>
        </div>
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-md-3 form-group">
                        <label>@lang('Table')</label>
                        <select class="form-control" name="search[table]">
                            <option value="">@lang('Choose Table')</option>
                            @foreach ($tables as $tbl)
                                <option>{{ $tbl }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <label>@lang('User')</label>
                        <select class="form-control" name="search[user]">
                            <option value="">@lang('Choose User')</option>
                            @foreach ($users as $user)
                                <option>{{ $user }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <label>@lang('Action')</label>
                        <select class="form-control" name="search[action]">
                            <option value="">@lang('Choose Action')</option>
                            <option>@lang('create')</option>
                            <option>@lang('update')</option>
                            <option>@lang('delete')</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-small btn-primary mt-5">
                            <i class="fas fa-search"></i> @lang('Search')
                        </button>
                    </div>
                </div>
            </form>
            <table class="table table-striped">
                <tr class="bg-secondary text-info font-weight-bold">
                    <th>@lang('Table')</th>
                    <th>@lang('Row ID')</th>
                    <th>@lang('User')</th>
                    <th>@lang('Action')</th>
                    <th>@lang('Date')</th>
                    <th>@lang('Settings')</th>
                </tr>
                @foreach ($log as $row)
                    <tr>
                        <td>{{ $row->table }}</td>
                        <td>{{ $row->row_id }}</td>
                        @php
                            $field=config('db-logging.user.display_field');
                        @endphp
                        <td>{{ $row->user->$field }}</td>
                        <td>{{ $row->action }}</td>
                        <td>{{ $row->created_at }}</td>
                        <td>
                            <button class="btn btn-small btn-outline-info" type="button" data-toggle="modal"
                                    data-target="#diff-model{{$row->id}}">
                                <i class="fas fa-exchange-alt"></i>
                                @lang('Compare')
                            </button>
                            @include('backend.logging.modal', ['before' => $row->before, 'after' => $row->after, 'id' => "diff-model" . $row->id])
                        </td>
                    </tr>
                @endforeach
            </table>
        <div>
    </div>
@endsection