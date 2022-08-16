@extends('TaskManagement.parent')

@section('page_title','Permission')

@section('lg-title','Permission')
@section('sm-title','home')
@section('main-title','Permission')

@section('content')
   
<div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Role ({{$roles->name}}) - permission</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th style="width: 5%">#</th>
              <th style="width: 45%">Name</th>
              <th style="width: 40%">User Type</th>
              <th style="width  5%">setting</th>
              
              
              
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
              <td>
                    <!-- checkbox -->
                    <div class="form-group clearfix">
                      <div class="icheck-primary d-inline">
                        <input type="checkbox" onclick="preformUpdate({{$permission->id}})"  id="prmission_{{$permission->id}}" @checked($permission->assigned) >
                        <label for="prmission_{{$permission->id}}">
                        </label>
                      </div>
                      
                    </div>
              </td>
            </tr>
            @endforeach
            
          </tbody>
        </table>
      </div>
    
    </div>
    <!-- /.card -->

    
    <!-- /.card -->
</div>

@endsection

@section('style')
<link rel="stylesheet" href="{{asset('Task-Management/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
@endsection

@section('script')
<script>
function preformUpdate(id){
    axios.put('/Task-Management/roles/{{$roles->id}}/permission',{
      permission_id:id,
      
    })
    .then(function (response) {

      // handle success
      console.log(response);
      toastr.success(response.data.message);
      // window.location.href='/Task-Management/roles/{{$roles->id}}/permission'
      
    })
    .catch(function (error) {
      // handle error
      console.log(error);
      toastr.error(error.response.data.message)
    })
    .then(function () {
      // always executed
    });
}
</script>
@endsection