<nav class="navbar fixed-top navbar-expand-lg bg-body-tertiary" style="background-image: linear-gradient(to bottom right, rgb(15, 102, 195), rgb(6, 137, 244));" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" style="font-weight: 300; font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;" href="/">PT LONDO BELL</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse nav justify-content-center" id="navbarSupportedContent" style="font-weight: 300; font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;">
            <ul class="nav justify-content-end">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 nav-underline">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/history">History</a>
                    </li>
                </ul>
            </ul>
        </div>
        <div class="mx-2 d-grid d-md-flex gap-2 justify-content-md-center">
            <a href="/profile" class="btn btn-outline-light">Profile</a>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-light">Logout</button>
            </form>
        </div>
    </div>
</nav>