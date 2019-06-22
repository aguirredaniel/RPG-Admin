@extends('layouts.app')

@section('content')
    <div class="row"
         ng-app="hero-module"
         ng-controller="HeroController as vm">
        <div class="col-md-12">
            <!-- START panel-->
            <div class="panel panel-default">
                <div class="panel-heading">Hero form</div>
                <div class="panel-body">
                    <form role="form">
                        <!-- Names -->
                        <div class="row">
                            <!-- First name -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>First name</label>
                                    <input class="form-control m-b" placeholder="Enter a first name"
                                            ng-model="vm.hero.firstName"/>
                                  {{--      <option value="" disabled selected>Select a name</option>
                                        <option
                                            ng-repeat="firstName in vm.viewData.firstNames track by $index"
                                            value="<%firstName%>">
                                            <%firstName%>
                                        </option>
                                    </input>--}}
                                    <span class="text-danger"><%vm.viewData.errors['first_name']%></span>
                                </div>
                            </div>
                            <!-- Last name -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Last name</label>
                                    <input class="form-control m-b" placeholder="Enter a last name"
                                            ng-model="vm.hero.lastName" ng-readonly="!vm.hero.needLastName"/>
                                       {{-- <option value="" disabled selected>Select a last name</option>
                                        <option
                                            ng-repeat="lastNmae in vm.viewData.lastNames track by $index"
                                            value="<%lastNmae%>">
                                            <%lastNmae%>
                                        </option>
                                    </select>--}}
                                    <span class="text-danger"><%vm.viewData.errors['last_name']%></span>
                                </div>
                            </div>
                        </div>
                        <!-- Attributes -->
                        <div class="row">
                            <!-- Race -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Race</label>
                                    <select class="form-control m-b"
                                            ng-model="vm.hero.race"
                                            ng-change="vm.onSelectRace()">
                                        <option value="" disabled selected>Select a race</option>
                                        <option
                                            ng-repeat="race in vm.viewData.races track by $index"
                                            value="<%race.id%>">
                                            <%race.name%>
                                        </option>
                                    </select>
                                    <span class="text-danger"><%vm.viewData.errors['race']%></span>

                                </div>
                            </div>
                            <!-- Class -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Class</label>
                                    <select class="form-control m-b"
                                            ng-model="vm.hero.class"
                                            ng-change="vm.onSelectClass()">>
                                        <option value="" disabled selected>Select a class</option>
                                        <option
                                            ng-repeat="class in vm.viewData.classes track by $index"
                                            value="<%class.id%>">
                                            <%class.name%>
                                        </option>
                                    </select>
                                    <span class="text-danger"><%vm.viewData.errors['class']%></span>
                                </div>
                            </div>
                            <!-- Weapon -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Weapon</label>
                                    <select class="form-control m-b"
                                            ng-model="vm.hero.weapon">
                                        <option value="" disabled selected>Select a weapon</option>
                                        <option
                                            ng-repeat="weapon in vm.viewData.weapons track by $index"
                                            value="<%weapon.id%>">
                                            <%weapon.name%>
                                        </option>
                                    </select>
                                    <span class="text-danger"><%vm.viewData.errors['weapon']%></span>
                                </div>
                            </div>
                        </div>
                        <!-- Strength -->
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Strength</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" ng-model="vm.hero.strength.result"
                                               readonly="readonly">
                                        <span class="input-group-btn">
                                    <button ng-click="vm.hero.strength.roll()" type="button" class="btn btn-default">Roll</button>
                                 </span>
                                    </div>
                                </div>
                                <span class="text-danger"><%vm.viewData.errors['strength']%></span>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label></label>
                                    <ul class="list-inline" ng-if="vm.hero.strength.itsRolled">
                                        <li class=""
                                            ng-repeat="value in vm.hero.strength.values track by $index">
                                        <span ng-class="{'font-bold text-primary': value.itsHigher}"
                                        ><%value.val%></span>
                                        </li>
                                    </ul>
                                    <label class="text-danger" ng-if="!vm.hero.strength.isValidResult()">
                                        *invalid result*
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- Intelligence -->
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Intelligence</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" ng-model="vm.hero.intelligence.result"
                                               readonly="readonly">
                                        <span class="input-group-btn">
                                    <button ng-click="vm.hero.intelligence.roll()" type="button"
                                            class="btn btn-default">
                                        Roll
                                    </button>
                                 </span>
                                    </div>
                                </div>
                                <span class="text-danger"><%vm.viewData.errors['intelligence']%></span>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label></label>
                                    <ul class="list-inline" ng-if="vm.hero.intelligence.itsRolled">
                                        <li class=""
                                            ng-repeat="value in vm.hero.intelligence.values track by $index">
                                        <span ng-class="{'font-bold text-primary': value.itsHigher}"
                                        ><%value.val%></span>
                                        </li>
                                    </ul>
                                    <label class="text-danger" ng-if="!vm.hero.intelligence.isValidResult()">
                                        *invalid result*
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- Dexterity -->
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Dexterity</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" ng-model="vm.hero.dexterity.result"
                                               readonly="readonly">
                                        <span class="input-group-btn">
                                    <button ng-click="vm.hero.dexterity.roll()" type="button" class="btn btn-default">
                                        Roll
                                    </button>
                                 </span>
                                    </div>
                                </div>
                                <span class="text-danger"><%vm.viewData.errors['dexterity']%></span>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label></label>

                                    <ul class="list-inline" ng-if="vm.hero.dexterity.itsRolled">
                                        <li class=""
                                            ng-repeat="value in vm.hero.dexterity.values track by $index">
                                        <span ng-class="{'font-bold text-primary': value.itsHigher}"
                                        ><%value.val%></span>
                                        </li>
                                    </ul>
                                    <label class="text-danger" ng-if="!vm.hero.dexterity.isValidResult()">
                                        *invalid result*
                                    </label>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-sm btn-success"
                                ng-click="vm.storeHero()">Save hero
                        </button>

                        <button class="btn btn-sm btn-default"
                                ng-click="vm.hero.reset()">Discard hero
                        </button>
                    </form>
                </div>
            </div>
            <!-- END panel-->
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.8/angular.min.js">
    </script>
    <script type="text/javascript">
        window.id = Number('{{$id}}');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script type="text/javascript" src="{{ URL::asset('js/app/hero/hero.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/app/hero/hero.service.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/app/hero/angular/hero.module.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/app/hero/angular/hero.services.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/app/hero/angular/hero.controller.js') }}"></script>
@endsection

