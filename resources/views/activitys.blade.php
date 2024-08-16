@extends('layout.wepper')
@section('content')
    <style>
        .tabulator-calcs-bottom [tabulator-field="cost"] {
            color: red;
            overflow: visible !important;
        }

        .top .select2-container .select2-selection--multiple,
        .select2-container--default .top.select2-container--focus .select2-selection--multiple,
        .top .select2-container--default.select2-container--focus .select2-selection--multiple {
            height: 80px !important;
        }

        div#example-table-activity {
            height: calc(100vh - 30px);
        }
    </style>
    <section class="content">
        <div class="container-fluid">
            <div class="row bottom">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div id="example-table-activity"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script src="{{ asset('js/prc.js') }}"></script>
    <script src="{{ asset('js/Blob.js') }} "></script>
    <script src="{{ asset('js/FileSaver.js') }} "></script>
    <script src="{{ asset('js/jhxlsx.js') }} "></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('js/tabulator6_0.js') }} "></script>
    <script src="{{ asset('js/xlsx.full.min.js') }} "></script>
    <script src="{{ asset('js/jspdf.umd.min.js') }} "></script>
    <script src="{{ asset('js/jspdf.plugin.autotable.min.js') }} "></script>
    <script src="{{ asset('js/custom.js?v=' . time()) }} "></script>
    <script type="text/javascript">
        var table;
        $(document).ready(function() {
            getReport();
        });
        var table = '';

        function getReport() {
            table = new Tabulator("#example-table-activity", {
                layout: "fitData",
                printAsHtml: true,
                clipboard: true,
                ajaxURL: "{{ route('user.logs') }}",
                ajaxConfig: {
                    method: "POST",
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}'
                    },
                },
                ajaxResponse: function(url, params, response) {
                    return response.data;
                },
                dataLoaderLoading: "<img style='width:60px;' src='{{ asset('img/diamond.gif') }}' />",
                renderHorizontal: "virtual",
                placeholder: "No Data",
                columns: [{
                        title: "User",
                        field: "user_id",
                        headerFilter: "input",
                        hozAlign: "center",
                    },
                    {
                        title: "Location",
                        field: "location",
                        headerFilter: "input",
                        hozAlign: "center",
                    },
                    {
                        title: "Date and Time",
                        field: "created_at",
                        headerFilter: "input",
                        hozAlign: "center",
                        formatter: function(cell, formatterParams, onRendered) {
                            var value = cell.getValue();
                            value = moment(value).format("DD-MM-YYYY - h:mm:ss A");
                            return value;
                        }
                    }
                ],
            });
        }
    </script>
@endpush
