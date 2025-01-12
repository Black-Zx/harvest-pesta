@foreach($child as $unit)
    <ul>
        <li class="jstree-open" data-jstree='{"icon" : "fab fa-css3-alt"}'>
            [Level {{ $level }}] {{ $unit->username }} | 
            @if($unit->rank->name == 'Member')
                {{ __('messages.rank_member') }}
            @elseif($unit->rank->name == 'Agent')
                {{ __('messages.rank_agent') }}
            @elseif($unit->rank->name == 'Master Agent')
                {{ __('messages.rank_master_agent') }}
            @elseif($unit->rank->name == 'Shareholder')
                {{ __('messages.rank_shareholder') }}
            @elseif($unit->rank->name == 'Master Shareholder')
                {{ __('messages.rank_master_shareholder') }}
            @endif
            | {{  $unit->package ? $unit->package->name : 'No Package' }} @if($unit->state == 0)| [Pending Approve] @endif
            @if(count($unit->children))
            @php
                $level++;
            @endphp
            @include('partner.teamChild', ['child' => $unit->children])
            @php
                $level--;
            @endphp
        @endif
        </li> 
    </ul>
@endforeach
