<!-- Sidebar -->

@php
    // Retrieve the transporter using the session ID
    $transporter = \App\Models\Transporters::find(session('transporter_id'));
@endphp

<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>

                <li class="{{ Route::is(['transporter.index']) ? 'active' : '' }}">
                    <a href="{{ route('transporter.index') }}">
                        <i class="fa-solid fa-gauge"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                @if ($transporter && $transporter->verified)
                    <li class="{{ Route::is(['transporter.hiring.request']) ? 'active' : '' }}">
                        <a href="{{ route('transporter.hiring.request') }}">
                            <i class="fa-solid fa-envelope-open-text"></i>
                            <span>Hiring Requests</span>
                        </a>
                    </li>

                    <li class="{{ Route::is(['transporter.mybids'], ['transporter.mybid.detail']) ? 'active' : '' }}">
                        <a href="{{ route('transporter.mybids') }}">
                            <i class="fa-solid fa-envelope-open-text"></i>
                            <span>My Bids</span>
                        </a>
                    </li>
                    <li class="{{ Route::is(['subscriptions']) ? 'active' : '' }}">
                        <a href="{{ route('subscriptions') }}">
                            <i class="fa-solid fa-envelope-open-text"></i>
                            <span>Subscriptions</span>
                        </a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->
