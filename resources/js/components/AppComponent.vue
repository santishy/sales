<template>
  <div class="">
    <nav class="navbar  navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <router-link class="navbar-brand" :to="'/'">
                Liberacel
            </router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="....">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item active">
                    <router-link to="/products/create" class="nav-link">Crear Producto</router-link>
                  </li>
                  <li class="nav-item active">
                    <router-link to="/products" class="nav-link">Productos</router-link>
                  </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item active">
                    <router-link to="/product_sale" class="nav-link"><span class="badge badge-secondary" v-text="productsCount">{{productsCount}}</span><i class="fas fa-shopping-cart"></i></router-link>
                  </li>
                    <!-- Authentication Links -->
                    <!-- @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest -->
                </ul>
            </div>
        </div>
    </nav>
    <main class="py-4">
      <transition name="slide-fade" mode="out-in">
        <router-view :key="$route.fullPath"></router-view>
      </transition>
    </main>
  </div>
</template>
<script>
  import {mapActions} from 'vuex';
  import {mapState} from 'vuex';
  export default{
    created(){
      this.getProductsCount()
    },
    computed:{
      ...mapState(['productsCount'])
    },
    methods:{
      ...mapActions(['getProductsCount'])
    }
  }
</script>
