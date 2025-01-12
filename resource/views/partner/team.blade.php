@extends('partner.layouts.app')

@section('page-title', 'Team Overview')

@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">{{ __('messages.team_overview') }}</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">InsurBet</a>

                            </li>
                            <li class="breadcrumb-item active">{{ __('messages.team_overview') }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <section id="team">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('messages.my_team_overview') }}</h4>
                        </div>
                        <div class="card-body">
                            <div id="jstree-basic">
                                <ul>
                                    @foreach ($tree as $unit)
                                        @php
                                            $level = 1;
                                        @endphp
                                        <li class="jstree-open" data-jstree='{"icon" : "far fa-folder"}'>
                                            [Level {{ $level }}] {{ $unit->username }} |
                                            @if(Auth::user()->rank->name == 'Member')
                                                {{ __('messages.rank_member') }}
                                            @elseif(Auth::user()->rank->name == 'Agent')
                                                {{ __('messages.rank_agent') }}
                                            @elseif(Auth::user()->rank->name == 'Master Agent')
                                                {{ __('messages.rank_master_agent') }}
                                            @elseif(Auth::user()->rank->name == 'Shareholder')
                                                {{ __('messages.rank_shareholder') }}
                                            @elseif(Auth::user()->rank->name == 'Master Shareholder')
                                                {{ __('messages.rank_master_shareholder') }}
                                            @endif |
                                            {{ $unit->package ? $unit->package->name : 'No Package' }}
                                            @if ($unit->state == 0)|
                                                [{{ __('messages.pending_approve') }}]
                                            @endif
                                            @if (count($unit->children))
                                                @php
                                                    $level++;
                                                @endphp
                                                @include('partner.teamChild', ['child' => $unit->children])
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        var basicTree = $('#jstree-basic');
        if (basicTree.length) {
            basicTree.jstree();
        }
    </script>
@endpush
