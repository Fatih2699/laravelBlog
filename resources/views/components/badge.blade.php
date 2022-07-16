@if(!isset($show) || $show)
<span class="badge badge-{{ $type ?? 'success' }}" style="background:green">
    {{$slot}}
</span>
@endif
