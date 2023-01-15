@extends('layouts.app')

@section('content')
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <h3 class="breadcrumb-header">Admin Interface - Ban Users</h3>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>

    @if ($message = Session::get('success'))
    <div class="alert alert-success" id="alert">
        <p>{{ $message }}</p>
    </div>
    @endif

    <table class="table table-bordered" id="tableBanUser">
        <caption></caption>
        <thead>
            <tr>
                <th>User ID</th>
                <th>Nickname</th>
                <th>Name</th>
                <th>Email</th>
                <th>Profile</th>
                <th>Ban User</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allUsers as $users)
                <tr>
                    <td>{{ $users->id }}</td>
                    <td>{{ $users->nickname }}</td>
                    <td>{{ $users->name }}</td>
                    <td>{{ $users->email }}</td>
                    <td><a href="{{ route('myProfile', $users->nickname) }}">View Profile</a></td>
                    <td style="width: 19%">
                        <form action="{{ route('deleteUsersAdmin', $users->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="buttonDelete">Ban User</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
