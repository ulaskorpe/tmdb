@php 
$count = 0;
@endphp
@foreach($series->seasons()->get() as $season )
@php 
$count++;
$collapsed = ($count ==0 )?"":"collapsed"
@endphp
<div class="card">
<div class="card-header" id="heading{{$count}}">
<h5 class="mb-0">
<button class="btn btn-link {{$collapsed}}" data-toggle="collapse" data-target="#collapse{{$count}}"
aria-expanded="false" aria-controls="collapse{{$collapsed}}">
Collapsible Group Item #{{$count}}
</button>
</h5>
</div>
<div id="collapse{{$count}}" class="collapse" aria-labelledby="heading{{$count}}" data-parent="#accordion">
<div class="card-body">
Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
</div>
</div>
</div>
@endforeach