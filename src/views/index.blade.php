@extends(config('db-logging.layout'))

@section(config('db-logging.content_area'))

    <div class="card">
        <div class="card-header bg-primary">
            <h2 class="text-light">Log</h2>
        </div>
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-md-3 form-group">
                        <label>Table</label>
                        <select class="form-control" name="search[table]">
                            <option value="">choose table</option>
                            @foreach ($tables as $tbl)
                                <option>{{ $tbl }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <label>User</label>
                        <select class="form-control" name="search[user]">
                            <option value="">choose user</option>
                            @foreach ($users as $user)
                                <option>{{ $user }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <label>action</label>
                        <select class="form-control" name="search[action]">
                            <option value="">choose action</option>
                            <option>create</option>
                            <option>update</option>
                            <option>delete</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        
                        <button type="submit" class="btn btn-small btn-primary" style="margin-top:25px;"><i class="fas fa-search"></i> Search</button>
                    </div>
                </div>
            </form>
            <table class="table table-striped">
                <tr class="bg-secondry text-info font-weight-bold">
                    <th>Table</th>
                    <th>row id</th>
                    <th>User</th>
                    <th>action</th>
                    <th>date</th>
                    <th>Settings</th>
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
                            <button class="btn btn-small btn-outline-info" type="button"  data-toggle="modal" data-target="#diff-model{{$row->id}}"><i class="fas fa-exchange-alt"></i> diffrent</button>
                            @include('backend.logging.modal',['befor'=>$row->before,'after'=>$row->after,'id'=>"diff-model".$row->id])
                        </td>

                    </tr>
                @endforeach
            </table>
        <div>
    </div>

@endsection