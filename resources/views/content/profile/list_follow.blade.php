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
                @forelse ($follow as $key=>$value)
                    <tr>
                        <td>{{$key + 1}}</th>
                        <td>{{$value->user->profile->first_name}}</td>
                        <td>{{$value->user->profile->last_name}}</td>
                        <td>{{$value->user->username}}</td>
                        <td style="display: flex;">
                            <form action="/profile/{{$value->user->id}}" method="GET" style="margin-right: 1em;">
                                <input type="submit" class="btn btn-info" value="Show">
                            </form>
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