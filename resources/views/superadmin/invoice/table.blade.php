<h6 class="mb-0 text-uppercase">Manage Invoice</h6>
<hr>
<div class="container mt-4">
    <div class="table-responsive">
        <table class="table table-striped table-bordered" >
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Invoice Number</th>
                    <th>Description/th>
                    <th>Due Date</th>
                    <th>Total</th>
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
                       <td>{{$row->description}}</td>
                       <td>{{Carbon\Carbon::parse($row->date)->format('d m Y')}}</td>
                       <td>{{$row->total}}</td>
                       <td class="">
                        <a href="{{Route('invoice.show', $row->id)}}" target="_blank" class="edit-btn pl-4" title="View">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{Route('invoice.edit', $row->id)}}" class="edit-btn ml-2" title="Edit" style="margin-left: 10px;">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="" class="delete-btn" title="Delete" data-id="{{ $row->id }}" style="margin-left: 20px;">
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
    $('.delete-btn').on('click', function(event) {
        event.preventDefault();
        var $this = $(this);
        var id = $this.data('id');
        var url = '{{ route('invoice.delete', ':id') }}'.replace(':id', id);
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this item!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire(
                            'Deleted!',
                            'Your item has been deleted.',
                            'success'
                        );
                        $this.closest('tr').fadeOut(400, function() {
                            $(this).remove();
                        });
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Error!',
                            'There was an issue deleting the item.',
                            'error'
                        );
                    }
                });
            }
        });
    });
});
 </script>
