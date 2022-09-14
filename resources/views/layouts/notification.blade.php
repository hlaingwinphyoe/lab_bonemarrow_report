<div class="dropdown dropdown-menu-lg-start">

    <div class="bell" data-mdb-toggle="dropdown" aria-expanded="false">
        <div class="bell-border"></div>
        <i class="fas fa-bell btn-bell"></i>
    </div>
    @if(auth()->user()->unreadNotifications->count() > 0 )
        <span class="badge-notification">
                    @if(auth()->user()->unreadNotifications->count() > 99)
                999+
            @else
                {{ auth()->user()->unreadNotifications->count() }}
            @endif
                </span>
    @endif
    <ul class="dropdown-menu dropdown-box-container" >
        <li class="text-center p-3 text-dark" style="background-color: #f3f3f3;border-bottom: 1px solid #9e9e9e">
            <p class="mb-0" style="font-size: 14px">
                You Have
                @if(auth()->user()->unreadNotifications->count() > 0 )
                    <span class="noti me-1">
                        @if(auth()->user()->unreadNotifications->count() > 99)
                            99+
                        @else
                            {{ auth()->user()->unreadNotifications->count() }}
                        @endif
                    </span>
                @else
                    No
                @endif
                New Notifications
            </p>
        </li>
        <ul class="dropdown-box m-0 p-0">
            @forelse(auth()->user()->unreadNotifications as  $key=>$notification)
                @if($key == 20)
                    @break
                @endif
                {{--  aspirate notification start --}}
                @if(isset($notification->data['aspirate_id']))
                    <li class="list-unstyled noti-list">
                        <a class="dropdown-item" href="{{ route('aspirate.index') }}">
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-bookmark fa-lg text-primary"></i>
                                <div class="ms-3">
                                    <span class="mb-1 text-black text-wrap">{{ $notification->data['name'] }} {{ $notification->data['description'] }}</span>
                                    <br>
                                    <span class="text-muted mb-0 small">{{ $notification->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    {{--  aspirate notification end --}}
                    {{--  trephine notification start --}}
                @elseif(isset($notification->data['trephine_id']))
                    <li class="list-unstyled noti-list">
                        <a class="dropdown-item" href="{{ route('aspirate.index') }}">
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-bookmark fa-lg text-primary"></i>
                                <div class="ms-3">
                                    <span class="mb-1 text-black text-wrap">{{ $notification->data['name'] }} {{ $notification->data['description'] }}</span>
                                    <br>
                                    <span class="text-muted mb-0 small">{{ $notification->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    {{--  trephine notification end --}}
                    {{--  histo notification start --}}
                @elseif(isset($notification->data['histo_id']))
                    @if($notification->type == \App\Notifications\HistoApproveResultNotification::class)
                        <li class="list-unstyled noti-list">
                            <a class="dropdown-item" href="{{ route('histo') }}">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-bookmark fa-lg text-primary"></i>
                                    <div class="ms-3">
                                        <span class="mb-1 text-black text-wrap">{{ $notification->data['name'] }} {{ $notification->data['description'] }}</span>
                                        <br>
                                        <span class="text-muted mb-0 small">{{ $notification->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @elseif($notification->type == \App\Notifications\HistoResultAddNotification::class)
                        <li class="list-unstyled noti-list">
                            <a class="dropdown-item" href="{{ route('report.toApproveHisto') }}">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-bookmark fa-lg text-primary"></i>
                                    <div class="ms-3">
                                        <span class="mb-1 text-black text-wrap">{{ $notification->data['name'] }} {{ $notification->data['description'] }}</span>
                                        <br>
                                        <span class="text-muted mb-0 small">{{ $notification->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @else
                        <li class="list-unstyled noti-list">
                            <a class="dropdown-item" href="{{ route('histo.edit',$notification->data['histo_id']) }}">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-bookmark fa-lg text-primary"></i>
                                    <div class="ms-3">
                                        <span class="mb-1 text-black text-wrap">{{ $notification->data['name'] }} {{ $notification->data['description'] }}</span>
                                        <br>
                                        <span class="text-muted mb-0 small">{{ $notification->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endif
                    {{--  histo notification end --}}
                    {{--  cyto notification start --}}
                @else
                    @if($notification->type == \App\Notifications\CytoApproveResultNotification::class)
                        <li class="list-unstyled noti-list">
                            <a class="dropdown-item" href="{{ route('cyto') }}">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-bookmark fa-lg text-primary"></i>
                                    <div class="ms-3">
                                        <span class="mb-1 text-black text-wrap">{{ $notification->data['name'] }} {{ $notification->data['description'] }}</span>
                                        <br>
                                        <span class="text-muted mb-0 small">{{ $notification->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @elseif($notification->type == \App\Notifications\CytoResultAddNotification::class)
                        <li class="list-unstyled noti-list">
                            <a class="dropdown-item" href="{{ route('report.toApproveCyto') }}">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-bookmark fa-lg text-primary"></i>
                                    <div class="ms-3">
                                        <span class="mb-1 text-black text-wrap">{{ $notification->data['name'] }} {{ $notification->data['description'] }}</span>
                                        <br>
                                        <span class="text-muted mb-0 small">{{ $notification->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @else
                        <li class="list-unstyled noti-list">
                            <a class="dropdown-item" href="{{ route('cyto.edit',$notification->data['cyto_id']) }}">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-bookmark fa-lg text-primary"></i>
                                    <div class="ms-3">
                                        <span class="mb-1 text-black text-wrap">{{ $notification->data['name'] }} {{ $notification->data['description'] }}</span>
                                        <br>
                                        <span class="text-muted mb-0 small">{{ $notification->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endif
                        {{--  cyto notification end --}}
                @endif
            @empty
                <li class="list-unstyled noti-list">
                    <a class="dropdown-item" href="#">
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-bookmark fa-lg text-primary"></i>
                            <div class="ms-4">
                                <span class="mb-1" style="margin-left: 38px">No New Notifications!</span>
                            </div>
                        </div>
                    </a>
                </li>
            @endforelse
        </ul>
        <a href="{{ route('markAsRead') }}" class="btn btn-primary w-100 p-3" style="border-radius: 2px !important;">
            <li class="text-center">
                All Mark As Read
            </li>
        </a>
    </ul>
</div>
