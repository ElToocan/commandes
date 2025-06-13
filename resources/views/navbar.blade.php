<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
        <a href="#" class="navbar-brand">
            <img src="/dist/img/logo.png" alt="AdminLTE Logo" class="brand-image " style="opacity: .8">
            <span class="brand-text font-weight-light">  </span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <!-- Left navbar links -->

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ route('view') }}" class="nav-link"> Commandes </a>
                </li>

            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ route('add') }}" class="nav-link">Ajouter</a>
                </li>

            </ul>


        </div>
    </div>
</nav>
<!-- /.navbar -->
