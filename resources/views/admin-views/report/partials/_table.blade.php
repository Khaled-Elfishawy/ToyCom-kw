<link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
<style>
    .dt-button{
        display: none;
    }
    .page-link{
        color: white;
    }
</style>
<div class="row">
    <div class="col-12 pr-4 pl-4">
        <table class="table" id="datatable">
            <thead>
            <tr>
                <th>{{trans('messages.#')}} </th>
                <th>{{trans('messages.order')}}</th>
                <th>{{trans('messages.date')}}</th>
                <th>{{trans('messages.qty')}}</th>
                <th style="width: 10%">{{trans('messages.amount')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $key=>$row)
                <tr>
                    <td class="">
                        {{$key+1}}
                    </td>
                    <td class="">
                        <a href="{{route('admin.orders.details',['id'=>$row['order_id']])}}">{{$row['order_id']}}</a>
                    </td>
                    <td>{{date('d M Y',strtotime($row['date']))}}</td>
                    <td>{{$row['quantity']}}</td>
                    <td>{{$row['price'] ." ". \App\CentralLogics\Helpers::currency_symbol()}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('input').addClass('form-control');
    });

    // INITIALIZATION OF DATATABLES
    // =======================================================
    var datatable = $.HSCore.components.HSDatatables.init($('#datatable'), {
        dom: 'Bfrtip',
        "iDisplayLength": 25,
    });
</script>
