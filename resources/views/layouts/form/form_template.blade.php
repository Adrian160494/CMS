<?php echo Form::open(['url' => $url]) ?>
@foreach($form as $f)
    <div class="form-group text-center">
        @foreach($f as $k => $v)
            @if($v['type'] == 'label')
                {{ Form::label($v['name'],$v['hint'],['class'=>$v['class']]) }}
                @elseif($v['type'] == 'text')
                {{ Form::text($v['name'],$v['hint'],['class'=>$v['class']]) }}
                @elseif($v['type'] == 'password')
                {{ Form::password($v['name'],$v['hint'],['class'=>$v['class']]) }}
                @elseif($v['type'] == 'textarea')
                {{ Form::submit($v['name'],['class'=>$v['class']]) }}
                @elseif($v['type'] == 'submit')
                {{ Form::submit($v['name'],['class'=>$v['class']]) }}
                @elseif($v['checkbox'] == 'checkbox')
                {{ Form::checkbox($v['name'],$v['hint'],['class'=>$v['class']]) }}
                @endif
        @endforeach
    </div>
@endforeach
<?php echo Form::close() ?>