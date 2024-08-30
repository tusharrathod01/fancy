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

    th {
        padding: 0 8px !important;
    }

    td {
        padding: 0 4px !important;
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
                    @if ($activity_data)
                        <div class="card col-md-12 mb-4">
                            <div class="card-header m-auto">
                                <h5 class="card-title">Old Data</h5>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-head-fixed text-nowrap text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Priority</th>
                                            <th>Type</th>
                                            <th>Name</th>
                                            <th>Color</th>
                                            <th>Intensity</th>
                                            <th>Overtone</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>St name</th>
                                            <th>Rate</th>
                                        </tr>
                                    </thead>
                                    <tbody style="background-color: #fff;">
                                        @if ($activity_data)
                                            <tr>
                                                <td>1</td>
                                                <td>{{ $activity_data->priority ?? '' }}</td>
                                                <td>{{ $activity_data->type ?? '' }}</td>
                                                <td>{{ $activity_data->name ?? '' }}</td>
                                                <td>{{ $activity_data->color ?? '' }}</td>
                                                <td>{{ $activity_data->intensity ?? '' }}</td>
                                                <td>{{ $activity_data->overtone ?? '' }}</td>
                                                <td>{{ $activity_data->p_from ?? '' }}</td>
                                                <td>{{ $activity_data->p_to ?? '' }}</td>
                                                <td>{{ $activity_data->st_name ?? '' }}</td>
                                                <td>{{ $activity_data->rate ?? '' }}</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                    @if ($new_activity_data)
                        <div class="card col-md-12">
                            <div class="card-header m-auto">
                                <h5 class="card-title">New Data</h5>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-head-fixed text-nowrap text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Priority</th>
                                            <th>Type</th>
                                            <th>Name</th>
                                            <th>Color</th>
                                            <th>Intensity</th>
                                            <th>Overtone</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>St name</th>
                                            <th>Rate</th>
                                        </tr>
                                    </thead>
                                    <tbody style="background-color: #fff;">
                                        @if ($new_activity_data)
                                            <tr>
                                                <td>1</td>
                                                <td>{{ $new_activity_data->priority ?? '' }}</td>
                                                <td>{{ $new_activity_data->type ?? '' }}</td>
                                                <td>{{ $new_activity_data->name ?? '' }}</td>
                                                <td>{{ $new_activity_data->color ?? '' }}</td>
                                                <td>{{ $new_activity_data->intensity ?? '' }}</td>
                                                <td>{{ $new_activity_data->overtone ?? '' }}</td>
                                                <td>{{ $new_activity_data->p_from ?? '' }}</td>
                                                <td>{{ $new_activity_data->p_to ?? '' }}</td>
                                                <td>{{ $new_activity_data->st_name ?? '' }}</td>
                                                <td>{{ $new_activity_data->rate ?? '' }}</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
