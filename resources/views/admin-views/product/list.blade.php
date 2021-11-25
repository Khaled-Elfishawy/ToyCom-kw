@extends('layouts.admin.app')

@section('title','Product List')

@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title"><i
                            class="tio-filter-list"></i>  {{trans('messages.list')}} {{trans('messages.products')}}</h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <!-- Card -->
                <div class="card">
                    <!-- Header -->
                    <div class="card-header">
                        <h5 class="card-header-title"></h5>
                        @if(UserCan('add_product','admin'))
                        <a href="{{route('admin.product.add-new')}}" class="btn btn-primary pull-right"><i
                                class="tio-add-circle"></i> {{trans('messages.add')}} {{trans('messages.product')}} {{trans('messages.new')}}
                        </a>
                        @endif
                    </div>
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
                                <th>{{trans('messages.#')}}</th>
                                <th style="width: 30%">{{trans('messages.name')}}</th>
                                <th style="width: 25%">{{trans('messages.image')}}</th>
                                <th>{{trans('messages.status')}}</th>
                                <th>{{trans('messages.price')}}</th>
                                <th>{{trans('messages.stock')}}</th>
                                <th>{{trans('messages.action')}}</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th>
                                    <form action="javascript:" id="search-form">
                                        <!-- Search -->
                                        <div class="input-group input-group-merge input-group-flush">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="tio-search"></i>
                                                </div>
                                            </div>
                                            <input id="datatableSearch_" type="search" name="search"
                                                   class="form-control"
                                                   placeholder="Search" aria-label="Search">
                                            <button type="submit"
                                                    class="btn btn-primary">{{trans('messages.search')}}</button>

                                        </div>
                                        <!-- End Search -->
                                    </form>
                                </th>
                                <th>
                                    {{--<input type="text" id="column2_search" class="form-control form-control-sm"
                                           placeholder="Search positions">--}}
                                </th>
                                <th>
                                    <select id="column3_search" class="js-select2-custom"
                                            data-hs-select2-options='{
                                              "minimumResultsForSearch": "Infinity",
                                              "customClass": "custom-select custom-select-sm text-capitalize"
                                            }'>
                                        <option value="">{{trans('messages.any')}}</option>
                                        <option value="Active">{{trans('messages.active')}}</option>
                                        <option value="Disabled">{{trans('messages.disabled')}}</option>
                                    </select>
                                </th>
                                <th></th>
                                <th>
                                    {{--<input type="text" id="column4_search" class="form-control form-control-sm"
                                           placeholder="Search countries">--}}
                                </th>
                            </tr>
                            </thead>

                            <tbody id="set-rows">
                            @foreach($products as $key=>$product)
                                <tr @if($product['total_stock'] <= 0) style="background: #ffe8e8;border: 3px solid red;" @endif>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        @if(UserCan('view_product','admin'))
                                        <span class="d-block font-size-sm text-body">
                                             <a href="{{route('admin.product.view',[$product['id']])}}">
{{--                                               {{substr($product['name'],0,20)}}{{strlen($product['name'])>30?'...':''}}--}}
                                              @if(app()->getLocale() == 'ar') {{$product['name_ar']}} @else {{$product['name']}} @endif
                                             </a>
                                        </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if(count(json_decode($product['image'],true)) > 0)
                                        <div style="height: 100px; width: 100px; overflow-x: hidden;overflow-y: hidden">
                                            <img
                                                src="{{asset('storage/app/public/product')}}/{{json_decode($product['image'],true)[0]}}"
                                                style="width: 100px" onerror="this.src='{{asset('public/assets/admin/img/160x160/img2.jpg')}}'"
                                                >
                                        </div>
                                            @else
                                            <div style="height: 100px; width: 100px; overflow-x: hidden;overflow-y: hidden">
                                                <img
                                                    src="{{asset('public/assets/admin/img/160x160/img2.jpg')}}"
                                                    style="width: 100px" onerror="this.src='{{asset('public/assets/admin/img/160x160/img2.jpg')}}'"
                                                >
                                            </div>
                                            @endif
                                    </td>
                                    <td>
                                        @if(UserCan('edit_product','admin'))
                                        @if($product['status']==1)
                                            <div style="padding: 10px;border: 1px solid;cursor: pointer"
                                                 onclick="location.href='{{route('admin.product.status',[$product['id'],0])}}'">
                                                <span
                                                    class="legend-indicator bg-success"></span>{{trans('messages.active')}}
                                            </div>
                                        @else
                                            <div style="padding: 10px;border: 1px solid;cursor: pointer"
                                                 onclick="location.href='{{route('admin.product.status',[$product['id'],1])}}'">
                                                <span
                                                    class="legend-indicator bg-danger"></span>{{trans('messages.disabled')}}
                                            </div>
                                        @endif
                                        @endif
                                    </td>
                                    <td>{{$product['price']." ".\App\CentralLogics\Helpers::currency_symbol()}}</td>
                                    <td>
                                        <label class="badge badge-soft-info">{{$product['total_stock']}}</label>
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
                                                @if(UserCan('edit_product','admin'))
                                                <a class="dropdown-item"
                                                   href="{{route('admin.product.edit',[$product['id']])}}">{{trans('messages.edit')}}</a>
                                                @endif
                                                    @if(UserCan('delete_product','admin'))
                                                    <a class="dropdown-item" href="javascript:"
                                                   onclick="form_alert('product-{{$product['id']}}','Want to delete this item ?')">{{trans('messages.delete')}}</a>
                                                    @endif
                                                <form action="{{route('admin.product.delete',[$product['id']])}}"
                                                      method="post" id="product-{{$product['id']}}">
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
                        <hr>
                        <div class="page-area">
                            <table>
                                <tfoot class="border-top">
                                {!! $products->links() !!}
                                </tfoot>
                            </table>
                        </div>
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

    <script>
        $('#search-form').on('submit', function () {
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '{{route('admin.product.search')}}',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    $('#set-rows').html(data.view);
                    $('.page-area').hide();
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        });
    </script>
@endpush
