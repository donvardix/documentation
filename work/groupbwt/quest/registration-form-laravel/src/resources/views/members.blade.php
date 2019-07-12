<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <title>Members</title>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('home') }}">Home</a>
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <a href="{{ url('/home') }}">Home</a>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </nav>
    <br>
    @auth
        <table class="table">
            <thead>
            <tr>
                <th class="text-center" scope="col">Visibility</th>
                <th scope="col">Photo</th>
                <th scope="col">Name</th>
                <th scope="col">Report subject</th>
                <th scope="col">Email</th>
            </tr>
            </thead>
            <tbody>
            @foreach($membersForAdmin as $admin)
                <tr>
                    <td class="text-center">@if ($admin->trashed()) <a href="/show/{{ $admin->id }}">Show</a> @else
                            <a
                                    href="/hide/{{ $admin->id }}">Hide</a> @endif</td>
                    <th scope="row"><img
                                src="@if (!isset($admin->photo)){{ $defaultAvatar }}@else/storage/{{ $admin->photo }}@endif"
                                width="50" height="50" alt="photo"></th>
                    <td>{{ $admin->firstname }} {{ $admin->lastname }}</td>
                    <td>{{ $admin->reportsubject }}</td>
                    <td><a href="mailto:{{ $admin->email }}">{{ $admin->email }}</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Photo</th>
                <th scope="col">Name</th>
                <th scope="col">Report subject</th>
                <th scope="col">Email</th>
            </tr>
            </thead>
            <tbody>
            @foreach($members as $member)
                <tr>
                    <th scope="row"><img
                                src="@if (!isset($member->photo)){{ $defaultAvatar }}@else/storage/{{ $member->photo }}@endif"
                                width="50" height="50" alt="photo"></th>
                    <td>{{ $member->firstname }} {{ $member->lastname }}</td>
                    <td>{{ $member->reportsubject }}</td>
                    <td><a href="mailto:{{ $member->email }}">{{ $member->email }}</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endauth


    <nav>
        <ul class="pagination justify-content-center">
            @auth
                <p>{{$membersForAdmin->links()}}</p>
            @else
                <p>{{$members->onEachSide(1)->links()}}</p>
            @endauth
        </ul>
    </nav>

</div>
</body>
</html>