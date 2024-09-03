<h6 class="mb-0 text-uppercase">Manage Allotments</h6>
<hr>
<div class="container mt-4">
    <div class="table-responsive">
        <table class="table table-striped table-bordered" >
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Block</th>
                    <th>Flat</th>
                    <th>Owner Name</th>
                    <th>Owner Email</th>
                    <th>Owner Nic</th>
                    <th>Owner Call</th>
                    <th>Alternate call</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $count = 1;
                @endphp
                @forelse ($allot as $row)
                    
                <tr>
                    <td>{{$count++}}</td>
                    <td>{{$row->BlockNumber}}</td>
                    <td>{{$row->FlatNumber}}</td>
                    <td>{{ $row->Block_name}}</td>
                    <td>{{$row->flat_no}}</td>
                    <td>{{$row->OwnerName}}</td>
                    <td>{{$row->OwnerEmail}}</td>
                    <td>{{$row->nic}}</td>
                    <td>{{$row->OwnerContactNumber}}</td>
                    <td>{{$row->OwnerAlternateContactNumber}}</td>
                    <td>
                        <a href="{{route('allot.edit', $row->id)}}" class="edit-btn"
                            title="Edit">
                           <i class="fas fa-edit"></i>
                       </a>
                       <a href="#" class="delete-btn" title="Delete" data-id="{{ $row->id }}"
                           style="margin-left: 10px;">
                           <i class="fas fa-trash"></i>
                       </a>
                    </td>
                    
                </tr>
                <!-- More rows as needed -->
                @empty
                  <tr>
                    <td colspan="8">No Record Found</td>
                  </tr>
                    
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@include('superadmin.allotments.script')
