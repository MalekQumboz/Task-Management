@extends('TaskManagement.parent')

@section('page-title','Attendances')

@section('big-title','Attendances')
@section('sm-title','Attendances')


@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
                
  
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
                    <th style="width: 10%">#</th>
                    <th style="width:  20%">Name</th>
                    <th style="width:  20%">Progress</th>
                    <th style="width:  20%">Label</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1.</td>
                    <td>Update software</td>
                    <td>
                      <div class="progress progress-xs">
                        <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                      </div>
                    </td>
                    <td><span class="badge bg-danger">55%</span></td>
                  </tr>
                  
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
    
@endsection
