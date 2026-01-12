<div class="list-group list-group-light">
    <a href="{{ $link }}" class="list-group-item list-group-item-action px-3 {{ request()->url() == $link ? 'active':"" }}" aria-current="true">{{ $title }}</a>
</div>
