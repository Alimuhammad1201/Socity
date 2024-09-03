@extends('superadmin.layout.master')
@section('main-content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-wrapper">
    <div class="page-content">
       <div class="box-body">
<div class="row">
<div class="col">
<form method="post" action="{{route('superadmin.role.store')}}" enctype="multipart/form-data" >
@csrf
<div class="row">
    <div class="col-12">

        <div class="row">
            <div class="col-md-6">

                <div class="form-group">
                    <h5>Admin User Name  <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" name="name" class="form-control" > </div>
                </div>

            </div> <!-- end cold md 6 -->



            <div class="col-md-6">

                <div class="form-group">
                    <h5>Admin Email  <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="email" name="email" class="form-control" > </div>
                </div>

            </div> <!-- end cold md 6 -->

        </div>	<!-- end row 	 -->




        <div class="row">
            <div class="col-md-6">

                <div class="form-group">
                    <h5>Admin User Phone  <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" name="phone" class="form-control" > </div>
                </div>

            </div> <!-- end cold md 6 -->



            <div class="col-md-6">

                <div class="form-group">
                    <h5>Admin Password  <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="password" name="password" class="form-control" > </div>
                </div>

            </div> <!-- end cold md 6 -->

        </div>	<!-- end row 	 -->







        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                    <h5>Admin User Image <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="file" name="profile_photo_path" class="form-control" required="" id="image"> </div>
                </div>
            </div><!-- end cold md 6 -->

            <div class="col-md-6">
                <img id="showImage" src="{{ url('upload/no_image.jpg') }}" style="width: 100px; height: 100px;">

            </div><!-- end cold md 6 -->
        </div><!-- end row 	 -->
        <hr>

        <div class="row">

            <div class="col-md-4">
                <div class="form-group">

                    <div class="controls">
                        <fieldset>
                            <input type="checkbox" id="checkbox_2" name="block" value="1">
                            <label for="checkbox_2">Block</label>
                        </fieldset>
                        <fieldset>
                            <input type="checkbox" id="checkbox_3" name="invoice_type" value="1">
                            <label for="checkbox_3">Invoice Type</label>
                        </fieldset>

                        <fieldset>
                            <input type="checkbox" id="checkbox_4" name="flat_area" value="1">
                            <label for="checkbox_4">Flat Area</label>
                        </fieldset>

                        <fieldset>
                            <input type="checkbox" id="checkbox_5" name="flats" value="1">
                            <label for="checkbox_5">Flats</label>
                        </fieldset>

                        <fieldset>
                            <input type="checkbox" id="checkbox_6" name="visitors" value="1">
                            <label for="checkbox_6">Visitors</label>
                        </fieldset>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">

                    <div class="controls">
                        <fieldset>
                            <input type="checkbox" id="checkbox_2" name="invoice" value="1">
                            <label for="checkbox_2">Invoice</label>
                        </fieldset>
                        <fieldset>
                            <input type="checkbox" id="checkbox_3" name="allotment" value="1">
                            <label for="checkbox_3">Allotment</label>
                        </fieldset>

                        <fieldset>
                            <input type="checkbox" id="checkbox_4" name="complaint" value="1">
                            <label for="checkbox_4">Complaints</label>
                        </fieldset>

                        <fieldset>
                            <input type="checkbox" id="checkbox_5" name="adminuserregister" value="1">
                            <label for="checkbox_5">Admin User Register</label>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-xs-right">
            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add Admin User">
        </div>
</form>
</div>

</div>
<!-- /.col -->
</div>
<!-- /.row -->
</div>
<!-- /.box-body -->
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