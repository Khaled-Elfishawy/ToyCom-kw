@extends('layouts.admin.app')

@section('title','Add new product')

@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('public/assets/admin/css/tags-input.min.css')}}" rel="stylesheet">
@endpush

@section('content')
    @if(UserCan('add_product','admin'))
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm mb-2 mb-sm-0">
                        <h1 class="page-header-title"><i
                                class="tio-add-circle-outlined"></i> {{trans('messages.add')}} {{trans('messages.new')}} {{trans('messages.product')}}
                        </h1>
                    </div>
                </div>
            </div>
            <!-- End Page Header -->
            <div class="row gx-2 gx-lg-3">
                <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                    <form action="javascript:" method="post" id="product_form"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="input-label" for="exampleFormControlInput1">{{trans('messages.name_en')}}</label>
                                    <input type="text" name="name" class="form-control" placeholder="New Product In English" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="input-label" for="exampleFormControlInput1">{{trans('messages.name_ar')}}</label>
                                    <input type="text" name="name_ar" class="form-control" placeholder="New Product In Arabic" >
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="input-label"
                                           for="exampleFormControlInput1">{{trans('messages.capacity')}}</label>
                                    <input type="number" min="0" max="100" step="0.001" value="1" name="capacity"
                                           class="form-control"
                                           placeholder="Ex : 5" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="input-label"
                                           for="exampleFormControlInput1">{{trans('messages.unit')}}</label>
                                    <select name="unit" class="form-control js-select2-custom">
                                        <option value="kg">{{trans('messages.kg')}}</option>
                                        <option value="gm">{{trans('messages.gm')}}</option>
                                        <option value="ltr">{{trans('messages.ltr')}}</option>
                                        <option value="pc">{{trans('messages.pc')}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="input-label"
                                           for="exampleFormControlInput1">{{trans('messages.price_seller')}}</label>
                                    <input type="number" min="0.001" max="100000" step="0.001" name="price"
                                           class="form-control"
                                           placeholder="Ex : 100.000" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="input-label"
                                           for="exampleFormControlInput1">{{trans('messages.gomla_price')}}</label>
                                    <input type="number" min="0.001" max="100000" step="0.001"  name="gomla_price"
                                           class="form-control"
                                           placeholder="Ex : 100.000" required>
                                </div>
                            </div>

                            {{--
                            @foreach($prices as $price)
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="input-label"
                                               for="exampleFormControlInput1">{{trans('messages.price-groups')}} : {{$price->name}}</label>
                                        <input type="number" min="1" max="100000" step="0.01" value="1" name="pricegroup[{{$price->id}}]"
                                               class="form-control"
                                               placeholder="Ex : 100" required>
                                    </div>
                                </div>

                            @endforeach
                            --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="input-label"
                                           for="exampleFormControlInput1">{{trans('messages.stock')}}</label>
                                    <input type="number" min="0" max="100000000" value="0" name="total_stock" class="form-control"
                                           placeholder="Ex : 100">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="input-label"
                                           for="exampleFormControlInput1">{{trans('messages.age')}}</label>
                                    <select name="ages[]" required multiple="multiple" class="form-control js-select2-custom">
                                        @foreach($ages as $age)
                                        <option value="{{$age->id}}">@if(app()->getLocale() == 'ar')
                                                {{$age->name_ar}}
                                        @else
                                                {{$age->name_en}}
                                        @endif
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="input-label"
                                           for="exampleFormControlInput1">{{trans('messages.brands')}}</label>
                                    <select name="brand_id" required class="form-control js-select2-custom">
                                        @foreach($brands as $brand)
                                            <option value="{{$brand->id}}">@if(app()->getLocale() == 'ar')
                                                    {{$brand->name_ar}}
                                                @else
                                                    {{$brand->name_en}}
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="input-label"
                                           for="exampleFormControlInput1">{{trans('messages.gender')}}</label>
                                    <select name="gender" required class="form-control js-select2-custom">
                                            <option value="all" selected>{{trans('messages.genderAll')}}</option>
                                            <option value="male">{{trans('messages.male')}}</option>
                                            <option value="female">{{trans('messages.female')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="input-label"
                                           for="">{{trans('messages.by_date')}}</label>
                                    <input type="date" required name="by_date" class="form-control" id="">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label class="input-label"
                                           for="">{{trans('messages.barcode')}}</label>
                                    <input type="text" name="barcode" class="form-control" id="">
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="input-label"
                                           for="exampleFormControlInput1">{{trans('messages.tax')}}</label>
                                    <input type="number" min="0" value="0" step="0.001" max="100000" name="tax"
                                           class="form-control"
                                           placeholder="Ex : 7.000" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="input-label"
                                           for="exampleFormControlInput1">{{trans('messages.tax')}} {{trans('messages.type')}}</label>
                                    <select name="tax_type" class="form-control js-select2-custom">
                                        <option value="percent">{{trans('messages.percent')}}</option>
                                        <option value="amount">{{trans('messages.amount')}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

{{--                        <div class="row">--}}
{{--                            <div class="col-md-6 col-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="input-label"--}}
{{--                                           for="exampleFormControlInput1">{{trans('messages.discount')}}</label>--}}
{{--                                    <input type="number" min="0.001" max="100000" step="0.001" value="0" name="discount" class="form-control"--}}
{{--                                           placeholder="Ex : 100.000">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-6 col-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="input-label"--}}
{{--                                           for="exampleFormControlInput1">{{trans('messages.discount')}} {{trans('messages.type')}}</label>--}}
{{--                                    <select name="discount_type" class="form-control js-select2-custom">--}}
{{--                                        <option value="percent">{{trans('messages.percent')}}</option>--}}
{{--                                        <option value="amount">{{trans('messages.amount')}}</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="row">
                            <div class="col-md-6 col-6">
                                <div class="form-group">
                                    <label class="input-label"
                                           for="exampleFormControlSelect1">{{trans('messages.category')}}<span
                                            class="input-label-secondary">*</span></label>
                                    <select name="category_id" class="form-control js-select2-custom"
                                            onchange="getRequest('{{url('/')}}/admin/product/get-categories?parent_id='+this.value,'sub-categories')">
                                        <option value="">---{{trans('messages.select')}}---</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category['id']}}">{{$category['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{--
                            <div class="col-md-6 col-6">
                                <div class="form-group">
                                    <label class="input-label"
                                           for="exampleFormControlSelect1">{{trans('messages.sub_category')}}<span
                                            class="input-label-secondary"></span></label>
                                    <select name="sub_category_id" id="sub-categories"
                                            class="form-control js-select2-custom"
                                            onchange="getRequest('{{url('/')}}/admin/product/get-categories?parent_id='+this.value,'sub-sub-categories')">

                                    </select>
                                </div>
                            </div>
                            -- }}
                            {{--<div class="col-md-4 col-6">
                                <div class="form-group">
                                    <label class="input-label" for="exampleFormControlSelect1">Sub Sub Category<span
                                            class="input-label-secondary"></span></label>
                                    <select name="sub_sub_category_id" id="sub-sub-categories"
                                            class="form-control js-select2-custom">

                                    </select>
                                </div>
                            </div>--}}
                        </div>

                        <div class="row"
                             style="border: 1px solid #80808045; border-radius: 10px;padding-top: 10px;margin: 1px">
{{--                            <div class="col-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="input-label"--}}
{{--                                           for="exampleFormControlSelect1">{{trans('messages.attribute')}}<span--}}
{{--                                            class="input-label-secondary"></span></label>--}}
{{--                                    <select name="attribute_id[]" id="choice_attributes"--}}
{{--                                            class="form-control js-select2-custom"--}}
{{--                                            multiple="multiple">--}}
{{--                                        @foreach(\App\Model\Attribute::orderBy('name')->get() as $attribute)--}}
{{--                                            <option value="{{$attribute['id']}}">{{$attribute['name']}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <div class="col-md-12 mt-2 mb-2">
                                <div class="customer_choice_options" id="customer_choice_options">

                                </div>
                            </div>
                            <div class="col-md-12 mt-2 mb-2">
                                <div class="variant_combination" id="variant_combination">

                                </div>
                            </div>
                        </div>

                        <div class="form-group pt-4">
                            <label class="input-label"
                                   for="exampleFormControlInput1">{{trans('messages.short')}} {{trans('messages.description_en')}}</label>
                            <div id="editor_ar" style="min-height: 15rem;"></div>
                            <textarea name="description" style="display:none" id="hiddenArea_ar"></textarea>
                        </div>

                        <div class="form-group pt-4">
                            <label class="input-label"
                                   for="exampleFormControlInput1">{{trans('messages.short')}} {{trans('messages.description_ar')}}</label>
                            <div id="editor" style="min-height: 15rem;"></div>
                            <textarea name="description_ar" style="display:none" id="hiddenArea"></textarea>
                        </div>

                        <div class="form-group">
                            <label>{{trans('messages.product')}} {{trans('messages.image')}}</label><small
                                style="color: red">* ( {{trans('messages.ratio')}} 1:1 )</small>
                            <div>
                                <div class="row" id="coba"></div>
                            </div>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary">{{trans('messages.submit')}}</button>
                    </form>
                </div>
            </div>
        </div>
    @endif

@endsection

@push('script')

@endpush

@push('script_2')
    <script src="{{asset('public/assets/admin/js/spartan-multi-image-picker.js')}}"></script>

    <script type="text/javascript">
        $(function () {
            $("#coba").spartanMultiImagePicker({
                fieldName: 'images[]',
                maxCount: 4,
                rowHeight: '215px',
                groupClassName: 'col-3',
                maxFileSize: '',
                placeholderImage: {
                    image: '{{asset('public/assets/admin/img/400x400/img2.jpg')}}',
                    width: '100%'
                },
                dropFileLabel: "Drop Here",
                onAddRow: function (index, file) {

                },
                onRenderedPreview: function (index) {

                },
                onRemoveRow: function (index) {

                },
                onExtensionErr: function (index, file) {
                    toastr.error('Please only input png or jpg type file', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                },
                onSizeErr: function (index, file) {
                    toastr.error('File size too big', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            });
        });
    </script>

    <script>
        function getRequest(route, id) {
            $.get({
                url: route,
                dataType: 'json',
                success: function (data) {
                    $('#' + id).empty().append(data.options);
                },
            });
        }
    </script>

    <script>
        $(document).on('ready', function () {
            $('.js-select2-custom').each(function () {
                var select2 = $.HSCore.components.HSSelect2.init($(this));
            });
        });
    </script>

    <script src="{{asset('public/assets/admin')}}/js/tags-input.min.js"></script>

    <script>
        $('#choice_attributes').on('change', function () {
            $('#customer_choice_options').html(null);
            $.each($("#choice_attributes option:selected"), function () {
                add_more_customer_choice_option($(this).val(), $(this).text());
            });
        });

        function add_more_customer_choice_option(i, name) {
            let n = name.split(' ').join('');
            $('#customer_choice_options').append('<div class="row"><div class="col-md-3"><input type="hidden" name="choice_no[]" value="' + i + '"><input type="text" class="form-control" name="choice[]" value="' + n + '" placeholder="Choice Title" readonly></div><div class="col-lg-9"><input type="text" class="form-control" name="choice_options_' + i + '[]" placeholder="Enter choice values" data-role="tagsinput" onchange="combination_update()"></div></div>');
            $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
        }

        function combination_update() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: '{{route('admin.product.variant-combination')}}',
                data: $('#product_form').serialize(),
                success: function (data) {
                    $('#variant_combination').html(data.view);
                    if (data.length > 1) {
                        $('#quantity').hide();
                    } else {
                        $('#quantity').show();
                    }
                }
            });
        }
    </script>

    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <script>
        var container = $('#editor').get(0);
        var quill = new Quill(container, {
            theme: 'snow'
        });
        var container = $('#editor_ar').get(0);
        var quill = new Quill(container, {
            theme: 'snow'
        });

        $('#product_form').on('submit', function () {

            var myEditor = document.querySelector('#editor')
            $("#hiddenArea").val(myEditor.children[0].innerHTML);
            var myEditor_ar = document.querySelector('#editor_ar')
            $("#hiddenArea_ar").val(myEditor.children[0].innerHTML);

            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '{{route('admin.product.store')}}',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.errors) {
                        for (var i = 0; i < data.errors.length; i++) {
                            toastr.error(data.errors[i].message, {
                                CloseButton: true,
                                ProgressBar: true
                            });
                        }
                    } else {
                        toastr.success('product uploaded successfully!', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                        setTimeout(function () {
                            location.href = '{{route('admin.product.list')}}';
                        }, 2000);
                    }
                }
            });
        });
    </script>
@endpush


