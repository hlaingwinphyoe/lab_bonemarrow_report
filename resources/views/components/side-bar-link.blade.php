<a href="{{ $link }}" class="menu-item-link {{ $link == request()->url() ? 'currentPage':'' }}">
    <span>
        {{ $name }}
    </span>
</a>
