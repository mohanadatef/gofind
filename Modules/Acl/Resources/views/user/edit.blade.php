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
                                                <select class="form-control " id="country" name="country_id"
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
                                                <select class="form-control " id="city" name="city_id"
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
                                                <select class="form-control " id="state" name="state_id"
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
                                            <img src="{{getFile($data->avater->file,pathType()['ip'],'user')}}"
                                                 style="width:100px;height: 100px">
                                            <div class="form-group{{ $errors->has('avater') ? ' has-error' : "" }}">
                                                <label>{{$custom[strtolower('avater')]??'avater'}}</label>
                                                <input type="file" value="" name="avater"/>
                                                <label for="avater">jpg, png, gif</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <!-- /.col -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit"
                                            class="btn btn-primary">{{$custom[strtolower('Create')]??""}}</button>
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
    {!! JsValidator::formRequest('Modules\Acl\Http\Requests\User\UpdateRequest','#edit') !!}
@endsection
