@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>
                Current Heroes
                <a href="/hero/create" class="btn btn-success pull-right">Create hero</a>
            </h4>
        </div>
        <div class="panel-body">
            <table class="table table-striped task-table">

                <!-- Table Headings -->
                <thead>
                <th>Firs name</th>
                <th>Last name</th>
                <th>Race</th>
                <th>Class</th>
                <th>Weapon</th>
                <th>&nbsp;</th>
                </thead>

                <!-- Table Body -->
                <tbody>
                @if (count($heroes) > 0)
                    @foreach ($heroes as $hero)
                        <tr>
                            <!-- Hero first name -->
                            <td class="table-text">
                                <div>{{ $hero['first_name'] }}</div>
                            </td>
                            <!-- Hero last name -->
                            <td class="table-text">
                                <div>{{ $hero['last_name'] }}</div>
                            </td>
                            <!-- Hero race -->
                            <td class="table-text">
                                <div>{{ $hero['race']['name'] }}</div>
                            </td>
                            <!-- Hero class -->
                            <td class="table-text">
                                <div>{{ $hero['class']['name'] }}</div>
                            </td>
                            <!-- Hero weapon -->
                            <td class="table-text">
                                <div>{{ $hero['weapon']['name'] }}</div>
                            </td>
                            <!-- Actions edit/delete -->
                            <td>
                                <a href="/hero/edit/{{$hero['id']}}" class="btn btn-primary">Edit</a>

                                <form action="/hero/{{ $hero['id'] }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button class="btn btn-danger">Delete</button>

                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection
