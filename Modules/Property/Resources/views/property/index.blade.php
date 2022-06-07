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
                        <h1>{{$custom[strtolower('property')]??"lang not found"}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{route('admin.dashboard')}}">{{$custom[strtolower('Home')]??"lang not found"}}</a>
                            </li>
                            <li class="breadcrumb-item active">{{$custom[strtolower('property')]??"lang not found"}}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @permission('property-filter')
                @include('property::property.filter')
                @endpermission
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    @permission('property-create')
                                    <a href="{{  route('property.create') }}"
                                       class="btn btn-success"> {{$custom[strtolower('Create')]??"lang not found"}}</a>
                                    @endpermission
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>{{$custom[strtolower('Name')]??"lang not found"}}</th>
                                        <th>{{$custom[strtolower('user')]??"lang not found"}}</th>
                                        @permission('property-change-status')
                                        <th>{{$custom[strtolower('Status')]??"lang not found"}}</th>
                                        @endpermission
                                        <th>{{$custom[strtolower('action')]??"lang not found"}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="body">
                                    @forelse($datas as $data)
                                        <tr id="data-{{$data->id}}">
                                            <td id="name-{{$data->id}}">{{$data->name}}</td>
                                            <td id="user-{{$data->id}}">{{$data->user->first_name}}</td>
                                            @permission('property-change-status')
                                            <td>
                                                    <input onfocus="changeStatus({{$data->id}})" type="checkbox"
                                                           name="status" @if($data->status) checked
                                                           @endif id="status-{{$data->id}}"
                                                           data-bootstrap-switch data-off-color="danger"
                                                           data-on-color="success">
                                            </td>
                                            @endpermission
                                            <td>
                                                @permission('property-contact-us')
                                                <a href="{{  route('contact_us.index',['property_id'=>$data->id]) }}"
                                                   class="btn btn-outline-primary btn-block btn-sm"><i class="fa fa-edit"></i>{{$custom[strtolower('show_contact_us')]??""}}</a>
                                                @endpermission
                                                @permission('property-edit')
                                                <a href="{{  route('property.edit',$data->id) }}"
                                                   class="btn btn-outline-primary btn-block btn-sm"><i class="fa fa-edit"></i>{{$custom[strtolower('Edit')]??""}}</a>
                                                @endpermission
                                                @permission('property-delete')
                                                    <button type="button"
                                                            class="btn btn-outline-danger btn-block btn-sm"
                                                            onclick="selectItem({{$data->id}})" data-toggle="modal"
                                                            data-target="#modal-delete">
                                                        <i></i> {{$custom[strtolower('Delete')]??"lang not found"}}
                                                    </button>
                                                @endpermission
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>{{$custom[strtolower('Name')]??"lang not found"}}</th>
                                        <th>{{$custom[strtolower('user')]??"lang not found"}}</th>
                                        @permission('property-change-status')
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
@endsection
@section('script_style')
    @include('includes.admin.dataTables.script_DataTables')
@endsection
