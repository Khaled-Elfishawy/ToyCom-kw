@extends('layouts.admin.app')

@section('title','brand list')

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->


            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">

                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title"><i class="tio-filter-list"></i> Brand list</h1>
                </div>

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
                                <th style="width: 50%">name ar</th>
                                <th style="width: 50%">name en</th>
                                <th style="width: 50%">image</th>
                                <th style="width: 10%">{{trans('messages.action')}}</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th>
                                    <input type="text" id="column1_search" class="form-control form-control-sm"
                                           placeholder="Search branch">
                                </th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                            @foreach($brands as $brand)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>
                                    <span class="d-block font-size-sm text-body">
                                        {{$brand->name_ar}}

                                    </span>
                                    </td>
                                    <td>{{$brand->name_en}}</td>
                                    <td><img src="{{url('/')}}/public/brand/img/{{$brand->image }}" alt="iamge"  width="70px" height="70px" style="border-radius: 50%"></td>
                                    <td>
                                        <!-- Dropdown -->
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown"
                                                    aria-haspopup="true"
                                                    aria-expanded="false">
                                                <i class="tio-settings"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                @if(UserCan('edit_branch','admin'))
                                                <a class="dropdown-item"
                                                   href="{{route('admin.brand.edit', $brand->id)}}">{{trans('messages.edit')}}</a>
                                                @if(1)
                                                    @endif
                                                        @if(UserCan('delete_branch','admin'))
                                                        <a class="dropdown-item" href="javascript:"
                                                       onclick="form_alert('brand-{{$brand['id']}}','Want to delete this branch ?')">{{trans('messages.delete')}}</a>
                                                    @endif
                                                        <form action="{{route('admin.brand.delete', $brand->id)}}"
                                                          method="post" id="brand-{{$brand['id']}}">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- End Dropdown -->
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <hr>
                        <table>
                            <tfoot>
                            {{-- {!! $branches->links() !!} --}}
                            </tfoot>
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
                    .columns(2)
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
