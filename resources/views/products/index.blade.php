@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="table-responsive">
                <table class="table table-striped table-bordered mb-5">
                    <thead>
                    <tr class="table-success">
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">EAN</th>
                        <th scope="col">UPC</th>
                        <th scope="col">Net Price</th>
                        <th scope="col">Taxes</th>
                        <th scope="col">Price</th>
                        <th scope="col">Created at</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $data)
                        <tr>
                            <th scope="row">{{ $data->id }}</th>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->description }}</td>
                            <td>{{ $data->ean }}</td>
                            <td>{{ $data->upc }}</td>
                            <td>{{ $data->net_price }}</td>
                            <td>{{ $data->taxes }}</td>
                            <td>{{ $data->price }}</td>
                            <td>{{ $data->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {!! $products->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
