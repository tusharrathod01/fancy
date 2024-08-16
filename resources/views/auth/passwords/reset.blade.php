@extends('layout.wepper')

@section('content')
    <style>
        .login-box,
        .register-box {
            width: 360px;
            margin: auto;
            vertical-align: middle;
        }

        .input-group.mb-3 {
            display: inline-flex;
            width: 100%;
        }

        .showconform {
            cursor: pointer;
        }

        .passwordbtn {
            cursor: pointer;
        }
    </style>
    <section class="content hold-transition login-page">
        <div class="container-fluid">
            <input type="hidden" value="0" id="is_capital">
            <div class="row">
                <div class="col-md-12">
                    <div class="login-box">
                        <div class="card">
                            <div class="card-body login-card-body">
                                <p class="login-box-msg">Change password</p>
                                <form class="add_entry" method="POST" action="{{ route('resetpass.save') }}">
                                    {{ csrf_field() }}
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control password" placeholder="Password"
                                            name="password">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fa fa-eye-slash passwordbtn" aria-hidden="true"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control conform_password"
                                            placeholder="Confirm Password" name="conform_password">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fa fa-eye-slash showconform" aria-hidden="true"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-5">
                                            <button type="button" id="save" class="btn btn-primary btn-block">Change
                                                password</button>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                </form>
                            </div>
                            <!-- /.login-card-body -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script src="{{ asset('js/prc.js') }}"></script>
    <script src="{{ asset('js/custom.js?v=' . time()) }} "></script>
    <script>
        $(document).on('click', '#save', function() {
            $('.add_entry').ajaxForm(function(res) {
                if (res.status == 'Success') {
                    swal(
                        res.status,
                        res.message,
                        'success'
                    );
                    $('.conform_password').val('');
                    $('.password').val('');
                } else {
                    swal(
                        res.status,
                        res.message,
                        'error'
                    );
                }
            }).submit();

        });
        $(document).on('click', '.showconform', function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            $('.conform_password').attr('type') === 'password' ? $('.conform_password').attr('type', 'text') : $(
                '.conform_password').attr('type', 'password');
        });
        $(document).on('click', '.passwordbtn', function() {
            $(this).toggleClass("fa-eye fa-eye-slash");

            $('.password').attr('type') === 'password' ? $('.password').attr('type', 'text') : $('.password').attr(
                'type', 'password');
        });
    </script>
@endpush
