@extends('TaskManagement.parent')

@section('page-title','Project')

@section('big-title','Create')
@section('sm-title','Create')


@section('content')
<section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Create Project</h3>
              </div>
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

          <div class="card-footer">
            <button type="button" onclick="preformSave()" class="btn btn-primary">Save</button>
          </div>
        </form>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
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
        document.getElementById('resetForm').reset();
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
