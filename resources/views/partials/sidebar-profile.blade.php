<div class="profile-picture">
    <img src="{{ auth()->user()->profile && auth()->user()->profile->profile_picture ? asset('storage/' . auth()->user()->profile->profile_picture) : 'https://via.placeholder.com/80/cccccc/969696?text=User' }}" alt="Profile Picture">
    <div class="user-name">{{ auth()->user()->name ?? 'User' }}</div>
</div>
<a href="{{ route('profile.index') }}" class="{{ request()->routeIs('profile.index') ? 'active' : '' }}">
    <i class="fas fa-user"></i> Profile
</a>
<a href="{{ route('profile.fill-doc') }}" class="{{ request()->routeIs('profile.fill-doc') ? 'active' : '' }}">
    <i class="fas fa-file-alt"></i> Fill Document
</a>
<a href="{{ route('profile.history') }}" class="{{ request()->routeIs('profile.history') ? 'active' : '' }}">
    <i class="fas fa-history"></i> History
</a>
<a href="#" class="{{ request()->routeIs('password.change') ? 'active' : '' }}">
    <i class="fas fa-lock"></i> Change Password
</a>
<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <i class="fas fa-sign-out-alt"></i> Logout
</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>