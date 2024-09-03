<div class="table-responsive">
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Block</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @php
                $count = 1;
            @endphp
            @forelse ($type as $row)
                <tr>
                    <td>{{ $count++ }}</td>

                    <td>{{ $row->type_name }}</td>
                    <td>
                        <a href="#" class="edit-btn" data-bs-toggle="modal" data-bs-target="#editBlockModal"
                            data-id="{{ $row->id }}" data-name="{{ $row->type_name }}" title="Edit">
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
                    <td colspan="3" class="text-center">No records found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Edit Modal HTML Structure -->
@include('superadmin.invoice_type.edit_modal')

{{-- Script --}}

@include('superadmin.invoice_type.script')
