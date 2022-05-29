@extends('includes.admin.master_admin')
@section('title')
    {{$custom[strtolower('Edit')]??"lang not found"}}
@endsection
@section('head_style')
    @include('includes.admin.dataTables.head_DataTables')
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{$custom[strtolower('user')]??""}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{route('admin.dashboard')}}">{{$custom[strtolower('Home')]??""}}</a></li>
                            <li class="breadcrumb-item active">{{$custom[strtolower('user')]??""}}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card card-primary">
                            <div class="card-header">
                                {{$custom[strtolower('edit')]??""}}
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            @include('errors.error')
                            <form action="{{route('user.update',$data->id)}}" method="post" id="create"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('fullname') ? ' is-invalid' : "" }}">
                                                <label
                                                    for="fullname">{{$custom[strtolower('fullname')]??"lang not found"}}</label>
                                                <input type="text" name="fullname" class="form-control" id="fullname"
                                                       value="{{$data->fullname}}"
                                                       placeholder="{{$custom[strtolower('Enter_fullname')]??"lang not found"}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('email') ? ' is-invalid' : "" }}">
                                                <label
                                                    for="email">{{$custom[strtolower('email')]??"lang not found"}}</label>
                                                <input type="email" name="email" class="form-control" id="email"
                                                       value="{{$data->email}}"
                                                       placeholder="{{$custom[strtolower('Enter_email')]??"lang not found"}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('mobile') ? ' is-invalid' : "" }}">
                                                <label
                                                    for="mobile">{{$custom[strtolower('mobile')]??"lang not found"}}</label>
                                                <input type="text" name="mobile" class="form-control" id="mobile"
                                                       value="{{$data->mobile}}"
                                                       placeholder="{{$custom[strtolower('Enter_mobile')]??"lang not found"}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('order') ? ' is-invalid' : "" }}">
                                                <label
                                                    for="order">{{$custom[strtolower('order')]??"lang not found"}}</label>
                                                <input type="text" name="order" class="form-control" id="order"
                                                       value="{{$data->order}}"
                                                       placeholder="{{$custom[strtolower('Enter_order')]??"lang not found"}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('role_id') ? ' is-invalid' : "" }}">
                                                <label>{{$custom[strtolower('role')]??"lang not found"}}</label>
                                                <select class="form-control " id="role" name="role_id"
                                                        style="width: 100%;">
                                                    <option value="0"
                                                            id="option-role-0">{{$custom[strtolower('select')]??"lang not found"}}</option>
                                                    @foreach($role as $my)
                                                        <option value="{{$my->id}}"
                                                                id="option-role-{{$my->id}}"
                                                                @if($data->role_id = $my->id) selected @endif>{{$my->name->value ?? ""}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div
                                                class="form-group{{ $errors->has('country_id') ? ' is-invalid' : "" }}">
                                                <label>{{$custom[strtolower('Country')]??"lang not found"}}</label>
                                                <select class="form-control " id="country_id" name="country_id"
                                                        style="width: 100%;">
                                                    <option value="0"
                                                            id="option-country-0">{{$custom[strtolower('select')]??"lang not found"}}</option>
                                                    @foreach($country as $my)
                                                        <option value="{{$my->id}}"
                                                                id="option-country-{{$my->id}}"
                                                                @if($data->country_id = $my->id) selected @endif>{{$my->name->value ?? ""}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('city_id') ? ' is-invalid' : "" }}">
                                                <label>{{$custom[strtolower('city')]??"lang not found"}}</label>
                                                <select class="form-control " id="city_id" name="city_id"
                                                        style="width: 100%;">
                                                    <option value="0"
                                                            id="option-city-0">{{$custom[strtolower('select')]??"lang not found"}}</option>
                                                    @foreach($city as $my)
                                                        <option value="{{$my->id}}"
                                                                id="option-city-{{$my->id}}"
                                                                @if($data->city_id = $my->id) selected @endif>{{$my->name->value ?? ""}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('state_id') ? ' is-invalid' : "" }}">
                                                <label>{{$custom[strtolower('state')]??"lang not found"}}</label>
                                                <select class="form-control " id="state_id" name="state_id"
                                                        style="width: 100%;">
                                                    <option value="0"
                                                            id="option-state-0">{{$custom[strtolower('select')]??"lang not found"}}</option>
                                                    @foreach($state as $my)
                                                        <option value="{{$my->id}}"
                                                                id="option-state-{{$my->id}}"
                                                                @if($data->state_id = $my->id) selected @endif>{{$my->name->value ?? ""}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <img src="{{getImag($data->avatar,'user',$data->id)}}"
                                                 style="width:100px;height: 100px">
                                            <div class="form-group{{ $errors->has('avater') ? ' has-error' : "" }}">
                                                <label>{{$custom[strtolower('avater')]??'avater'}}</label>
                                                <input type="file" value="" name="avater"/>
                                                <label for="avater">jpg, png, gif</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('info') ? ' is-invalid' : "" }}">
                                                <label for="info">{{$custom[strtolower('info')]??"lang not found"}}</label>
                                                <textarea type="text" name="info" class="form-control" id="info"
                                                          placeholder="{{$custom[strtolower('info')]??"lang not found"}}">{{$data->info}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <!-- /.col -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit"
                                            class="btn btn-primary">{{$custom[strtolower('update')]??""}}</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-6">

                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script_style')
    <script>
        //city list for country
        $('#country_id').change(function () {
            GetCity($(this).val(), 0);
        });

        function GetCity(country, city) {
            url = '{{ route("city.list") }}';
            $.ajax({
                type: "GET",
                url: url,
                data: {'country_id': country},
                success: function (res) {
                    $(`#city_id`).empty();
                    $(`#city_id`).append('<option value="0">select</option>');
                    for (let x in res) {
                        for (let i in res[x]) {
                            if (res[x][i].id) {
                                if (res[x][i].id == city) {
                                    $(`#city_id`).append(`<option value="${res[x][i].id}" selected>${res[x][i].name}</option>`);
                                } else {
                                    $(`#city_id`).append(`<option value="${res[x][i].id}">${res[x][i].name}</option>`);
                                }
                            }
                        }
                    }
                    $(`#city_id`).val(city);
                }, error: function (res) {
                    for (let err in res.responseJSON.errors) {
                        toastr.error(res.responseJSON.errors[err]);
                    }
                }
            });
        }
        $('#city_id').change(function () {
            GetState($(this).val(), 0);
        });

        function GetState(city,state) {
            url = '{{ route("state.list") }}';
            $.ajax({
                type: "GET",
                url: url,
                data: {'city_id': city},
                success: function (res) {
                    $(`#state_id`).empty();
                    $(`#state_id`).append('<option value="0">select</option>');
                    for (let x in res) {
                        for (let i in res[x]) {
                            if (res[x][i].id) {
                                if (res[x][i].id == state) {
                                    $(`#state_id`).append(`<option value="${res[x][i].id}" selected>${res[x][i].name}</option>`);
                                } else {
                                    $(`#state_id`).append(`<option value="${res[x][i].id}">${res[x][i].name}</option>`);
                                }
                            }
                        }
                    }
                    $(`#state_id`).val(state);
                }, error: function (res) {
                    for (let err in res.responseJSON.errors) {
                        toastr.error(res.responseJSON.errors[err]);
                    }
                }
            });
        }
    </script>
    {!! JsValidator::formRequest('Modules\Acl\Http\Requests\User\EditRequest','#edit') !!}
@endsection
