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
                        <h1>{{$custom[strtolower('User')]??"lang not found"}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{route('admin.dashboard')}}">{{$custom[strtolower('Home')]??"lang not found"}}</a>
                            </li>
                            <li class="breadcrumb-item active">{{$custom[strtolower('User')]??"lang not found"}}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @permission('user-filter')
                @include('acl::user.filter')
                @endpermission
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    @permission('user-create')
                                    <a href="{{  route('user.create') }}"
                                       class="btn btn-success"> {{$custom[strtolower('Create')]??"lang not found"}}</a>
                                    @endpermission
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>{{$custom[strtolower('Full_Name')]??"lang not found"}}</th>
                                        <th>{{$custom[strtolower('Email')]??"lang not found"}}</th>
                                        <th>{{$custom[strtolower('Mobile')]??"lang not found"}}</th>
                                        <th>{{$custom[strtolower('Role')]??"lang not found"}}</th>
                                        <th>{{$custom[strtolower('Avatar')]??"lang not found"}}</th>
                                        @permission('user-change-status')
                                        <th>{{$custom[strtolower('Status')]??"lang not found"}}</th>
                                        @endpermission
                                        <th>{{$custom[strtolower('action')]??"lang not found"}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="body">
                                    @forelse($datas as $data)
                                        <tr id="data-{{$data->id}}">
                                            <td id="full-name-{{$data->id}}">{{$data->fullname}}</td>
                                            <td id="email-{{$data->id}}">{{$data->email ?? ""}}</td>
                                            <td id="mobile-{{$data->id}}">{{$data->mobile}}</td>
                                            <td id="role-{{$data->id}}">{{$data->role->name->value ?? ""}}</td>
                                            <td id="avatar-{{$data->id}}"><img
                                                    src="{{ getImag($data->avatar,'User') }}"
                                                    id="avatar-{{$data->id}}" style="width:100px;height: 100px">
                                            </td>
                                            @permission('user-change-status')
                                            <td>
                                                @if($data->id != user()->id)
                                                    <input onfocus="changeStatus({{$data->id}})" type="checkbox"
                                                           name="status" @if($data->status) checked
                                                           @endif id="status-{{$data->id}}"
                                                           data-bootstrap-switch data-off-color="danger"
                                                           data-on-color="success">
                                                @endif
                                            </td>
                                            @endpermission
                                            <td>
                                                @if($data->id != user()->id)
                                                @permission('user-edit')
                                                <a href="{{  route('user.edit',$data->id) }}"
                                                   class="btn btn-outline-primary btn-block btn-sm"><i class="fa fa-edit"></i>{{$custom[strtolower('Edit')]??""}}</a>
                                                @endpermission
                                                @permission('user-delete')
                                                    <button type="button"
                                                            class="btn btn-outline-danger btn-block btn-sm"
                                                            onclick="selectItem({{$data->id}})" data-toggle="modal"
                                                            data-target="#modal-delete">
                                                        <i></i> {{$custom[strtolower('Delete')]??"lang not found"}}
                                                    </button>
                                                @endpermission
                                                    @permission('user-change-password')
                                                    <button type="button"
                                                            class="btn btn-outline-danger btn-block btn-sm"
                                                            onclick="selectItem({{$data->id}})" data-toggle="modal"
                                                            data-target="#modal-forgotpassword"><i></i>{{$custom[strtolower('Change_Password')]??""}}
                                                    </button>
                                                    @endpermission
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>{{$custom[strtolower('Full_Name')]??"lang not found"}}</th>
                                        <th>{{$custom[strtolower('Email')]??"lang not found"}}</th>
                                        <th>{{$custom[strtolower('Mobile')]??"lang not found"}}</th>
                                        <th>{{$custom[strtolower('Role')]??"lang not found"}}</th>
                                        <th>{{$custom[strtolower('Avatar')]??"lang not found"}}</th>
                                        @permission('user-change-status')
                                        <th>{{$custom[strtolower('Status')]??"lang not found"}}</th>
                                        @endpermission
                                        <th>{{$custom[strtolower('action')]??"lang not found"}}</th>
                                    </tr>
                                    </tfoot>
                                </table>
                                {{ $datas->appends($_GET)->links('includes.admin.dataTables.pagination', ['paginator' => $datas,'perPage' =>Request::get('perPage') ?? $datas->perPage()]) }}
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    @permission('user-change-password')
    <div class="modal fade" id="modal-forgotpassword">
        <div class="modal-dialog">
            <div class="modal-content bg-success">
                <div class="modal-header">
                    <h4 class="modal-title">{{trans('lang.Change_Password')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="forgotpassword" method="post" action="">
                    @csrf
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="form-group{{ $errors->has('password') ? ' is-invalid' : "" }}">
                                <label for="password">{{trans('lang.Password')}}</label>
                                <input type="password" name="password" class="form-control" id="password"
                                       value="{{Request::old('password')}}"
                                       placeholder="{{trans('lang.Enter_Password')}}">
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' is-invalid' : "" }}">
                                <label for="password">{{trans('lang.Password_Confirmation')}}</label>
                                <input type="password" name="password_confirmation" class="form-control"
                                       id="password_confirmation"
                                       value="{{Request::old('password_confirmation')}}"
                                       placeholder="{{trans('lang.Enter_Password_Confirmation')}}">
                            </div>
                        </div>
                        <!-- /.card-body -->

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light"
                                data-dismiss="modal">{{trans('lang.Close')}}</button>
                        <button type="submit" class="btn btn-outline-light">{{trans('lang.Update')}}</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    @endpermission
@endsection
@section('script_style')
    @include('includes.admin.dataTables.script_DataTables')
@endsection
