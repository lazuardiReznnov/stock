@if($link)
<li class="breadcrumb-item">
    <a href="{{ $link }}">{{ $name }}</a>
</li>

@else
<li class="breadcrumb-item active">{{ $name }}</li>
@endif
