@extends('TaskManagement.parent')

@section('page-title','Permission')

@section('big-title','Index')
@section('sm-title','Index')

@section('content')
<div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"></h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th style="width: 5%">#</th>
              <th style="width: 25%">Name</th>
              <th style="width: 25%">User Type</th>
              
              
              
            </tr>
          </thead>
          <tbody>
            @foreach ( $permissions as $permission)
            <tr id="delete">
              <td>{{$loop->index +1}}</td>
              <td>{{$permission->name}}</td>
              <td><span class="badge bg-success ">
                {{$permission->guard_name}}
                </span>
              </td>
        
            </tr>
            @endforeach
            
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
      <div class="card-footer clearfix">
        <ul class="pagination pagination-sm m-0 float-right">
          <li class="page-item"><a class="page-link" href="#">«</a></li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item"><a class="page-link" href="#">»</a></li>
        </ul>
      </div>
    </div>
    <!-- /.card -->

    
    <!-- /.card -->
</div>


@endsection

@section('style')
    
@endsection

