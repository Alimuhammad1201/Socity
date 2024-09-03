<h6 class="mb-0 text-uppercase">Manage Flat</h6>
<hr>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                @php
                    $count = 1;
                @endphp
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Flat Series</th>
                        <th>Block Number</th>
                        <th>Floor</th>
                        <th>Action</th>
                    </tr>
                </thead>
               <tbody>
                @forelse ($flat as $row )
                <tr>
                    <td>{{ $count++ }}</td>
                    <td>{{ $row->flat_no }}</td>
                    <td>{{ $row->Block_name }}</td>
                    <td>{{ $row->floor }}</td>
                    <td>
                        <a href="{{route('flat.edit', $row->id)}}" class="edit-btn"
                             title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="#" class="delete-btn" title="Delete" data-id="{{ $row->id }}"
                            style="margin-left: 20px;">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">No records found</td>
                </tr>
                @endforelse
               </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Script --}}

@include('superadmin.flat.script')