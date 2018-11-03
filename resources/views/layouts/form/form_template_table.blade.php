<div class="container-form ">
   <div class="col-md-12 table-form">
       <?php echo Form::open(['url' => $url]) ?>
       @foreach($form as $f)
           <?php //dump($form);die; ?>
           <div class="form-group text-center col-md-12">
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
                   @elseif($v['type'] == 'submit')
                       <div class="col-md-12">
                           {{ Form::submit($v['name'],['class'=>$v['class']]) }}
                       </div>
                   @elseif($v['type'] == 'textarea')
                       <div class="col-md-9">
                           {!! Form::textarea($v['name'],null, array('class'=>$v['class'],'rows' => $v['rows'], 'cols' => $v['cols'])) !!}
                       </div>
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
                           {{ Form::select($v['name'], $v['values'],$v['default']) }}
                       </div>
                   @endif

               @endforeach
           </div>
       @endforeach

           <div class="errors">
               @foreach($errors->all() as $error)
                   <span>{{$error}}</span>
               @endforeach
           </div>
       <?php echo Form::close() ?>
   </div>

</div>
