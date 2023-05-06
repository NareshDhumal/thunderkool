<style>
    .navbar .dropdown .dropdown-toggle::after {display:none}
</style>

<nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <div class="navbar-toggle">
                <button type="button" class="navbar-toggler">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>
            <a class="navbar-brand" href="javascript:;">FEEDBACK PORTAL</a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
            aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
        </button>
        <div class="d-flex">
            <div class="dropdown mr-1">
              <button type="button" class="dropdown-toggle" id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="10,20" style=" 
              border: none !important;background-color: #004761;
color: #fff;
padding: 10px 15px 6px 15px;
font-size: 20px;border-radius:5px;">
                <i class="nc-icon nc-circle-10"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuOffset">
                <a class="dropdown-item"  href="{{ route('admin.logout') }}">
                    <i class="mdi mdi-logout me-2 text-primary"></i> Logout</a>
                
              </div>
            </div>
        {{-- <a class="dropdown-item text-right" style="width: 13%;" href="{{ route('admin.logout') }}">
            <i class="mdi mdi-logout me-2 text-primary"></i> Logout </a> --}}
    </div>
</nav>
