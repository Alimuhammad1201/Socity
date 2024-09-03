@extends('superadmin.layout.master')
@section('main-content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="page-wrapper">
    <div class="page-content">

        <div class="box-body">
<div class="row">
<div class="col">
<form method="post" action="{{ route('admin.role.update') }}" enctype="multipart/form-data" >
@csrf

<input type="hidden" name="id" value="{{ $user->id }}">
<input type="hidden" name="old_image" value="{{ $user->profile_photo_path }}">



<div class="row">
<div class="col-12">

    <div class="row">
        <div class="col-md-6">

            <div class="form-group">
                <h5>Admin User Name  <span class="text-danger">*</span></h5>
                <div class="controls">
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" > </div>
            </div>

        </div> <!-- end cold md 6 -->



        <div class="col-md-6">

            <div class="form-group">
                <h5>Admin Email  <span class="text-danger">*</span></h5>
                <div class="controls">
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" > </div>
            </div>

        </div> <!-- end cold md 6 -->

    </div>	<!-- end row 	 -->




    <div class="row">
        <div class="col-md-6">

            <div class="form-group">
                <h5>Admin User Phone  <span class="text-danger">*</span></h5>
                <div class="controls">
                    <input type="text" name="phone" class="form-control" value="{{ $user->phone }}" > </div>
            </div>

        </div> <!-- end cold md 6 -->





    </div>	<!-- end row 	 -->







    <div class="row">

        <div class="col-md-6">
            <div class="form-group">
                <h5>Admin User Image <span class="text-danger">*</span></h5>
                <div class="controls">
                    <input type="file" name="profile_photo_path" class="form-control" id="image"> </div>
            </div>
        </div><!-- end cold md 6 -->

        <div class="col-md-6">
            <img id="showImage" src="{{ asset('upload/admin_images/' . $user->profile_photo_path) }}" style="width: 100px; height: 100px;">

        </div><!-- end cold md 6 -->
    </div><!-- end row 	 -->

    <hr>
        <div class="row">

            <div class="col-md-4">
                <div class="form-group">

                    <div class="controls">
                        <fieldset>
                            <input type="checkbox" id="checkbox_2" name="block" value="1" {{ $user->block == 1 ? 'checked' : ''}}>
                            <label for="checkbox_2">Block</label>
                        </fieldset>
                        <fieldset>
                            <input type="checkbox" id="checkbox_3" name="invoice_type" value="1" {{ $user->invoice_type == 1 ? 'checked' : '' }}>
                            <label for="checkbox_3">Invoice Type</label>
                        </fieldset>

                        <fieldset>
                            <input type="checkbox" id="checkbox_4" name="flat_area" value="1"{{ $user->flat_area == 1 ? 'checked' :'' }} >
                            <label for="checkbox_4">Flat Area</label>
                        </fieldset>

                        <fieldset>
                            <input type="checkbox" id="checkbox_5" name="flats" value="1" {{ $user->flats == 1 ?'checked' : '' }}>
                            <label for="checkbox_5">Flats</label>
                        </fieldset>

                        <fieldset>
                            <input type="checkbox" id="checkbox_6" name="visitors" value="1" {{ $user->visitors == 1 ? 'checked' : '' }}>
                            <label for="checkbox_6">Visitors</label>
                        </fieldset>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">

                    <div class="controls">
                        <fieldset>
                            <input type="checkbox" id="checkbox_2" name="invoice" value="1" {{ $user->invoice == 1 ? 'checked' : '' }}>
                            <label for="checkbox_2">Invoice</label>
                        </fieldset>
                        <fieldset>
                            <input type="checkbox" id="checkbox_3" name="allotment" value="1" {{ $user->allotment == 1 ? 'checked' : '' }}>
                            <label for="checkbox_3">Allotment</label>
                        </fieldset>

                        <fieldset>
                            <input type="checkbox" id="checkbox_4" name="complaint" value="1" {{ $user->complaint == 1 ? 'checked' : '' }}>
                            <label for="checkbox_4">Complaints</label>
                        </fieldset>

                        <fieldset>
                            <input type="checkbox" id="checkbox_5" name="adminuserregister" value="1" {{$user->adminuserregister == 1 ? 'checked' : ''}}>
                            <label for="checkbox_5">Admin User Register</label>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>

    <div class="text-xs-right">
        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Admin User">
    </div>
</form>

</div>
<!-- /.col -->
</div>
<!-- /.row -->
</div>
<!-- /.box-body -->
</div>
<!-- /.box -->

    </div>
    </div>
  </div>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#image').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>


@endsection