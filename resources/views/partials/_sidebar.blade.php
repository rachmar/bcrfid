<section class="sidebar">

  <div class="user-panel">
    <div class="pull-left image">
      <img src="https://raw.githubusercontent.com/Infernus101/ProfileUI/0690f5e61a9f7af02c30342d4d6414a630de47fc/icon.png" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p>{{ Auth::user()->name }}</p>
      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
  </div>


  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">Main Menu</li>

    @if (Auth::user()->isAdmin())

      
      <li class="{{ Request::segment(2) === 'announcements' ? 'active' : '' }}">
        <a href="{{ route('announcement.index') }}">
          <i class="fa fa-building" aria-hidden="true"></i>
            <span>Announcements</span>
        </a>
      </li>

      <li class="{{ Request::segment(2) === 'students' ? 'active' : '' }}">
        <a href="{{ route('student.index') }}">
          <i class="fa fa-users" aria-hidden="true"></i>
            <span>Students</span>
        </a>
      </li>

      <li class="{{ Request::segment(2) === 'report' ? 'active' : '' }}">
        <a href="{{ route('report.index') }}">
          <i class="fa  fa-money" aria-hidden="true"></i>
            <span>Reports</span>
        </a>
      </li>

      <li class="{{ Request::segment(2) === 'setting' ? 'active' : '' }}">
        <a href="{{ route('setting.index') }}">
          <i class="fa  fa-money" aria-hidden="true"></i>
            <span>Settings</span>
        </a>
      </li>

    @endif

   
    <li class="header">Options</li>

    <li>

      <a  href="{{ route('logout') }}"
         onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
          <i class="fa fa-circle-o text-red"></i>
          <span>{{ __('Logout') }}</span>
      </a>

      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
      </form>
      
    </li>

  </ul>

</section>




