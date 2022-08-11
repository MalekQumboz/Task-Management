@extends('TaskManagement.parent')

@section('page-title','Project Tasks')

@section('big-title','Project Tasks')
@section('sm-title','Project Tasks')


@section('content')
<div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Project ({{$projects->name}}) - Tasks</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <table class="table">
          <thead>
            <tr>
              <th style="width: 5%">#</th>
              <th style="width:  15%">Name</th>
              <th style="width:  15%">Task leader</th>
              <th style="width:  15%">project</th>
              <th style="width:  15%">Status</th>
              <th style="width:  25%">Status Settings</th>
            </tr>
          </thead>
          <tbody>
              @foreach ( $tasks as $task)
              <tr id="delete">
                <td>{{$loop->index +1}}</td>
                <td>{{$task->name}}</td>
                <td>{{$task->taskLeaderKey}}</td>
                <td>{{$task->projectNameKey}}</td>
                <td> 
                  <span class="badge
                   @if ($task->status=='toDo')bg-danger 
                   @elseif($task->status=='inprogress') bg-success 
                   @elseif($task->status=='completed') bg-primary
                   @endif ">
                      {{$task->statusKey}}
                    </span>
                </td>
                
              <td> 
                
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

@section('script')
<script>
  function preformUpdate(id){
      axios.put('/Task-Management/projects/{{$projects->id}}/tasks',{
        permission_id:id,
        
      })
      .then(function (response) {
  
        // handle success
        console.log(response);
        toastr.success(response.data.message);
        window.location.href='/Task-Management/projects/{{$projects->id}}/tasks'
        
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
