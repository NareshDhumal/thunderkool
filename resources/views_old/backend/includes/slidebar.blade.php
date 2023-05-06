@php
use App\Models\backend\BackendMenubar;
use App\Models\backend\BackendSubMenubar;
use App\Models\backend\Admin;
use App\Models\backend\UserMaster;
use Spatie\Menu\Laravel\Menu;
use Spatie\Permission\Models\Role;



$user_id = Auth()->guard('admin')->user()->id;
$role_id = Auth()->guard('admin')->user()->role;



$user_role = Role::where('id',$role_id)->first();
// $user_role = Role::all();
// dd($user_role);
$menu_ids=explode(",",$user_role->menu_ids);
$submenu_ids=explode(",",$user_role->submenu_ids);

$backend_menubar = BackendMenubar::WhereIn('menu_id',$menu_ids)->Where(['visibility'=>1])->orderBy('sort_order')->get();

@endphp







<div class="sidebar" data-color="white" data-active-color="danger">
      <div class="logo text-center">
    
        <img src="{{asset('public/assets/images/jmbaxi_logo.png')}}">
      </div>
      <div class="sidebar-wrapper" id="">
        <ul class="nav" >
          <li class="nav-item @if (Request::is('admin')) active @endif">
            <a href="{{route('admin.dashboard')}}"  id="nav-item" onclick="makeActive()">
              <i class="nc-icon nc-bank"></i>
              <p>Dashboard</p>
            </a>
          </li>

     


          <li class="nav-item " >

            @php
            foreach($backend_menubar as $menu)
            {
              if($menu->has_submenu == 1)
              {
                $backend_submenubar = BackendSubMenubar::WhereIn('submenu_id',$submenu_ids)->Where(['menu_id'=>$menu->menu_id])->get();
                if($backend_submenubar)
                {
          @endphp
    
         
    
          // <a class="nav-link collapsed text-truncate" href="#submenu1" onclick="makeActive()" id="nav-item" data-toggle="collapse" data-target="#submenu1" <span class="d-none d-sm-inline active-class" data-i18n="{{$menu->menu_name}}">{{$menu->menu_name}}</span>
            <a class="nav-link collapsed text-truncate" href="#submenu1" data-toggle="collapse" data-target="#submenu1" <span class="d-none d-sm-inline" data-i18n="{{$menu->menu_name}}">{{$menu->menu_name}}
            <i class="fa-solid fa-angle-down"></i>
            </span>
        
            </a>
              
    
               
            <div class="collapse" id="submenu1" aria-expanded="false">
              <ul class="flex-column pl-2 nav">
          @php
                    foreach($backend_submenubar as $submenu)
                    {
                      $suburl = ($submenu->submenu_controller_name != "#" && $submenu->submenu_controller_name != '')?route($submenu->submenu_controller_name):'#';
          @endphp
    
          <li class="nav-item "><a class="nav-link py-0"  href="{{ $suburl }}"> <span class="menu-item" data-i18n="{{ $submenu->submenu_name }}">{{ $submenu->submenu_name }}</span> </a></li>
    
                      <li><i class="bx bx-right-arrow-alt"></i>
                      </li>
          @php
                    }
          @endphp
               </ul>
                    </div>
                           </li>
          @php
                }
              }
              else
              {
                $url = ($menu->menu_controller_name != "#" && $menu->menu_controller_name != '')?route($menu->menu_controller_name):'#';
          @endphp
                <li class=" nav-item @if (request()->route()->named($menu->menu_controller_name)) active @else sdfb @endif"><a href="{{ $url }}" class="nav-link"> <i class="nc-icon {{$menu->menu_icon}}"></i><i class="menu-livicon" data-icon="{{ ($menu->menu_icon)?$menu->menu_icon:'notebook' }}"></i><span class="menu-title" data-i18n="{{$menu->menu_name}}">{{$menu->menu_name}}</span></a>
    
                </li>
          @php
              }
            }
          @endphp
    
    
          </li>
         
         
        </ul>
      </div>
    </div>

    