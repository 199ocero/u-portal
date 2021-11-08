@php
  $prefix = Request::route()->getPrefix();
  $route = Route::current()->getName();
@endphp
<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">	
		
        <div class="user-profile">
			<div class="ulogo">
        <div class="d-flex align-items-center justify-content-center">					 	
          <img src="{{asset('backend/images/logo-dark.png')}}">
       </div>
			</div>
        </div>
      
      <!-- sidebar menu-->
      <ul class="sidebar-menu" data-widget="tree">  
		  
		  
        @role('superadministrator')
        <li class="{{($route=='home')?'active':''}}">
          <a href="{{route('home')}}">
            <i data-feather="pie-chart"></i>
			        <span>Dashboard</span>
          </a>
        </li>
          <li class="header nav-small-cap">Admin Management</li>
          <li class="treeview {{($prefix=='/super')?'active':''}}">
            <a href="#">
              <i data-feather="user"></i>
              <span>Admin</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{(($prefix=='/super' && $route=='view.super.administrator')
              ||($prefix=='/super' && $route=='view.super.edit.admin'))?'active':''}}"><a href="{{url('super/administrator/view')}}"><i class="ti-more"></i>View Admin</a></li>
            </ul>
          </li> 
        @endrole
        @role('administrator')
        <li class="{{ Request::routeIs('home') ? 'active' : '' }}">
          <a href="{{route('home')}}">
            <i data-feather="pie-chart"></i>
			        <span>Dashboard</span>
          </a>
        </li>
          <li class="header nav-small-cap">Instructor Management</li>
          <li class="treeview {{(($prefix == '/administrator' && $route=='view.administrator.instructor')||($prefix == '/administrator' && $route=='view.instructor.add')||($prefix == '/administrator' && $route=='view.edit.instructor'))?'active':''}}">
            <a href="#">
              <i data-feather="users"></i>
              <span>Instructor</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{(($prefix == '/administrator' && $route=='view.administrator.instructor')||($prefix == '/administrator' && $route=='view.instructor.add')||($prefix == '/administrator' && $route=='view.edit.instructor'))?'active':''}}"><a href="{{url('administrator/instructor/view')}}"><i class="ti-more"></i>View Instructor</a></li>
            </ul>
          </li>
          <li class="header nav-small-cap">Section Management</li>
          <li class="treeview {{(($prefix == '/administrator' && $route=='view.administrator.section')||($prefix == '/administrator' && $route=='view.details.section')||($prefix == '/administrator' && $route=='view.edit.section')
          ||($prefix == '/administrator' && $route=='view.student.section')||($prefix == '/administrator' && $route=='view.student.edit.section'))?'active':''}}">
            <a href="#">
              <i data-feather="home"></i>
              <span>Section</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{(($prefix == '/administrator' && $route=='view.administrator.section')||($prefix == '/administrator' && $route=='view.details.section')||($prefix == '/administrator' && $route=='view.edit.section')
              ||($prefix == '/administrator' && $route=='view.student.section')||($prefix == '/administrator' && $route=='view.student.edit.section'))?'active':''}}"><a href="{{url('administrator/section/view')}}"><i class="ti-more"></i>View Section</a></li>
            </ul>
          </li>
          <li class="header nav-small-cap">Subject Management</li>
          <li class="treeview {{(($prefix == '/administrator' && $route=='view.administrator.subject')
          ||($prefix == '/administrator' && $route=='view.edit.subject')
          ||($prefix == '/administrator' && $route=='view.add.view.subject'))?'active':''}}">
            <a href="#">
              <i data-feather="book"></i>
              <span>Subject</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{(($prefix == '/administrator' && $route=='view.administrator.subject')
              ||($prefix == '/administrator' && $route=='view.edit.subject')
              ||($prefix == '/administrator' && $route=='view.add.view.subject'))?'active':''}}"><a href="{{url('administrator/subject/view')}}"><i class="ti-more"></i>View Subject</a></li>
            </ul>
          </li>    
        @endrole
        @role('instructor')
          <li class="{{ Request::routeIs('home') ? 'active' : '' }}">
            <a href="{{route('home')}}">
              <i data-feather="pie-chart"></i>
                <span>Dashboard</span>
            </a>
          </li>
          <li class="header nav-small-cap">Profile Management</li>
          <li class="treeview {{(($prefix == '/instructor' && $route=='view.profile')
          ||($prefix == '/instructor' && $route=='view.profile.edit'))?'active':''}}">
            <a href="#">
              <i data-feather="user"></i>
              <span>Profile</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{(($prefix == '/instructor' && $route=='view.profile.instructor')
              ||($prefix == '/instructor' && $route=='view.profile.edit.instructor'))?'active':''}}"><a href="{{url('instructor/profile/view')}}"><i class="ti-more"></i>View Profile</a></li>
              <li class="{{(($prefix == '/instructor' && $route=='view.password.instructor'))?'active':''}}"><a href="{{url('instructor/password/view')}}"><i class="ti-more"></i>Change Password</a></li>
            </ul>
          </li> 
          <li class="header nav-small-cap">Assign Management</li>
          <li class="treeview {{(($prefix == '/instructor' && $route=='view.instructor.section.subject')
          ||($prefix == '/instructor' && $route=='view.details.instructor.section.subject')
          ||($prefix == '/instructor' && $route=='view.instructor.student.section')
          ||($prefix == '/instructor' && $route=='view.announcement')
          ||($prefix == '/instructor' && $route=='view.add.page.announcement'))?'active':''}}">
            <a href="#">
              <i data-feather="book"></i>
              <span>Assign</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{(($prefix == '/instructor' && $route=='view.instructor.section.subject')
              ||($prefix == '/instructor' && $route=='view.details.instructor.section.subject')
              ||($prefix == '/instructor' && $route=='view.instructor.student.section')
              ||($prefix == '/instructor' && $route=='view.announcement')
              ||($prefix == '/instructor' && $route=='view.add.page.announcement'))?'active':''}}"><a href="{{url('instructor/assign/section-subject/view')}}"><i class="ti-more"></i>View Assign</a></li>
            </ul>
          </li>  
        @endrole
        @role('student')
          <li class="{{ Request::routeIs('home') ? 'active' : '' }}">
            <a href="{{route('home')}}">
              <i data-feather="pie-chart"></i>
                <span>Dashboard</span>
            </a>
          </li>
          <li class="header nav-small-cap">Profile Management</li>
          <li class="treeview {{(($prefix == '/student' && $route=='view.profile')
          ||($prefix == '/student' && $route=='view.profile.edit'))?'active':''}}">
            <a href="#">
              <i data-feather="user"></i>
              <span>Profile</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{(($prefix == '/student' && $route=='view.profile.student')
              ||($prefix == '/student' && $route=='view.profile.edit.student'))?'active':''}}"><a href="{{url('student/profile/view')}}"><i class="ti-more"></i>View Profile</a></li>
              <li class="{{(($prefix == '/student' && $route=='view.password.student'))?'active':''}}"><a href="{{url('student/password/view')}}"><i class="ti-more"></i>Change Password</a></li>
            </ul>
          </li> 
          <li class="header nav-small-cap">Announcement Management</li>
          <li class="treeview {{(($prefix == '/student' && $route=='view.announcement')
          ||($prefix == '/student' && $route=='view.announcement.details'))?'active':''}}">
            <a href="#">
              <i data-feather="message-square"></i>
              <span>Announcement</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{(($prefix == '/student' && $route=='view.announcement')
              ||($prefix == '/student' && $route=='view.announcement.details'))?'active':''}}"><a href="{{url('student/announcement/view/')}}"><i class="ti-more"></i>View Announcement</a></li>
            </ul>
          </li>
          <li class="header nav-small-cap">Facebook Management</li>
          <li class="treeview  {{(($prefix == '/student' && $route=='view.facebook'))?'active':''}}">
            <a href="#">
              <i data-feather="facebook"></i>
              <span>Facebook ID</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{(($prefix == '/student' && $route=='view.facebook'))?'active':''}}"><a href="{{url('student/facebook/view/')}}"><i class="ti-more"></i>View Facebook ID</a></li>
            </ul>
          </li>    
        @endrole    
        
		  <hr>
		  <li>
          <a href="{{ route('logout') }}"
          onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
            <i data-feather="lock"></i>
			        <span>Log Out</span>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
          
        </li> 
        
      </ul>
    </section>
	
	
  </aside>