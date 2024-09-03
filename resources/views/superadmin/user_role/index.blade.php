@extends('superadmin.layout.master')
@section('main-content')

    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <!--end breadcrumb-->
            <hr>
            <div class="row gap-4">
                <div class="col-md-12 card">
                    <div class="box-header with-border">
                        <h3 class="box-title" style="margin-top: 10px"> User Role</h3>
                        <a href="{{ route('user_role.create') }}" class="btn btn-danger" style="margin-left: 86%;">Add User Role</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>User Name</th>
                                    <th>Role Name</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($userrole as $item)
                                    <tr>
                                        <td>{{ $item->id }}  </td>
                                        <td>{{ $item->user->name }}  </td>
                                        <td>{{ $item->roles->role_name }}  </td>
                                        <td width="25%">
                                            <a href="{{ route('user_role.edit',$item->id) }}" class="btn btn-info"
                                               title="Edit Data"><i class="fa fa-pencil"></i> </a>
                                            <a href="{{ route('user_role.destroy',$item->id) }}" class="btn btn-danger"
                                               title="Delete Management Member">
                                                <i class="fa fa-trash"></i></a>
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
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#image').change(function (e) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection