<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">	
		
        <div class="user-profile">
			<div class="ulogo">
				 <a href="index.html">
				  <!-- logo for regular state and mobile devices -->
					 <div class="d-flex align-items-center justify-content-center">					 	
						  <img src="{{asset('backend/images/logo-dark.png')}}" alt="">
						  <h3><b>UPortal</b> Panel</h3>
					 </div>
				</a>
			</div>
        </div>
      
      <!-- sidebar menu-->
      <ul class="sidebar-menu" data-widget="tree">  
		  
		  <li>
          <a href="index.html">
            <i data-feather="pie-chart"></i>
			        <span>Dashboard</span>
          </a>
        </li>  
        <li class="header nav-small-cap">Account Management</li>
        <li class="treeview">
          <a href="#">
            <i data-feather="user"></i>
            <span>Admin</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('super/administrator/view')}}"><i class="ti-more"></i>View Admin</a></li>
          </ul>
        </li> 
		  
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