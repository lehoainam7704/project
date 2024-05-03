@extends('dashboard')

@section('content')
    <main class="login-form">
        <div class="container">
            <div class="row justify-content-center">
                <table>
                    <thead>
                        <tr>
                            <th>favorite_id</th>
                            <th>favorite_name</th>
                            <th>favorite_description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($favorities as $favorities)
                            <tr>
                                <th>{{ $favorities->favorite_id }}</th>
                                <th>{{ $favorities->favorite_name }}</th>
                                <th>{{ $favorities->favorite_description }}</th>                                             
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection