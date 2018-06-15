 <div class="col-md-3">
    <div class="nav-side-menu">
        <div class="brand">{{ config('app.name', 'Laravel') }}<br><small style="padding-top:20px;color:white;">Bienvenido {{Auth::user()->nombre}}</small>
</small> </div>

        <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>

        <div class="menu-list">
            <ul id="menu-content" class="menu-content collapse out">
                <li><a href="{{route('verCategorias')}}"> <i class="fa fa-tag fa-lg"></i> Categorías</a></li>
                <li><a href="{{route('verMarcas')}}"> <i class="fa fa-bookmark fa-lg"></i> Marcas</a></li>
                <li><a href="{{route('verTallas')}}"> <i class="fa fa-expand-arrows-alt fa-lg"></i> Tallas</a></li>
                <li><a href="{{route('verColores')}}"> <i class="fa fa-paint-brush fa-lg"></i> Colores</a></li>
                <li><a href="{{route('verGeneros')}}"> <i class="fa fa-transgender fa-lg"></i> Géneros</a></li>
                <li><a href="{{route('verProveedores')}}"> <i class="fa fa-truck fa-lg"></i> Proveedores</a></li>
                <li><a href="{{route('verPrendas')}}"> <i class="fa fa-box fa-lg"></i> Prendas</a></li>
                <li style="background-color:green;"><a href="{{route('verEntradas')}}"> <i class="fa fa-share fa-lg"></i> Ingreso Catalogo</a></li>
                <li><a href="{{route('verFacturas')}}"><i class="fa fa-shopping-cart  fa-lg"></i> Ventas</a></li>
                <li><a href="{{route('verUsuarios')}}"> <i class="fa fa-user fa-lg"></i> Usuarios</a></li>
            </ul>            
        </div>
    </div>
</div>