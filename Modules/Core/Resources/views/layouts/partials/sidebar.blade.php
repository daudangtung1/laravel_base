<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src="assets/images/faces/face1.jpg" alt="profile" />
                    <span class="login-status online"></span>
                    <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">{{ auth()->guard('admin')->user()->name }}</span>
                    <span class="text-secondary text-small">Project Manager</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#posts-menu" aria-expanded="false" aria-controls="posts-menu">
                <span class="menu-title">Bài viết</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-file-document menu-icon"></i>
            </a>
            <div class="collapse" id="posts-menu">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.posts.index') }}">Danh sách bài viết</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.posts.create') }}">Thêm bài viết</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.post-categories.index') }}">Danh mục</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Author</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-account menu-icon"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.author.index') }}">List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.author.create') }}">Create</a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
