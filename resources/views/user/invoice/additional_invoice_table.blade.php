<h6 class="mb-0 text-uppercase">{{ _('View Invoice') }}</h6>
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
                        <th>Invoice No</th>
                        <th>Block</th>
                        <th>Flat No</th>
                        <th>Month</th>
                        <th>Total Bill</th>
                        <th>Due Date</th>
                        <th>Description</th>
                        <th>Invoice</th>
                    </tr>
                </thead>
               <tbody>
                @php 
                  $count = 1;
                @endphp
              
                    
             
    @foreach($additional_invoice as $row)
        <tr>
            <td>{{$count ++}}</td>
            <td>{{$row->invoice_no}}</td>
            <td>{{$row->block_id}}</td>
            <td>{{$row->flat_id}}</td>
          
            <td>{{ \Carbon\Carbon::parse($row->created_at)->format('F')}}</td>
            <td>{{$row->total}}</td>
            <td>{{ \Carbon\Carbon::parse($row->due_date)->format('d-m-Y')}}</td>
            <td>{{$row->description}}</td>
            <td>
                <a href="{{route('additional_invoice.show', $row->id)}}" class="edit-btn" title="Edit">
                    <i class="lni lni-eye"></i>
                </a>
            </td>
        </tr>
    @endforeach

             
               </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Script --}}

@include('superadmin.flat.script')

