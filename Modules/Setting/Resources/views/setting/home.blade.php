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
                        <h1>{{$custom[strtolower('home_setting')]??""}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{route('admin.dashboard')}}">{{$custom[strtolower('Home')]??""}}</a></li>
                            <li class="breadcrumb-item active">{{$custom[strtolower('home_setting')]??""}}</li>
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
                                    {{$custom[strtolower('section_1')]??""}}
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <div class="card-body">
                                    <div class="row">
                                        @foreach($language as $lang)
                                            <div class="col-md-6">
                                                <div
                                                    class="form-group{{ $errors->has('home_section_1_title['.$lang->code.']') ? ' is-invalid' : "" }}">
                                                    <label for="name">{{$custom[strtolower('home_section_1_title')]??"lang not found"}} {{$lang->name}}</label>
                                                    <input type="text" name="home_section_1_title[{{$lang->code}}]" class="form-control"
                                                           id="name[{{$lang->code}}]"
                                                           value="{{getSetting('home_section_1_title')->home_section_1_titleValue()[$lang->code]??""}}"
                                                           placeholder="{{$custom[strtolower('Enter_home_section_1_title')]??"lang not found"}} {{$lang->name}}">
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="col-md-6">
                                            <img src="{{getImageSetting('home_section_1_image','first')}}" style="width:100px;height: 100px">
                                            <div class="form-group{{ $errors->has('home_section_1_image') ? ' has-error' : "" }}">
                                                <label>{{$custom[strtolower('home_section_1_image')]??'image'}}</label>
                                                <input type="file" value="" name="home_section_1_image"/>
                                                <label for="home_section_1_image">jpg, png, gif</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <!-- /.col -->
                                </div>
                                <!-- /.card-body -->
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
    {!! JsValidator::formRequest('Modules\Setting\Http\Requests\Setting\EditRequest','#edit') !!}
@endsection
