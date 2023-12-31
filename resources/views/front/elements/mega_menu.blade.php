<ul class="mega-menu">
    <div class="rounded-lg lg:fixed lg:py-10" id="mega1">
        <div class="container grid gap-4 lg:grid-cols-4">
            @foreach ($menu->children()->orderBy('display_order', 'asc')->get() as $child)
                <ul class="mega-menu-column">
                    <li>
                        <a href="{!! $child->link ? $child->link : 'javascript:;' !!}">{{ $child->name }}</a>
                        @if (iterator_count($child->children))
                            <ul>
                                @foreach ($child->children()->orderBy('display_order', 'asc')->get() as $child_2)
                                    <li>
                                        <a href="{!! $child_2->link ? $child_2->link : 'javascript:;' !!}">{{ $child_2->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                </ul>
            @endforeach
        </div>
    </div>
</ul>
