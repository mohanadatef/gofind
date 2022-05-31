<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">{{$custom[strtolower('filter')]??"lang not found"}}</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool collapsible">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <!-- /.card-header -->
    <form action="{{route('property.index')}}" method="get">
        <div class="card-body" id="filter" style="display: none">
            <div class="row">
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{$custom[strtolower('category')]??"lang not found"}}</label>
                        <select class="form-control select2" multiple="multiple" id="category"
                                name="category_id[]"
                                data-placeholder="{{$custom[strtolower('select')]??"lang not found"}}">
                            @foreach($category as $my)
                                <option value="{{$my->id}}"
                                        id="option-category-{{$my->id}}"
                                        @if(Request::get('category_id') && in_array($my->id,Request::get('category_id'))) selected @endif>{{$my->name->value ?? ""}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{$custom[strtolower('tag')]??"lang not found"}}</label>
                        <select class="form-control select2" multiple="multiple" id="tag"
                                name="tag_id[]"
                                data-placeholder="{{$custom[strtolower('select')]??"lang not found"}}">
                            @foreach($tag as $my)
                                <option value="{{$my->id}}"
                                        id="option-tag-{{$my->id}}"
                                        @if(Request::get('tag_id') && in_array($my->id,Request::get('tag_id'))) selected @endif>{{$my->name->value ?? ""}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{$custom[strtolower('country')]??"lang not found"}}</label>
                        <select class="form-control select2" multiple="multiple" id="country"
                                name="country_id[]"
                                data-placeholder="{{$custom[strtolower('select')]??"lang not found"}}">
                            @foreach($country as $my)
                                <option value="{{$my->id}}"
                                        id="option-country-{{$my->id}}"
                                        @if(Request::get('country_id') && in_array($my->id,Request::get('country_id'))) selected @endif>{{$my->name->value ?? ""}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{$custom[strtolower('city')]??"lang not found"}}</label>
                        <select class="form-control select2" multiple="multiple" id="city"
                                name="city_id[]"
                                data-placeholder="{{$custom[strtolower('select')]??"lang not found"}}">
                            @foreach($city as $my)
                                <option value="{{$my->id}}"
                                        id="option-city-{{$my->id}}"
                                        @if(Request::get('city_id') && in_array($my->id,Request::get('city_id'))) selected @endif>{{$my->name->value ?? ""}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{$custom[strtolower('state')]??"lang not found"}}</label>
                        <select class="form-control select2" multiple="multiple" id="state"
                                name="state_id[]"
                                data-placeholder="{{$custom[strtolower('select')]??"lang not found"}}">
                            @foreach($state as $my)
                                <option value="{{$my->id}}"
                                        id="option-state-{{$my->id}}"
                                        @if(Request::get('state_id') && in_array($my->id,Request::get('state_id'))) selected @endif>{{$my->name->value ?? ""}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{$custom[strtolower('status')]??"lang not found"}}</label>
                        <select class="form-control"  id="status" name="status">
                                <option value="" id="option-status" @if(empty(Request::get('status')) &&  Request::get('status') === null) @else selected @endif>{{$custom[strtolower('select')]??"lang not found"}}</option>
                                <option value="1" id="option-status-1" @if(Request::get('status') &&  Request::get('status') == 1) selected @endif>{{$custom[strtolower('active')]??"lang not found"}}</option>
                                <option value="0" id="option-status-0" @if(empty(Request::get('status')) &&  Request::get('status') === "0") selected @endif>{{$custom[strtolower('unactive')]??"lang not found"}}</option>
                        </select>
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
            </div>
            <button type="submit" class="btn btn-primary">{{$custom[strtolower('filter')]??"lang not found"}}</button>
            <a href="{{  route('property.index') }}" class="btn btn-success"> {{$custom[strtolower('remove_filter')]??"lang not found"}}</a>
        </div>
    </form>
</div>
