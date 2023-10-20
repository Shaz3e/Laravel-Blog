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
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Posts
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="../../index.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Create New</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="../../index.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>View All</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  {{-- Categories --}}
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Categories
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="../../index.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Create New</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="../../index.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>View All</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  {{-- Category Types --}}
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Category Types
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="../../index.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Create New</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="../../index.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>View All</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  {{-- Tags --}}
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Tags
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="../../index.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Create New</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="../../index.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>View All</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  {{-- Media Categories --}}
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Media Categories
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="../../index.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Create New</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="../../index.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>View All</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  {{-- Media --}}
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Media
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="../../index.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Create New</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="../../index.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>View All</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  {{-- Keywords --}}
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Keywords
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="../../index.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Create New</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="../../index.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>View All</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  {{-- Post Status --}}
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Post Status
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="../../index.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Create New</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="../../index.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>View All</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  {{-- Users --}}
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                            Users
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="../../index.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Create New</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="../../index.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>View All</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  {{-- Roles --}}
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Roles
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="../../index.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Create New</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="../../index.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>View All</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  {{-- Permissions --}}
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                            Permissions
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="../../index.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Create New</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="../../index.html" class="nav-link">
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
