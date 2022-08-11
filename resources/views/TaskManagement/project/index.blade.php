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
              

              <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Launch demo modal
              </button>

              <!-- Modal -->
              <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      ...
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                  </div>
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
                      
                      <td>{{$project->salary}}</td>
          
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
<!-- Bootstrap 4 -->
<script src="Task-Management/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

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
