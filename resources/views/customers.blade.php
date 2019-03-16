@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if(isset($msg))
                <div class="col-md-12">{{$msg}}</div>
            @endif
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Customers</div>
                    <div class="panel-body">
                        <table class="table table-bordered" id="customers-table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Interviewee</th>
                                <th>Interview Date</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

                <hr class="col-sm-12">
                <hr class="col-sm-12">
                <hr class="col-sm-12">

                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Easyload Details</div>
                        <div class="panel-body">
                            <table class="table table-bordered" id="easyload-table">
                                <thead>
                                <tr>
                                    <th>tid</th>
                                    <th>amount</th>
                                    <th>CATI/CAWI</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        $(function() {
            var table = $('#customers-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! route('customers.list') !!}',
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                columns: [
                    { data: 'id', name: 'id', render:function(data, type, row){
                            return "<a href='#easyload-table' class='easyloaddata' id='"+ row.id +"'>" + row.id + "</a>"
                        }},
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'interviewee', name: 'interviewee' },
                    { data: 'interviewdate', name: 'interviewdate' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'updated_at', name: 'updated_at' }
                ]
            });


           $("#customers-table").on("click",'.easyloaddata',function (e) {
               var id = $(this).attr("id");


               var table1 = $('#easyload-table').DataTable({
                   processing: true,
                   destroy: true,
                   serverSide: true,
                   ajax: {
                       url: '/easyload/'+id,
                       method: 'get',
                       headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                       }
                   },
                   columns: [
                   { data: 'tid', name: 'tid' },
                   { data: 'caticawi', name: 'caticawi' },
                   { data: 'amount', name: 'amount' },
                   { data: 'created_at', name: 'created_at' },
                   { data: 'updated_at', name: 'updated_at' }
               ]
               });
           })

        });

    </script>
@endpush
