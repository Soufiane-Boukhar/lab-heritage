<li class="nav-item">
    <a href="{{ route('membre.index') }}" class="nav-link {{ Request::is('membre.index') ? 'active' : '' }}">
      <i class="nav-icon fas fa-users"></i>
      <p>Membres</p>
    </a>
</li>

<li class="nav-item">
  <a href="{{ route('client.index') }}" class="nav-link {{ Request::is('client.index') ? 'active' : '' }}">
    <i class="nav-icon fas fa-users"></i>
    <p>Clients</p>
  </a>
</li>

