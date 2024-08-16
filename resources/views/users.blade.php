@extends('layout.wepper')
@section('content')
    <style>
        .icheck-primary.d-inline {
            max-height: 17px;
            margin-top: 1px !important;
            margin-bottom: 1px !important;
            padding-left: 0;
        }

        .input-group {
            display: inline-flex;
            width: 100% !important;
            height: calc(1.25rem + 6px) !important;
        }

        label.col-form-label.paidcheck {
            width: auto !important;
            vertical-align: middle;
        }

        .cursor-pointer {
            cursor: pointer;
        }

        .prmision tbody tr td {
            text-align: left;
            padding-left: 10px;
        }
    </style>
    <section class="content">
        <div class="container-fluid">
            <input type="hidden" value="0" id="is_capital">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-right mb-2">
                        <button type="button" class="btn" data-toggle="modal" data-target="#modal-lg">
                            Add User
                        </button>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsiv w-auto">
                                <table class="table table-bordered w-auto">
                                    <thead>
                                        <tr>
                                            <th style="min-width:30px;">ID</th>
                                            <th style="min-width:100px;">Name</th>
                                            <th style="min-width:200px;">email</th>
                                            <th style="min-width:100px;">branch name</th>
                                            <th style="min-width:100px;">Role</th>
                                            <th style="min-width:100px;">action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 0;
                                        @endphp
                                        @foreach ($user as $key => $u)
                                            @if ($u->id !== 7)
                                                <tr>
                                                    <td>{{ ++$no }}</td>
                                                    <td>{{ $u->name }}</td>
                                                    <td>{{ $u->email }}</td>
                                                    <td class="userbrance">
                                                        <select class="form-control brancedrop"
                                                            data-dropdown-css-class="select2-danger" name="branch_name"
                                                            id="branch_{{ $u->id }}"
                                                            data-user_id='{{ $u->id }}'>
                                                            @foreach ($brance as $b)
                                                                <option value="{{ $b->id }}"
                                                                    {{ $b->branch_name == $u->branch_name ? 'selected' : '' }}>
                                                                    {{ $b->branch_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select class="form-control roledrop"
                                                            data-dropdown-css-class="select2-danger" name="roles"
                                                            id="roles_{{ $u->id }}"
                                                            data-user_id='{{ $u->id }}'>
                                                            @if ($u->user_type == 'sup_admin')
                                                                <option value="sup_admin"
                                                                    {{ $u->user_type == 'sup_admin' ? 'selected' : '' }}>
                                                                    SUPER
                                                                    ADMIN
                                                                </option>
                                                            @else
                                                                <option value="admin"
                                                                    {{ $u->user_type == 'admin' ? 'selected' : '' }}>ADMIN
                                                                </option>
                                                                <option value="purchase"
                                                                    {{ $u->user_type == 'purchase' ? 'selected' : '' }}>
                                                                    PURCHASER</option>
                                                                <option value="seller"
                                                                    {{ $u->user_type == 'seller' ? 'selected' : '' }}>
                                                                    SELLER
                                                                </option>
                                                                <option value="operator"
                                                                    {{ $u->user_type == 'operator' ? 'selected' : '' }}>
                                                                    OPERATOR</option>
                                                            @endif
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-primary d-inline">
                                                                <button type="button"
                                                                    class="btn editbtn"data-toggle="modal"
                                                                    data-target="#modal-edit"data-user_id='{{ $u->id }}'>
                                                                    Edit
                                                                </button>
                                                                <button data-user_id='{{ $u->id }}' type="button"
                                                                    class="btn permissions">Permissions</button>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="new_user" method="POST" action="{{ route('new.user.save') }}">
                        {{ csrf_field() }}
                        <div class="col-md-12 row mt-1">
                            <div class="col-md-6 pr-1">
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control name" placeholder="Enter Name" name="name">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fa fa-user" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="input-group mb-2">
                                    <input type="email" class="form-control email" placeholder="Enter Your Email"
                                        name="email">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fa fa-envelope" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 row">
                            <div class="col-md-6 pr-1">
                                <div class="input-group mb-2">
                                    <input type="password" class="form-control password" placeholder="Password"
                                        name="password">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fa fa-eye-slash passwordbtn" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6  pr-1">
                                <div class="input-group mb-2">
                                    <input type="password" class="form-control conform_password"
                                        placeholder="Confirm Password" name="conform_password">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fa fa-eye-slash showconform" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 row">
                            <div class="col-md-5 row">
                                <div class="form-group row">
                                    <label class="col-form-label paidcheck" for="delete">BRANCE NAME</label>
                                    <div class="input-group-paidchecks">
                                        <select class="form-control brancedrop" data-dropdown-css-class="select2-danger"
                                            name="branch_name" id="branch">
                                            @foreach ($brance as $b)
                                                <option value="{{ $b->id }}">
                                                    {{ $b->branch_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 row">
                                <div class="form-group row">
                                    <label class="col-form-label paidcheck" for="delete">ROLE</label>
                                    <div class="input-group-paidchecks">
                                        <select class="form-control roledrop" data-dropdown-css-class="select2-danger"
                                            name="roles" id="roles">
                                            <option value="admin">ADMIN</option>
                                            <option value="purchase">PURCHASER</option>
                                            <option value="seller">SELLER</option>
                                            <option value="operator">OPERATOR</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <h6 class="mt-3">PERMISSIONS</h6>
                        <div class="col-md-12 row mb-2">
                            <table class="table prmision">
                                <tr>
                                    <td>
                                        <div style="display: inline-flex;padding-top: 5px;">
                                            <input type="checkbox" id="add" name="add">
                                            <span class="pl-2">ADD</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="display: inline-flex;padding-top: 5px;">
                                            <input type="checkbox" id="edit" name="edit">
                                            <span class="pl-2">EDIT</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="display: inline-flex;padding-top: 5px;">
                                            <input type="checkbox" id="delete" name="delete">
                                            <span class="pl-2">DELETE</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div style="display: inline-flex;padding-top: 5px;">
                                            <input type="checkbox" id="masters_side" name="masters_side"
                                                style="width: auto">
                                            <span class="pl-2">MASTER</span>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn" data-dismiss="modal">Close</button>
                    <button type="button" class="btn adduser">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="edit_user" method="POST" action="{{ route('new.user.update') }}" id="editform">
                        {{ csrf_token() }}
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn" data-dismiss="modal">Close</button>
                    <button type="button" class="btn edituser">update</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-permission-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit User Permission</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn" data-dismiss="modal">Close</button>
                    <button type="button" class="btn edituserpermission">update</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('js/custom.js?v=' . time()) }} "></script>
    <script>
        $(document).on('change', '.brancedrop', function() {
            var user_id = $(this).data('user_id');
            var value = $(this).val();
            var type = 'branch_id';
            postAjax("{{ route('user-update') }}", {
                'user_id': user_id,
                'value': value,
                'type': type,
                '_token': "{{ csrf_token() }}"
            }, function(res) {
                if (res.status == "Error") {
                    swal(
                        res.status,
                        res.message,
                        'error'
                    );
                }
            });

        });
        $(document).on('change', '.roledrop', function() {
            var user_id = $(this).data('user_id');
            var value = $(this).val();
            var type = 'role';
            postAjax("{{ route('user-update') }}", {
                'user_id': user_id,
                'value': value,
                'type': type,
                '_token': "{{ csrf_token() }}"
            }, function(res) {
                if (res.status == "Error") {
                    swal(
                        res.status,
                        res.message,
                        'error'
                    );
                }
            });

        });
        $(document).on('change', '.permision', function() {
            var user_id = $(this).data('user_id');
            var type = $(this).data('type');

            if ($(this).is(':checked')) {
                var check = 1;

            } else {
                var check = 0;
            }

            postAjax("{{ route('user-update') }}", {
                'user_id': user_id,
                'value': check,
                'type': type,
                '_token': "{{ csrf_token() }}"
            }, function(res) {
                if (res.status == "Error") {
                    swal(
                        res.status,
                        res.message,
                        'error'
                    );
                }
            });
        });
        $(document).on('click', '.adduser', function() {
            $('#modal-lg').modal('toggle');
            $('.new_user').ajaxForm(function(res) {
                if (res.status == 'Success') {
                    swal(
                        res.status,
                        res.message,
                        'success'
                    );
                } else {
                    swal(
                        res.status,
                        res.message,
                        'error'
                    );
                }
            }).submit();

        });
        $(document).on('click', '.edituser', function() {
            var id = $('#editid').val();
            var name = $('#editname').val();
            var email = $('#edit_email').val();
            var password = $('#editpassword').val();
            var conform_password = $('#editconpassword').val();

            postAjax("{{ route('new.user.update') }}", {
                'id': id,
                'name': name,
                'email': email,
                'password': password,
                'conform_password': conform_password,
                '_token': "{{ csrf_token() }}"
            }, function(res) {
                if (res.status == 'Success') {
                    swal(
                        res.status,
                        res.message,
                        'success',
                    );
                    $('#modal-edit').modal('toggle');
                } else {
                    swal(
                        res.status,
                        res.message,
                        'error'
                    );
                }
            });
        });
        $(document).on('click', '.editbtn', function() {
            $('#editform').empty();
            var user_id = $(this).data('user_id');
            postAjax("{{ route('edit.user') }}", {
                'id': user_id,
                '_token': "{{ csrf_token() }}"
            }, function(res) {
                if (res.status == 'Success') {
                    var data = res.data;
                    blank_row(data);
                } else {
                    swal(
                        res.status,
                        res.message,
                        'error'
                    );
                }
            })
        });

        function blank_row(data) {
            for (let index = 0; index < data.length; index++) {
                const td = data[index];

                var markup = '';
                markup = `<div class="col-md-12 row mt-1">
                             <div class="col-md-6 pr-1">
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control name" placeholder="Enter Name" name="name" value="${td.name}" id="editname">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fa fa-user" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 pr-1">
                                <div class="input-group mb-2">
                                    <input type="email" class="form-control email" placeholder="Enter Your Email"
                                        name="email" id="edit_email" value="${td.email}">
                                        <input type="hidden" class="form-control id" name="id" id="editid" value="${td.id}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fa fa-envelope" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 row">
                            <div class="col-md-6 pr-1">
                                <div class="input-group mb-2">
                                    <input type="password" class="form-control password" placeholder="Password"
                                        name="password" id="editpassword">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fa fa-eye-slash passwordbtn" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-2">
                                    <input type="password" class="form-control conform_password"
                                        placeholder="Confirm Password" name="conform_password" id="editconpassword">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fa fa-eye-slash showconform" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
            }
            $("#editform").append(markup);
        }
        $(document).on('click', '.showconform', function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            $('.conform_password').attr('type') === 'password' ? $('.conform_password').attr('type', 'text') :
                $(
                    '.conform_password').attr('type', 'password');
        });
        $(document).on('click', '.passwordbtn', function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            $('.password').attr('type') === 'password' ? $('.password').attr('type', 'text') : $('.password')
                .attr(
                    'type', 'password');
        });
        $(document).on('click', '.editshowconform', function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            $('.editconform_password').attr('type') === 'password' ? $('.editconform_password').attr('type',
                'text') : $(
                '.editconform_password').attr('type', 'password');
        });
        $(document).on('click', '.editpasswordbtn', function() {
            $(this).toggleClass("fa-eye fa-eye-slash");

            $('.editpassword').attr('type') === 'password' ? $('.editpassword').attr('type', 'text') : $(
                '.editpassword').attr('type', 'password');
        });
        $(document).on('click', '.permissions', function() {
            var data_user_id = $(this).attr('data-user_id');

            postAjax("{{ route('user.permissions') }}", {
                'user_id': data_user_id,
                '_token': "{{ csrf_token() }}"
            }, function(res) {
                if (res.status == "Error") {
                    swal(
                        res.status,
                        res.message,
                        'error'
                    );
                } else {
                    $("#modal-permission-edit").find('.modal-body').html(res);
                    $("#modal-permission-edit").modal('show');
                }
            });
        });
        $(document).on('click', '.edituserpermission', function() {
            $('#edituserpermission').ajaxForm(function(res) {
                if (res.status == 'Success') {
                    $('#modal-permission-edit').modal('toggle');
                    swal(
                        res.status,
                        res.message,
                        'success'
                    );
                } else {
                    swal(
                        res.status,
                        res.message,
                        'error'
                    );
                }
            }).submit();
        });
    </script>
@endpush
