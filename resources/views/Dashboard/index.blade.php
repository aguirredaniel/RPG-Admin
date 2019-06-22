@extends('layouts.app')

@section('content')


    <h3>Maximum Number of Available Heroes:
        <span class="label label-primary">
            {{$data->availableHeroes[0]->count}}
        </span>
    </h3>
    <br/>
    <div class="row">
        <!-- Hero Race Popularity -->
        <div class="col-md-4">
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">Hero Race Popularity</div>
                @if (count($data->heroRacePopularity) == 0)
                    <div class="panel-body">
                        Not available hero race data
                    </div>
                @endif
                <ul class="list-group">
                    @foreach($data->heroRacePopularity as $heroRacePopularity)
                        <li class="list-group-item">
                            <span class="badge">  {{$heroRacePopularity->count}}</span>
                            {{$heroRacePopularity->race}}
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>

        <!-- Hero Class Popularity -->
        <div class="col-md-4">
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">Hero Class Popularity</div>
                @if (count($data->heroClassPopularity) == 0)
                    <div class="panel-body">
                        Not available hero class data
                    </div>
                @endif
                <ul class="list-group">
                    @foreach($data->heroClassPopularity as $heroClassPopularity)
                        <li class="list-group-item">
                            <span class="badge">  {{$heroClassPopularity->count}}</span>
                            {{$heroClassPopularity->class}}
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>

        <!-- Hero Weapon Popularity -->
        <div class="col-md-4">
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">Hero Weapon Popularity</div>
                @if (count($data->heroWeaponPopularity) == 0)
                    <div class="panel-body">
                        Not available weapon class data
                    </div>
                @endif
                <ul class="list-group">
                    @foreach($data->heroWeaponPopularity as $heroWeaponPopularity)
                        <li class="list-group-item">
                            <span class="badge ">
                                {{$heroWeaponPopularity->count}}
                            </span>
                            {{$heroWeaponPopularity->weapon}}
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>

@endsection
