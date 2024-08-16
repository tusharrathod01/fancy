@extends('layout.wepper')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">TYPE MASTER</h3>
                        </div>
                        <div class="card-body table-responsive p-0 typetbl">
                            <form class="master_form" method="POST" action="{{ route('save.masters') }}">
                                {{ csrf_field() }}
                                <table id="dv" class="table table-head-fixed text-nowrap text-nowrap">
                                    <thead>
                                        <tr>
                                            <th style="width: 50px;">No.</th>
                                            <th>PRIORITY</th>
                                            <th>NAME</th>
                                        </tr>
                                    </thead>
                                    <tbody id="add_lot" style="background-color: #fff;">
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bottom fix" style="width: 100%; height: 40px;">
        <div class="container-fluid">
            <div class="col-md-12 row">
                <div class="card mb-2 mt-2 mr-0 ml-0" style="width: 100%;  height: 40px;">
                    <div class="card-body">
                        <div class="text-center">
                            @if (auth()->user()->add == '1')
                                <button type="button" class="btn" id="saveMaster">SAVE</button>
                            @endif
                            <button type="reset" name="reset" class="btn">RESET</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script src="{{ asset('js/prc.js') }}"></script>
    <script src="{{ asset('js/custom.js') }} "></script>

    <script type="text/javascript">
        $(document).ready(function() {
            get_type();
        });
        $(document).on('focusout', '.add-row', function() {
            var Length = $(this).closest('tr').next('tr').length;
            var row = $(this).closest('tbody').find('tr').length;
            var check = $(this).closest('tr').find('.add-row').val();
            if (Length == 0 && check !== '') {
                var markup = `<tr>
                        <td>
                           ${row+1}
                        </td>
                        <td style="width: 100px">
                            <input type="text" name="masters[${row}][priority]"  value="${row+1}">
                           <input type="hidden" name="masters[${row}][type]"  value="type_master">

                        </td>
                        <td>
                           <input class="name add-row" type="text" name="masters[${row}][name]">
                        </td>
                     </tr>`;
                $("table #add_lot").append(markup);
            }
        });
        $(document).on('keyup', 'input', function(e) {
            $(this).val($(this).val().toUpperCase());
        });
        $('[name="reset"]').click(function() {
            get_type();
        });

        $(document).on('click', '#saveMaster', function() {
            $('.master_form').ajaxForm(function(res) {
                if (res.status == 'Success') {
                    swal(
                        res.status,
                        res.message,
                        'success'
                    );
                    get_type();
                } else {
                    swal(
                        res.status,
                        res.message,
                        'error'
                    );
                }
            }).submit();
        });

        function get_type() {
            postAjax("{{ route('get.masters', 'type_master') }}", {
                '_token': "{{ csrf_token() }}"
            }, function(res) {
                if (res.status == 'Success') {
                    setData(res.data);
                } else {
                    swal(
                        res.status,
                        res.message,
                        'error'
                    );
                }
            });
        }

        function setData(data) {
            var html = '';
            $.each(data, function(i, color) {
                html += `<tr>
                        <td >
                           ${i+1}
                        </td>
                        <td style="width: 100px">
                            <input type="text" name="masters[${i}][priority]"  value="${color.priority}">
                        </td>
                        <td>
                           <input class="name add-row" type="text" name="masters[${i}][name]"  value="${isNull(color.name)}">
                           <input type="hidden" name="masters[${i}][id]"  value="${color.id}">
                           <input type="hidden" name="masters[${i}][type]"  value="type_master">

                        </td>
                     </tr>`;
            });

            $("table #add_lot").html(html);
            $('.add-row').trigger('focusout');
        }

        function isNull(value) {
            if (value == null) {
                return '';
            } else {
                return value;
            }
        }
    </script>
@endpush
