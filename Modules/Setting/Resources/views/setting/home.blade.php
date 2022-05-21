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
                        <form action="{{route('setting.update-home')}}" method="post" id="edit" enctype="multipart/form-data">
                            @csrf
                            <div class="card card-primary">
                                <div class="card-header">
                                    {{$custom[strtolower('section_1')]??""}}
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('home_section_1_title') ? ' is-invalid' : "" }}">
                                                <label for="home_section_1_title">{{$custom[strtolower('home_section_1_title')]??'title'}}</label>
                                                <input type="text" name="home_section_1_title" class="form-control"
                                                       id="home_section_1_title"
                                                       value="{{$datas[strtolower('home_section_1_title')]}}"
                                                       placeholder="{{$custom[strtolower('home_section_1_title')]??"lang not found"}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <img src="{{getImageSetting('home_section_1_image','first')}}" style="width:100px;height: 100px">
                                            <div class="form-group{{ $errors->has('home_section_1_image') ? ' has-error' : "" }}">
                                                <label>{{$custom[strtolower('home_section_1_image')]??'image'}}</label>
                                                <input type="file" value="" name="home_section_1_image"/>
                                                <label for="home_section_1_image">jpg, png, gif</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has(strtolower('home_section_1_description')) ? ' is-invalid' : "" }}">
                                                <label for="{{strtolower('home_section_1_description')}}">{{$custom[strtolower('home_section_1_description')]??"description"}}</label>
                                                <textarea type="text" name="{{strtolower('home_section_1_description')}}" class="form-control" id="home_section_1_description"}}"
                                                          placeholder="{{$custom[strtolower('home_section_1_description')]??"lang not found"}}">{{$datas['home_section_1_description']}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has(strtolower('home_section_1_link')) ? ' is-invalid' : "" }}">
                                                <label for="{{strtolower('home_section_1_link')}}">{{$custom[strtolower('home_section_1_link')]??"link"}}</label>
                                                <textarea type="text" name="{{strtolower('home_section_1_link')}}" class="form-control" id="{{strtolower('home_section_1_link')}}"
                                                          placeholder="{{$custom[strtolower('home_section_1_link')]??"lang not found"}}">{{$datas['home_section_1_link']}}</textarea>
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
                                    {{$custom[strtolower('section_2')]??""}}
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('home_section_2_title') ? ' is-invalid' : "" }}">
                                                <label for="home_section_2_title">{{$custom[strtolower('home_section_2_title')]??'title'}}</label>
                                                <input type="text" name="home_section_2_title" class="form-control"
                                                       id="home_section_2_title"
                                                       value="{{$datas[strtolower('home_section_2_title')]}}"
                                                       placeholder="{{$custom[strtolower('home_section_2_title')]??"lang not found"}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('home_section_2_icon_video_link') ? ' is-invalid' : "" }}">
                                                <label for="home_section_2_icon_video_link">{{$custom[strtolower('home_section_2_icon_video_link')]??'link'}}</label>
                                                <input type="text" name="home_section_2_icon_video_link" class="form-control"
                                                       id="home_section_2_icon_video_link"
                                                       value="{{$datas[strtolower('home_section_2_icon_video_link')]}}"
                                                       placeholder="{{$custom[strtolower('home_section_2_icon_video_link')]??"lang not found"}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has(strtolower('home_section_2_description')) ? ' is-invalid' : "" }}">
                                                <label for="{{strtolower('home_section_2_description')}}">{{$custom[strtolower('home_section_2_description')]??"description"}}</label>
                                                <textarea type="text" name="{{strtolower('home_section_2_description')}}" class="form-control" id="home_section_2_description"}}"
                                                          placeholder="{{$custom[strtolower('home_section_2_description')]??"lang not found"}}">{{$datas['home_section_2_description']}}</textarea>
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
                                    {{$custom[strtolower('section_3')]??""}}
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('home_section_3_title') ? ' is-invalid' : "" }}">
                                                <label for="home_section_3_title">{{$custom[strtolower('home_section_3_title')]??'title'}}</label>
                                                <input type="text" name="home_section_3_title" class="form-control"
                                                       id="home_section_3_title"
                                                       value="{{$datas[strtolower('home_section_3_title')]}}"
                                                       placeholder="{{$custom[strtolower('home_section_3_title')]??"lang not found"}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            @foreach (getImageSetting('home_section_3_image') as $image  )
                                            <img src="{{$image}}"  style="width:100px;height: 100px">
                                            {{-- <div class="btn btn-danger delete-image" data-name="{{$image->id}}" style="bottom:15px">x</div> --}}
                                             @endforeach
                                            <div class="form-group{{ $errors->has('home_section_3_image') ? ' has-error' : "" }}">
                                                <label>{{$custom[strtolower('home_section_3_image')]??'image'}}</label>
                                                <input type="file" value="" name="home_section_3_image[]" multiple/>
                                                <label for="home_section_3_image">jpg, png, gif</label>
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
                                    {{$custom[strtolower('section_4')]??""}}
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('home_section_4_title') ? ' is-invalid' : "" }}">
                                                <label for="home_section_4_title">{{$custom[strtolower('home_section_4_title')]??'title'}}</label>
                                                <input type="text" name="home_section_4_title" class="form-control"
                                                       id="home_section_4_title"
                                                       value="{{$datas[strtolower('home_section_4_title')]}}"
                                                       placeholder="{{$custom[strtolower('home_section_4_title')]??"lang not found"}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                            <div class="form-group{{ $errors->has('home_section_4_url') ? ' is-invalid' : "" }}">
                                                <label for="home_section_4_url">{{$custom[strtolower('home_section_4_url')]??'url'}}</label>
                                                <input type="text" name="home_section_4_url" class="form-control"
                                                       id="home_section_4_url"
                                                       value="{{$datas[strtolower('home_section_4_url')]}}"
                                                       placeholder="{{$custom[strtolower('home_section_4_url')]??"lang not found"}}">
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
                                    {{$custom[strtolower('section_5')]??""}}
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('home_section_5_title') ? ' is-invalid' : "" }}">
                                                <label for="home_section_5_title">{{$custom[strtolower('home_section_5_title')]??'title'}}</label>
                                                <input type="text" name="home_section_5_title" class="form-control"
                                                       id="home_section_5_title"
                                                       value="{{$datas[strtolower('home_section_5_title')]}}"
                                                       placeholder="{{$custom[strtolower('home_section_5_title')]??"lang not found"}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <img src="{{getImageSetting('home_section_5_image','first')}}" style="width:100px;height: 100px">
                                            <div class="form-group{{ $errors->has('home_section_5_image') ? ' has-error' : "" }}">
                                                <label>{{$custom[strtolower('home_section_5_image')]??'image'}}</label>
                                                <input type="file" value="" name="home_section_5_image"/>
                                                <label for="home_section_5_image">jpg, png, gif</label>
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
    <script>
        $(function ()  {
            // Summernote
            $('#home_section_1_description').summernote();
            $('#home_section_2_description').summernote();
        })
    //     $(document).on("click",".delete-image",function(e){
    //     e.preventDefault();
    //     let image = $(this).data('name');
    //     $(this).parents(".image-block").html("<input type='hidden' name='removed_image[]' value=" + image + ">");
    // });
    </script>

    {!! JsValidator::formRequest('Modules\Setting\Http\Requests\Setting\EditRequest','#edit') !!}
@endsection
