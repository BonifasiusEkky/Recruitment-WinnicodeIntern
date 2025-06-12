<div class="profile-card sidebar">
    <div class="profile-picture">
        <img src="{{ asset('images/default-avatar.png') }}" alt="User Avatar" onerror="this.src='https://via.placeholder.com/80'" style="width: 80px; height: 80px;">
        <h5 class="mt-2">{{ auth()->user()->name ?? 'Name' }}</h5>
    </div>
    <a href="{{ url('/profile') }}" class="{{ request()->is('profile') ? 'active' : '' }}"><i class="fas fa-user"></i> Profile</a>
    <a href="{{ url('/profile/fill-doc') }}" class="{{ request()->is('profile/fill-doc') ? 'active' : '' }}"><i class="fas fa-file-alt"></i> Fill Document</a>
    <a href="{{ url('/profile/history') }}" class="{{ request()->is('profile/history') ? 'active' : '' }}"><i class="fas fa-history"></i> History</a>
    <a href="{{ url('/profile/change-password') }}" class="{{ request()->is('profile/change-password') ? 'active' : '' }}"><i class="fas fa-lock"></i> Change Password</a>
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="{{ request()->is('logout') ? 'active' : '' }}">
        <i class="fas fa-sign-out-alt"></i> Logout
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>