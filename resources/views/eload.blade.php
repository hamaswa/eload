@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if(isset($msg))
                <div class="col-md-12">{{$msg}}</div>
            @endif
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Easyload Details</div>
                    <div class="panel-body">
                        <table class="table table-bordered" id="customers-table">
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
            $('#customers-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/easyload',
                    data:[{'id':$id}],
                    method: 'post',
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
        });
    </script>
@endpush
