@if ($errors->any())
    <ul class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        @foreach($errors->all() as $error)
            <li style="margin-left:15px">{{ $error }}</li>
        @endforeach

        {{--@if(count($errors) > 1)--}}
            {{--<strong>Please complete required fields</strong>--}}
        {{--@else--}}
            {{--<strong>Please complete required field</strong>--}}
        {{--@endif--}}

        {{--{!! Html::image('public/images/warning.png','Property of SkyLogistics',array('height'=>'15px','width'=>'auto')) !!}--}}
    </ul>

@endif


