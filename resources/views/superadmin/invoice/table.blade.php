<h6 class="mb-0 text-uppercase">Manage Invoice</h6>
<hr>
<div class="container mt-4">
    <div class="table-responsive">
        <table class="table table-striped table-bordered" >
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Invoice Number</th>
                    <th>Description</th>
                    <th>Due Date</th>
                    <th>Action</th>
                  
                </tr>
            </thead>
            <tbody>
                @php
                    $count = 1;
                @endphp
               
                   @foreach ($InvMaster as $row )
                       
                   <tr>
                       <td>{{$count++}}</td>
                       <td>{{$row->Invoicenumber}}</td>
{{--                       <td>{{$row->}}</td>--}}
                       <td>Ali Muammad</td>
                       <td>03312187411</td>
                       <td>200000</td>
                       
                       <td>
                           <a href="#" class="edit-btn"
                           title="Edit">
                           <i class="fas fa-edit"></i>
                        </a>
                        <a href="#" class="delete-btn" title="Delete" data-id="#"
                        style="margin-left: 10px;">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
                
            </tr>
            @endforeach 
                <!-- More rows as needed -->
            
                    
         
            </tbody>
        </table>
    </div>
</div>
@include('superadmin.allotments.script')
