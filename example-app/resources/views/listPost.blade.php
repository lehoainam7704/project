@extends('dashboard')

@section('content')
    <main class="login-form">
        <div class="container">
            <div class="row justify-content-center">
                <table>
                    <thead>
                        <tr>
                            <th>post_id</th>
                            <th>user_id</th>
                            <th>post_name</th>
                            <th>post_description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $posts)
                            <tr>
                                <th>{{ $posts->post_id }}</th>
                                <th>{{ $posts->user_id }}</th>
                                <th>{{ $posts->post_name }}</th>
                                <th>{{ $posts->post_description }}</th>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection