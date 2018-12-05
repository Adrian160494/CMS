    <div class="col-md-<?php if(isset($leftContent)){echo '10';} else {echo '12';} ?> inline-form" style=" <?php if(isset($leftContent)){echo 'justify-content: left !important;
    position: relative;
    top: 14px;
    left: -60px;';} ?>">
        <?php echo Form::open(['url' => $url]) ?>
        @foreach($form as $f)
            <div class="form-group text-left col-md-12">
                @foreach($f as $k => $v)
                    @if($v['type'] == 'label')
                        <div class="col-md-3">
                            {{ Form::label($v['name'],$v['hint'],['class'=>$v['class']]) }}
                        </div>
                    @elseif($v['type'] == 'text')
                        <div class="col-md-9">
                            {{ Form::text($v['name'],$v['value'],['class'=>$v['class']]) }}
                        </div>
                    @elseif($v['type'] == 'password')
                        <div class="col-md-9">
                            {{ Form::password($v['name'],$v['value'],['class'=>$v['class']]) }}
                        </div>
                    @elseif($v['type'] == 'textarea')
                        <div class="col-md-9">
                            {{ Form::submit($v['name'],['class'=>$v['class']]) }}
                        </div>
                    @elseif($v['type'] == 'submit')
                            {{ Form::submit($v['name'],['class'=>$v['class']]) }}
                    @elseif($v['type'] == 'checkbox')
                        <div class="col-md-9">
                            {{ Form::checkbox($v['name']) }}
                        </div>
                    @elseif($v['type'] == 'hidden')
                        <div class="col-md-9">
                            {{ Form::hidden($v['name'],$v['value']) }}
                        </div>
                    @elseif($v['type'] == 'select')
                        <div class="col-md-9">
                            {{ Form::select($v['name'], $v['values'],$v['default'],['class'=>$v['class']]) }}
                        </div>
                    @endif
                @endforeach
            </div>
        @endforeach
        <?php echo Form::close() ?>
    </div>
