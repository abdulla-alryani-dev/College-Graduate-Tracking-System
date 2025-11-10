@props(['title'=>'navitem', 'url'=>'#','icon'=>'','active'=>false])

<li class="nav-item" {{$attributes->class(['active'=>$active])}} >
    <a class="nav-link" href="{{$url}}">
        <span>{{$title}}</span>
        <i class="{{$icon}}"></i>
    </a>
</li>
