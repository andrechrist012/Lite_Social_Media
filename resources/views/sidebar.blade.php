<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: rgb(59, 121, 172); position: fixed;">
    <!-- Brand Logo -->
    <a href="/all_post" class="brand-link" style="border-bottom: 1px solid white;">
      <center>
      <span class="brand-text font-weight-bold" style="color: white;"> SKYPOST</span>
      </center>
    </a>
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="border-bottom: 1px solid white;">
        <div class="image">
          <img src="{{asset('image-upload/'.$profile->thumbnail_url)}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="/profile" class="d-block" style="color: white;">{{$profile->first_name}} {{$profile->last_name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="/all_post" class="nav-link" style="color: white;">
            <i class="nav-icon fas fa-book"></i>
              <p>
                All Post
              </p>
            </a>
          </li>
          @if (Auth::user()->email == 'admin@skypost.com')
          <li class="nav-item">
            <a href="/post/create" class="nav-link" style="color: white;">
              <i class="nav-icon far fa-plus-square"></i>
              <p>
                Create Post
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/all_user" class="nav-link" style="color: white;">
              <i class="nav-icon far fa-address-book"></i>
              <p>
                All User
              </p>
            </a>
          </li>
          @else
          <li class="nav-item">
            <a href="/post/create" class="nav-link" style="color: white;">
              <i class="nav-icon far fa-plus-square"></i>
              <p>
                Create Post
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/like_post" class="nav-link" style="color: white;">
              <i class="nav-icon far fa-thumbs-up"></i>
              <p>
                View Like Post
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/list_follow" class="nav-link" style="color: white;">
              <i class="nav-icon fas fa-user-friends"></i>
              <p>
                Follow User
              </p>
            </a>
          </li>
          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
</aside>