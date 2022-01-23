@extends('welcome')
@section('content')
<div style="padding: 1em;">    
        <table class="table">
            <thead class="thead-light">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Fisrt Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Username</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
                @forelse ($user as $key=>$value)
                    <tr>
                        <td>{{$key + 1}}</th>
                        <td>{{$value->profile->first_name}}</td>
                        <td>{{$value->profile->last_name}}</td>
                        <td>{{$value->username}}</td>
                        <td style="display: flex;">
                            @if ($value->email == 'admin@skypost.com')
                                <div></div>
                            @else
                                <form action="/profile/{{$value->id}}" method="GET" style="margin-right: 1em;">
                                    <input type="submit" class="btn btn-info" value="Show">
                                </form>
                                <form action="/user/{{$value->id}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-danger" value="Delete">
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr colspan="3">
                        <td>No data</td>
                    </tr>  
                @endforelse              
            </tbody>
        </table>
</div>
@endsection