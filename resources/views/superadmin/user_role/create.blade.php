@extends('superadmin.layout.master')
@section('main-content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <div class="page-wrapper">
        <div class="page-content">
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <h3>
                            Add User Role
                        </h3>
                        <hr>
                        <form method="post" action="{{route('user_role.store')}}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="user_id" class="form-label">Select User</label>
                                            <select class="form-control" id="user_id" name="user_id">
                                                <option value="">Nothing To Select</option>
                                                @foreach($users as $row)
                                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('user_id')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div> <!-- end cold md 6 -->
                                        <div class="col-md-6">
                                            <label for="role_id" class="form-label">Select Role</label>
                                            <select class="form-control" id="role_id" name="role_id">
                                                <option value="">Nothing To Select</option>
                                                @foreach($roles as $row)
                                                    <option value="{{$row->id}}">{{$row->role_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('role_id')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div> <!-- end cold md 6 -->
                                    </div>    <!-- end row 	 -->
                                    <hr>
                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5"
                                               value="Add User Role">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>


@endsection