<script>
    $('#modal-create').on('hidden.bs.modal', function (e) {
        $(this)
            .find("input,textarea,select").val('').end()
            .find("input[type=checkbox], input[type=radio]").prop("checked", "").end();
    });
    $('#modal-edit').on('hidden.bs.modal', function (e) {
        $(this)
            .find("input,textarea,select").val('').end()
            .find("input[type=checkbox], input[type=radio]").prop("checked", "").end();
    });
    $('#modal-forgotpassword').on('hidden.bs.modal', function (e) {
        $(this)
            .find("input,textarea,select").val('').end()
            .find("input[type=checkbox], input[type=radio]").prop("checked", "").end();
    });
    /*header ajax*/
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    /*global variable*/
    var id;
    var url;
    var model = window.location.href.split('/');
    model = model[model.length - 2]+'/'+model[model.length - 1].split('?')[0]
    /*create item*/
    $(document).ready(function () {
        $("#create").on("submit", function (event) {
            event.preventDefault();
            url = "{{url('model')}}";
            url = url.replace('model', model);
            $.ajax({
                type: "post",
                url: url,
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function (res) {
                    $('#body').append(res);
                    $('#modal-create').modal('toggle');
                    $('#create').trigger("reset");
                    toastr.success('{{$custom[strtolower('Create_Done')]??"lang not found"}}');
                    location.reload();
                }, error: function (res) {
                    for (let err in res.responseJSON.errors) {
                        toastr.error(res.responseJSON.errors[err])
                    }
                }
            });
        });
    });

    /*get id for item*/
    function selectItem(data) {
        id = data;
    }

    /*show item in model edit*/
    function showItem(data) {
        id = data;
        url = "{{url('model/id')}}";
        url = url.replace('id', id);
        url = url.replace('model', model);
        $.ajax({
            type: "get",
            url: url,
            success: function (res) {
                showData(res);
                $(`#openModael${res.id}`).click();
            }, error: function (res) {
                for (let err in res.responseJSON.errors) {
                    toastr.error(res.responseJSON.errors[err]);
                }
            }
        });
    }

    /*edit data*/
    $(document).ready(function () {
        $("#edit").on("submit", function (event) {
            event.preventDefault();
            url = "{{url('model/id')}}";
            url = url.replace('id', id);
            url = url.replace('model', model);
            $.ajax({
                type: "post",
                url: url,
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function (res) {
                    updateItem(res);
                    $('#modal-edit').modal('toggle');
                    toastr.info('{{$custom[strtolower('Edit_Done')]??"lang not found"}}');
                }, error: function (res) {
                    for (let err in res.responseJSON.errors) {
                        toastr.error(res.responseJSON.errors[err]);
                    }
                }
            });
        });
    });

    /*change status for item*/
    function changeStatus(data) {
        url = "{{url('model/change_status/id')}}";
        url = url.replace('id', data);
        url = url.replace('model', model);
        $.ajax({
            type: "GET",
            url: url,
            success: function () {
                $(`#status-${data}:checkbox:checked`).length == 1 ? toastr.info('{{$custom[strtolower('Active_Done')]??"lang not found"}}') : toastr.warning('{{$custom[strtolower('An_Active_Done')]??"lang not found"}}');
            }, error: function (res) {
                for (let err in res.responseJSON.errors) {
                    toastr.error(res.responseJSON.errors[err]);
                }
            }
        });
    }
    /*delete item*/
    function deleteItem() {
        url = "{{url('model/id')}}";
        url = url.replace('id', id);
        url = url.replace('model', model);
        $.ajax({
            type: "delete",
            url: url,
            success: function () {
                document.getElementById('data-' + id).remove();
                $('#modal-delete').modal('toggle');
                toastr.warning('{{$custom[strtolower('Delete_Done')]??"lang not found"}}');
            }, error: function (res) {
                for (let err in res.responseJSON.errors) {
                    toastr.error(res.responseJSON.errors[err]);
                }
            }
        });
    }

    /*restore item to index*/
    function restoreItem() {
        url = "{{url('model/restore/id')}}";
        url = url.replace('id', id);
        url = url.replace('model', model);
        $.ajax({
            type: "get",
            url: url,
            success: function () {
                document.getElementById('data-' + id).remove();
                $('#modal-restore').modal('toggle');
                toastr.warning('{{$custom[strtolower('Restore_Done')]??"lang not found"}}');
            }, error: function (res) {
                for (let err in res.responseJSON.errors) {
                    toastr.error(res.responseJSON.errors[err]);
                }
            }
        });
    }

    /*change password data*/
    $(document).ready(function () {
        $("#forgotpassword").on("submit", function (event) {
            event.preventDefault();
            url = "{{url('model/forgetpassword/id')}}";
            url = url.replace('model', model);
            url = url.replace('id', id);
            $.ajax({
                type: "post",
                url: url,
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function (res) {
                    $('#modal-forgotpassword').modal('toggle');
                    toastr.info('{{$custom[strtolower('Edit_Password')]??"lang not found"}}');
                    location.reload();
                }, error: function (res) {
                    for (let err in res.responseJSON.errors) {
                        toastr.error(res.responseJSON.errors[err]);
                    }
                }
            });
        });
    });
</script>
@yield('curl')
