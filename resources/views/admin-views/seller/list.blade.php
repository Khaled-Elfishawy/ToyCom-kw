@extends('layouts.admin.app')

@section('title','Seller List')

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title"><i class="tio-filter-list"></i> {{trans('messages.seller')}} {{trans('messages.list')}}</h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <!-- Card -->
                <div class="card">
                    <!-- Header -->
                    @if(UserCan('add_seller','admin'))
                    <div class="card-header">
                        <h5 class="card-header-title"></h5>
                        <a href="{{route('admin.seller.add-new')}}" class="btn btn-primary pull-right"><i
                                class="tio-add-circle"></i> {{trans('messages.add')}} {{trans('messages.new')}} {{trans('messages.seller')}}</a>
                    </div>
                @endif

                <!-- End Header -->

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
                                <th class="">
                                    {{trans('messages.#')}}
                                </th>
                                <th class="table-column-pl-0">{{trans('messages.name')}}</th>
                                <th>{{trans('messages.email')}}</th>
                                <th>{{trans('messages.phone')}}</th>
                                <th>{{trans('messages.code')}} </th>
                                <th>{{trans('messages.actions')}}</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($sellers as $key=>$seller)
                                <tr class="">
                                    <td class="">
                                        {{$key+1}}
                                    </td>
                                    <td class="table-column-pl-0">
                                        {{$seller['name']}}

                                        {{--                                        <a href="{{route('admin.seller.view',[$seller['id']])}}">--}}

                                        {{--                                        </a>--}}
                                    </td>
                                    <td>
                                        {{$seller['email']}}
                                    </td>
                                    <td>
                                        {{$seller['phone']}}
                                    </td>
                                    <td>
                                        <label class="badge badge-soft-info">
                                            {{$seller->code}}
                                        </label>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                <i class="tio-settings"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                @if(UserCan('edit_seller','admin'))
                                                <a class="dropdown-item"
                                                   href="{{route('admin.seller.edit',[$seller['id']])}}">{{trans('messages.edit')}}</a>
                                                @endif
                                                    @if(UserCan('delete_seller','admin'))
                                                    <a class="dropdown-item" href="javascript:"
                                                   onclick="form_alert('seller-{{$seller['id']}}','Want to delete this seller')">{{trans('messages.delete')}}</a>
                                                    @endif
                                                <form action="{{route('admin.seller.delete',[$seller['id']])}}"
                                                      method="post" id="seller-{{$seller['id']}}">
                                                    @csrf @method('delete')
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <hr>
                        <table>
                            <tfoot>
                            {!! $sellers->links() !!}
                            </tfoot>
                        </table>
                    </div>
                    <!-- End Table -->
                </div>
                <!-- End Card -->
            </div>
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

            $('#column2_search').on('keyup', function () {
                datatable
                    .columns(2)
                    .search(this.value)
                    .draw();
            });

            $('#column3_search').on('change', function () {
                datatable
                    .columns(3)
                    .search(this.value)
                    .draw();
            });

            $('#column4_search').on('keyup', function () {
                datatable
                    .columns(4)
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
