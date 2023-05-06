{{-- <header class="header header-sticky mb-4">
  <div class="container-fluid">
    <h3>BILLING APPLICATION</h3>
   
    <div class="ms-auto">
      <a class="btn primary" href="{{ url('admin/logout')}}">Logout</a>
    </div>
    
  </div>
</header> --}}



@php
function createHeader()
{
    return '
<header>
    <h1> 
  hello world
    </h1>
</header>
';
}
@endphp
