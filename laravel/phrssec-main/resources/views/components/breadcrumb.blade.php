<ol class="breadcrumb float-sm-right">
    @foreach ($breadcrumb as $item)
        @if ($loop->last)
            <li class="breadcrumb-item active">{{ $item['text'] }}</li>
        @else
            <li class="breadcrumb-item"><a href="{{ $item['url'] }}">{{ $item['text'] }}</a></li>
        @endif
    @endforeach
</ol>
