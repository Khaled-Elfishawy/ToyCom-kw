@extends('layouts.admin.app')

@section('title','Add new Time Slot')

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        @if(UserCan('add_setTime','admin'))
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title">{{trans('messages.Time Slot')}}</h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <form action="{{route('admin.timeSlot.store')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1"> {{trans('messages.Time')}} {{trans('messages.Start')}} </label>
                                <input type="time" name="start_time" class="form-control" value="10:30:00"
                                       placeholder="Ex : 10:30 am" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1"> {{trans('messages.Time')}} {{trans('messages.Ends')}} </label>
                                <input type="time" name="end_time" class="form-control" value="19:30:00" placeholder="5:45 pm"
                                       required>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">{{trans('messages.submit')}}</button>
                </form>
            </div>
            @endif

            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <hr>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-header-title"></h5>
                    </div>
                    <!-- Table -->
                    <div class="table-responsive datatable-custom">
                        <table id="columnSearchDatatable"
                               class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                               data-hs-datatables-options='{
                                 "order": [],
                                 "orderCellsTop": true
                               }'>
                            <thead class="thead-light">
                            <tr>
                                <th>{{trans('messages.#')}}</th>

                                <th class="text-center">{{trans('messages.Start')}} {{trans('messages.Time')}} </th>
                                <th class="text-center">{{trans('messages.End')}} {{trans('messages.Time')}}  </th>
                                <th>{{trans('messages.status')}}</th>
                                <th>{{trans('messages.action')}}</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th>
                                    <input type="text" id="column1_search" class="form-control form-control-sm"
                                           placeholder="Search">
                                </th>
                                <th></th>


                                <th>
                                    {{--<select id="column3_search" class="js-select2-custom"
                                            data-hs-select2-options='{
                                              "minimumResultsForSearch": "Infinity",
                                              "customClass": "custom-select custom-select-sm text-capitalize"
                                            }'>
                                        <option value="">Any</option>
                                        <option value="Active">Active</option>
                                        <option value="Disabled">Disabled</option>
                                    </select>--}}
                                </th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($timeSlots as $key=>$timeSlot)
                                <tr>
                                    <td>{{$key+1}}</td>


                                    <td class="text-center" ><input style="background: white !important; border: none !important; " type="time" value="{{$timeSlot['start_time']}}" disabled> </td>
                                    <td class="text-center" ><input  style="background: white !important; border: none !important; "type="time" value="{{$timeSlot['end_time']}}" disabled></td>
                                    <td>
                                        @if(UserCan('edit_setTime','admin'))
                                        @if($timeSlot['status']==1)
                                            <div style="padding: 10px;border: 1px solid;cursor: pointer"
                                                 onclick="location.href='{{route('admin.timeSlot.status',[$timeSlot['id'],0])}}'">
                                                <span class="legend-indicator bg-success"></span>{{trans('messages.active')}}
                                            </div>
                                        @else
                                            <div style="padding: 10px;border: 1px solid;cursor: pointer"
                                                 onclick="location.href='{{route('admin.timeSlot.status',[$timeSlot['id'],1])}}'">
                                                <span class="legend-indicator bg-danger"></span>{{trans('messages.disabled')}}
                                            </div>
                                        @endif
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Dropdown -->
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                <i class="tio-settings"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                @if(UserCan('edit_setTime','admin'))
                                                <a class="dropdown-item"
                                                   href="{{route('admin.timeSlot.update',[$timeSlot['id']])}}">{{trans('messages.edit')}}</a>
                                                @endif
                                                    @if(UserCan('delete_setTime','admin'))
                                                    <a class="dropdown-item" href="javascript:"
                                                onclick="form_alert('timeSlot-{{$timeSlot['id']}}','Want to delete this Time Slot')">{{trans('messages.delete')}}  </a>
                                                    @endif
                                                <form action="{{route('admin.timeSlot.delete',[$timeSlot['id']])}}"
                                                      method="post" id="timeSlot-{{$timeSlot['id']}}">
                                                    @csrf @method('delete')
                                                </form>
                                            </div>
                                        </div>
                                        <!-- End Dropdown -->
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End Table -->
        </div>
    </div>

@endsection

@push('script_2')
    <script>
        $(document).on('ready', function () {
            // INITIALIZATION OF DATATABLES
            // =======================================================
            var datatable = $.HSCore.components.HSDatatables.init($('#columnSearchDatatable'));

            $('#column1_search').on('keyup', function () {
                datatable
                    .columns(1)
                    .search(this.value)
                    .draw();
            });


            $('#column3_search').on('change', function () {
                datatable
                    .columns(9)
                    .search(this.value)
                    .draw();
            });

            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function () {
                var select2 = $.HSCore.components.HSSelect2.init($(this));
            });
        });
    </script>
@endpush
