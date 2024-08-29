<style>
    .ui-menu.ui-widget {
        z-index: 99999999999999 !important;
    }

    .border-error {
        border: solid 1px red;
    }

    td input {
        width: 100% !important;
    }

    .l1,
    .l2,
    .rate {
        min-width: 50px;
    }

    .tlotno {
        width: 350px;
    }

    th.lotsize {
        width: 90px;
    }

    td.lotcolor {
        width: 120px;
    }

    table#dv tbody tr td:nth-child(2) {
        width: 150px;
    }

    table#dv thead {
        position: sticky;
        top: 0;
        border-bottom: 1px solid gray;
    }

    .end-btn {
        padding-bottom: 10px;
        margin: auto;
        text-align: left;
    }

    #dv {
        table-layout: auto;
        width: auto;
        border-collapse: collapse;
    }

    #dv td {
        padding: 2px;
        white-space: nowrap;
    }
</style>

@php
    $activity_data = json_decode($activity->old_data);
    $new_activity_data = json_decode($activity->new_data);
@endphp
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-12 row">
                        <div class="card col-md-6 pr-2">
                            <div class="card-header m-auto">
                                <h5 class="card-title">Old Data</h5>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-head-fixed text-nowrap text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Year</th>
                                            <th>Status</th>
                                            <th>From Date</th>
                                            <th>To Date</th>
                                        </tr>
                                    </thead>
                                    <tbody style="background-color: #fff;">
                                        @if ($activity_data)
                                            <tr>
                                                <td>1</td>
                                                <td>{{ $activity_data->year ?? '' }}</td>
                                                <td>{{ $activity_data->status ?? '' }}</td>
                                                <td>{{ $activity_data->from_date ?? '' }}</td>
                                                <td>{{ $activity_data->to_date ?? '' }}</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td colspan="2">No data available</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card col-md-6 pl-2">
                            <div class="card-header m-auto">
                                <h5 class="card-title">New Data</h5>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-head-fixed text-nowrap text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Year</th>
                                            <th>Status</th>
                                            <th>From Date</th>
                                            <th>To Date</th>
                                        </tr>
                                    </thead>
                                    <tbody style="background-color: #fff;">
                                        @if ($new_activity_data)
                                            <tr>
                                                <td>1</td>
                                                <td>{{ $new_activity_data->year ?? '' }}</td>
                                                <td>{{ $new_activity_data->status ?? '' }}</td>
                                                <td>{{ $new_activity_data->from_date ?? '' }}</td>
                                                <td>{{ $new_activity_data->to_date ?? '' }}</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td colspan="2">No data available</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
