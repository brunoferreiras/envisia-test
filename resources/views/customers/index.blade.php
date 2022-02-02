@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="table-responsive">
                <table class="table table-striped table-bordered mb-5">
                    <thead>
                    <tr class="table-success">
                        <th scope="col">#</th>
                        <th scope="col">First name</th>
                        <th scope="col">Last name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Birthday</th>
                        <th scope="col">Created at</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customers as $data)
                        <tr>
                            <th scope="row">{{ $data->id }}</th>
                            <td>{{ $data->first_name }}</td>
                            <td>{{ $data->last_name }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->birthday }}</td>
                            <td>{{ $data->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {!! $customers->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
