@extends('dashboard')

@section('content')
    <style>
        /* CSS cho bảng */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        /* CSS cho phần post */
        .post {
            background-color: #f9f9f9;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
        }

        /* CSS cho phần mô tả của post */
        .post-description {
            color: #333;
            font-size: 14px;
        }

        /* CSS cho phần sở thích */
        .favorite {
            background-color: #f0f0f0;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
        }

        /* CSS cho phần mô tả của sở thích */
        .favorite-description {
            color: #666;
            font-size: 14px;
        }

        /* CSS cho phần user_profile */
        .user-profile {
            background-color: #e6e6e6;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #999;
        }

        /* CSS cho tiêu đề của user_profile */
        .user-profile-title {
            color: #333;
            font-size: 16px;
            font-weight: bold;
        }

        /* CSS cho nội dung của user_profile */
        .user-profile-content {
            color: #666;
            font-size: 14px;
        }
    </style>

    <main class="login-form">
        <div class="container">
            <div class="row justify-content-center">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="user-profile">
                <h1 class="user-profile-title">User Profile</h1>
                <div class="user-profile-content">
                    <p><strong>User Profile ID:</strong> {{ $user_profile->user_profile_id }}</p>
                    <p><strong>User ID:</strong> {{ $user_profile->user_id }}</p>
                    <p><strong>First Name:</strong> {{ $user_profile->first_name }}</p>
                    <p><strong>Last Name:</strong> {{ $user_profile->last_name }}</p>
                    <p><strong>Sex:</strong> {{ $user_profile->sex }}</p>
                    <p><strong>Phone:</strong> {{ $user_profile->phone }}</p>
                    <p><strong>Address:</strong> {{ $user_profile->address }}</p>
                </div>
            </div>

            <div class="pos">
                <h1>POST</h1>
                @foreach ($posts as $post)
                    <div class="post">
                        <h4>post name</h4>
                        <p>{{ $post->post_name }}</p>
                        <h4>post description</h4>
                        <p class="post-description">{{ $post->post_description }}</p>
                    </div>
                @endforeach
            </div>
            
            <div>
                <h1>SỞ THÍCH</h1>
                @foreach ($favorities as $favorite)
                    <div class="favorite">
                        <h4>Sở thích</h4>
                        <p>{{ $favorite->favorite_name }}</p>
                        <h4>Mô tả sở thích</h4>
                        <p class="favorite-description">{{ $favorite->favorite_description }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
@endsection
