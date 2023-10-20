  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="../../index3.html" class="brand-link">
          <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
              class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                  <a href="#" class="d-block">Alexander Pierce</a>
              </div>
          </div>

          <!-- SidebarSearch Form -->
          <div class="form-inline">
              <div class="input-group" data-widget="sidebar-search">
                  <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                      aria-label="Search">
                  <div class="input-group-append">
                      <button class="btn btn-sidebar">
                          <i class="fas fa-search fa-fw"></i>
                      </button>
                  </div>
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  {{-- Posts --}}
                  <li
                      class="nav-item {{ request()->is('dashboard/posts') || request()->is('dashboard/posts/*') ? 'menu-open' : '' }}">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Posts
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ route('posts.create') }}"
                                  class="nav-link {{ request()->is('dashboard/posts/create') ? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Create New</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('posts.index') }}"
                                  class="nav-link {{ request()->is('dashboard/posts') ? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>View All</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  {{-- Categories --}}
                  <li
                      class="nav-item {{ request()->is('dashboard/categories') || request()->is('dashboard/categories/*') ? 'menu-open' : '' }}">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Categories
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('categories.create') }}"
                                class="nav-link {{ request()->is('dashboard/categories/create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create New</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('categories.index') }}"
                                class="nav-link {{ request()->is('dashboard/categories') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View All</p>
                            </a>
                        </li>
                      </ul>
                  </li>
                  {{-- Category Types --}}
                  <li
                      class="nav-item {{ request()->is('dashboard/category-types') || request()->is('dashboard/category-types/*') ? 'menu-open' : '' }}">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Category Types
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('category-types.create') }}"
                                class="nav-link {{ request()->is('dashboard/category-types/create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create New</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('category-types.index') }}"
                                class="nav-link {{ request()->is('dashboard/category-types') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View All</p>
                            </a>
                        </li>
                      </ul>
                  </li>
                  {{-- Tags --}}
                  <li
                      class="nav-item {{ request()->is('dashboard/tags') || request()->is('dashboard/tags/*') ? 'menu-open' : '' }}">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Tags
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('tags.create') }}"
                                class="nav-link {{ request()->is('dashboard/tags/create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create New</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tags.index') }}"
                                class="nav-link {{ request()->is('dashboard/tags') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View All</p>
                            </a>
                        </li>
                      </ul>
                  </li>
                  {{-- Media Categories --}}
                  <li
                      class="nav-item {{ request()->is('dashboard/media-categories') || request()->is('dashboard/media-categories/*') ? 'menu-open' : '' }}">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Media Categories
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('media-categories.create') }}"
                                class="nav-link {{ request()->is('dashboard/media-categories/create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create New</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('media-categories.index') }}"
                                class="nav-link {{ request()->is('dashboard/media-categories') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View All</p>
                            </a>
                        </li>
                      </ul>
                  </li>
                  {{-- Media --}}
                  <li
                      class="nav-item {{ request()->is('dashboard/media') || request()->is('dashboard/media/*') ? 'menu-open' : '' }}">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Media
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('media.create') }}"
                                class="nav-link {{ request()->is('dashboard/media/create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create New</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('media.index') }}"
                                class="nav-link {{ request()->is('dashboard/media') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View All</p>
                            </a>
                        </li>
                      </ul>
                  </li>
                  {{-- Keywords --}}
                  <li
                      class="nav-item {{ request()->is('dashboard/keywords') || request()->is('dashboard/keywords/*') ? 'menu-open' : '' }}">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Keywords
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('keywords.create') }}"
                                class="nav-link {{ request()->is('dashboard/keywords/create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create New</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('keywords.index') }}"
                                class="nav-link {{ request()->is('dashboard/keywords') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View All</p>
                            </a>
                        </li>
                      </ul>
                  </li>
                  {{-- Post Status --}}
                  <li
                      class="nav-item {{ request()->is('dashboard/post-statuses') || request()->is('dashboard/post-statuses/*') ? 'menu-open' : '' }}">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Post Status
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('post-statuses.create') }}"
                                class="nav-link {{ request()->is('dashboard/post-statuses/create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create New</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('post-statuses.index') }}"
                                class="nav-link {{ request()->is('dashboard/post-statuses') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View All</p>
                            </a>
                        </li>
                      </ul>
                  </li>
                  {{-- Users --}}
                  <li
                      class="nav-item {{ request()->is('dashboard/users') || request()->is('dashboard/users/*') ? 'menu-open' : '' }}">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Users
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('users.create') }}"
                                class="nav-link {{ request()->is('dashboard/users/create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create New</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}"
                                class="nav-link {{ request()->is('dashboard/users') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View All</p>
                            </a>
                        </li>
                      </ul>
                  </li>
                  {{-- Roles --}}
                  <li
                      class="nav-item {{ request()->is('dashboard/roles') || request()->is('dashboard/roles/*') ? 'menu-open' : '' }}">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Roles
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('roles.create') }}"
                                class="nav-link {{ request()->is('dashboard/roles/create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create New</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('roles.index') }}"
                                class="nav-link {{ request()->is('dashboard/roles') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View All</p>
                            </a>
                        </li>
                      </ul>
                  </li>
                  {{-- Permissions --}}
                  <li
                      class="nav-item {{ request()->is('dashboard/permissions') || request()->is('dashboard/permissions/*') ? 'menu-open' : '' }}">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Permissions
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('permissions.create') }}"
                                class="nav-link {{ request()->is('dashboard/permissions/create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create New</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('permissions.index') }}"
                                class="nav-link {{ request()->is('dashboard/permissions') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View All</p>
                            </a>
                        </li>
                      </ul>
                  </li>
                  {{-- Logout --}}
                  <li class="nav-item">
                      <a href="javascript:void(0)" onclick="$('#logout-form').submit();"
                          class="nav-link {{ request()->is('logout') ? 'active' : '' }}">
                          <i class="fa fa-right-from-bracket nav-icon"></i>
                          <p>Logout</p>
                      </a>
                      {{-- Logout --}}
                      <form action="{{ route('logout') }}" id="logout-form" method="POST">
                          @csrf
                          @method('POST')
                      </form>
                  </li>
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
