@extends('layout.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a class="text-left" href="{{ url('/assets-add') }}"> <button class="btn btn-primary">Add</button></a>

                </div>

                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>
                                SNo
                            </th>
                            <th>
                                Name
                            </th>
                            <th>
                                Hardware Id
                            </th>
                            <th>
                                Status
                            </th>
                            <th>

                                Action
                            </th>
                        </tr>
                        @php $i = 1;

                        @endphp


                        @foreach($data as $key=>$value)
                        @if ($value["status"] == "Active")
                        @php $status = "btn btn-success";
                        $status1 = 'Active';
                        @endphp
                        @else
                        @php
                        $status = "btn btn-danger";
                        $status1 = 'InActive';
                        @endphp
                        @endif
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $value['name']}}</td>
                            <td>{{ $value['uuid']}}</td>

                            <td>
                                <button class="{{ $status }}" onclick="assetChangeStatus('<?php echo $value['status'] ?>','<?php echo $value['id'] ?>')">{{ $status1 }}</button>
                            </td>

                            <td>
                                <a class="" href="{{ url('/assets-edit') }}/{{ $value['id'] }}"> <button class="btn btn-primary">Edit</button></a>
                                <button class="btn btn-danger delete_cost" data-id="{{ $value['id'] }}">Delete</button>

                            </td>
                        </tr>
                        @php $i++ @endphp
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var updateUrl = "{{ url('assets-changeStatus') }}";
    var deleteUrl = "{{ url('assets-delete') }}";
</script>
<script src="{{ asset('js/assets.js') }}"></script>

@endsection