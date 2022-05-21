@extends('includes.admin.master_admin')
@section('title')
     {{$custom[strtolower('Index')]??"lang not found"}}
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
                        <h1>{{$custom[strtolower('Setting')]??""}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{route('admin.dashboard')}}">{{$custom[strtolower('Home')]??""}}</a></li>
                            <li class="breadcrumb-item active">{{$custom[strtolower('Page')]??""}}</li>
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
                    @include('errors.error')
                        <!-- jquery validation -->
                        <form action="{{route('setting.update')}}" method="post" id="edit" enctype="multipart/form-data">
                            @csrf
                            <div class="card card-primary">
                                <div class="card-header">
                                    {{$custom[strtolower('main')]??""}}
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('name') ? ' is-invalid' : "" }}">
                                                <label for="name">{{$custom[strtolower('name')]??'name'}}</label>
                                                <input type="text" name="name" class="form-control"
                                                       id="name"
                                                       value="{{$datas[strtolower('name')]}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <img src="{{getLogoSetting()}}" style="width:100px;height: 100px">
                                            <div class="form-group{{ $errors->has('logo') ? ' has-error' : "" }}">
                                                <label>{{$custom[strtolower('logo')]??'logo'}}</label>
                                                <input type="file" value="" name="logos"/>
                                                <label for="logo">jpg, png, gif</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has(strtolower('Version')) ? ' is-invalid' : "" }}">
                                                <label for="{{strtolower('Version')}}">{{$custom[strtolower('Version')]??'name'}}</label>
                                                <input type="text" name="{{strtolower('Version')}}" class="form-control"
                                                       id="{{strtolower('Version')}}"
                                                       value="{{$datas[strtolower('Version')]}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <!-- /.col -->
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <div class="card card-primary">
                                <div class="card-header">
                                    {{$custom[strtolower('links')]??""}}
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('facebook') ? ' is-invalid' : "" }}">
                                                <label for="facebook">{{$custom[strtolower('facebook')]??'facebook'}}</label>
                                                <input type="text" name="facebook" class="form-control"
                                                       id="facebook"
                                                       value="{{$datas[strtolower('facebook')]}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('youtube') ? ' is-invalid' : "" }}">
                                                <label for="youtube">{{$custom[strtolower('youtube')]??'facebook'}}</label>
                                                <input type="text" name="youtube" class="form-control"
                                                       id="youtube"
                                                       value="{{$datas[strtolower('youtube')]}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('linkedIn') ? ' is-invalid' : "" }}">
                                                <label for="linkedIn">{{$custom[strtolower('linkedIn')]??'facebook'}}</label>
                                                <input type="text" name="linkedIn" class="form-control"
                                                       id="linkedIn"
                                                       value="{{$datas[strtolower('linkedIn')]}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('ios') ? ' is-invalid' : "" }}">
                                                <label for="ios">{{$custom[strtolower('ios')]??'facebook'}}</label>
                                                <input type="text" name="ios" class="form-control"
                                                       id="ios"
                                                       value="{{$datas[strtolower('ios')]}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('android') ? ' is-invalid' : "" }}">
                                                <label for="android">{{$custom[strtolower('android')]??'facebook'}}</label>
                                                <input type="text" name="android" class="form-control"
                                                       id="android"
                                                       value="{{$datas[strtolower('android')]}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <!-- /.col -->
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <div class="card card-primary">
                                <div class="card-header">
                                    {{$custom[strtolower('otp')]??""}}
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('otp_authorization') ? ' is-invalid' : "" }}">
                                                <label for="otp_authorization">{{$custom[strtolower('otp_authorization')]??'otp_authorization'}}</label>
                                                <input type="text" name="otp_authorization" class="form-control"
                                                       id="otp_authorization"
                                                       value="{{$datas[strtolower('otp_authorization')]??null}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('otp_app_id') ? ' is-invalid' : "" }}">
                                                <label for="otp_app_id">{{$custom[strtolower('otp_app_id')]??'otp_app_id'}}</label>
                                                <input type="text" name="otp_app_id" class="form-control"
                                                       id="otp_app_id"
                                                       value="{{$datas[strtolower('otp_app_id')]??null}}"
                                                       placeholder="{{$custom[strtolower('Enter_Value')]??"lang not found"}}">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <!-- /.col -->
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">{{$custom[strtolower('Update')]??""}}</button>
                            </div>
                        <!-- /.card -->
                        </form>
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
        $(function ()  {
            // Summernote
            $('#swear').summernote();
        })
    </script>
    {!! JsValidator::formRequest('Modules\Setting\Http\Requests\Setting\EditRequest','#edit') !!}
@endsection
