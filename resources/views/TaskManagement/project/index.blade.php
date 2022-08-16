@extends('TaskManagement.parent')

@section('page-title','Projects')

@section('big-title','Index')
@section('sm-title','Index')


@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">

              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">
                New Project
              </button>
  
              <div class="modal fade" id="modal-lg">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Create Project</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form id="resetForm">
                        @csrf
                          <div class="card-body" style="display: block;">
                            <div class="form-group">
                              <label for="name">Project Name</label>
                              <input type="text" id="name" class="form-control">
                            </div>
                            <div class="form-group">
                              <label for="description">Project Description</label>
                              <textarea id="description" class="form-control" rows="4"></textarea>
                            </div>
                            <div class="form-group">
                              <label for="status">Status</label>
                              <select id="status" class="form-control custom-select">
                                <option selected="" disabled="">Select one</option>
                                <option value="completed">Completed</option>
                                <option value="inprogress">Inprogress</option>
                                <option value="canceled">Canceled</option>
                              </select>
                            </div>
                            
                            <div class="form-group">
                              <label for="projectManager">Project Leader</label>
                              <select id="projectManager" class="form-control custom-select">
                                <option selected="" disabled="">Select one</option>
                                @foreach ($projectManagers as $projectManager)
                                    <option value="{{$projectManager->name}}">{{$projectManager->name}}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                        </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="button" onclick="preformSave()" class="btn btn-primary">Save</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
              </div>
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
  
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <table class="table">
                <thead>
                  <tr>
                    <th style="width: 5%">#</th>
                    <th style="width:  15%">Name</th>
                    <th style="width:  15%">Project leader</th>
                    <th style="width:  15%">Tasks</th>
                    <th style="width:  15%">Status</th>
                    <th style="width:  20%">Progress</th>
                    <th style="width:  15%">Settings</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ( $projects as $project)
                    <tr id="delete">
                      <td>{{$loop->index +1}}</td>
                      <td>{{$project->name}}</td>
                      <td>{{$project->projectManager}}</td>
                      <td>
                            <a href="{{route('projectTasks.show',$project->id)}}"
                             type="button" class="btn btn-block btn-outline-primary btn-sm">
                               ({{$project->tasks_count}}) / Task 
                            </a>
                      </td>
                      <td> 
                        <span class="badge
                         @if ($project->status=='completed')bg-primary 
                         @elseif($project->status=='inprogress') bg-success 
                         @elseif($project->status=='canceled') bg-danger 
                         @endif ">
                            {{$project->statusKey}}
                          </span>
              
                      </td>
                      
                      <td>
                        <div class="progress progress-xs">
                          <div class="progress-bar progress-bar-danger" 
                          style="width:@if($project->tasks_count>0) 
                          @foreach ($tasksCompleted as $taskCompleted )
                            @if($project->id == $taskCompleted->id)
                            {{($taskCompleted->tasks_count/$project->tasks_count)*100}}%
                            @endif
                          @endforeach
                          
                          @endif"></div>
                        </div>
                      </td>
          
                    <td> <div class="btn-group">
                      <a href="{{route('projects.edit',$project->id)}}" class="btn btn-warning">
                        <i class="fas fa-edit"></i>
                      </a>
          
                      <a  id="delete" onclick="confirmDelete('{{$project->id}}')" class="btn btn-danger">
                        <i class="fas fa-trash"></i>
                      </a>
                      </div>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
              {{$projects->links()}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('style')
    
@endsection

@section('script')

<script>
  function preformSave(){
    axios.post('/Task-Management/projects',{
      name:document.getElementById('name').value,
      description:document.getElementById('description').value,
      status:document.getElementById('status').value,
      projectManager:document.getElementById('projectManager').value,
    })
    .then(function (response) {

      // handle success
      console.log(response);
      toastr.success(response.data.message);
      // document.getElementById('resetForm').reset();
      window.location.href="/Task-Management/projects"

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
<script>
    function confirmDelete(id){
      Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            performDelete(id),
            
          )
        }
        })}

  function performDelete(id){
    axios.delete('/Task-Management/projects/'+id)
        .then(function (response) {

          // handle success
          console.log(response);
          showSwalMessage(response.data);
          document.getElementById('delete').remove();
          // $('#delete').remove();
          window.location.href="/Task-Management/projects"
        })
        .catch(function (error) {
          // handle error
          console.log(error);
          showSwalMessage(error.response.data);
        })
        .then(function () {
          // always executed
        });
  }

  function showSwalMessage(data){
    Swal.fire(
            data.title,
            data.message,
            data.icon
          )
  }
  </script>
@endsection
