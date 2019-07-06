/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
;
window.Vue = require('vue');
window.Vuex = require('vuex');
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('sale-button-component',require('./components/sales/SaleButtonComponent.vue').default);
Vue.component('update-input',require('./components/product_sale/UpdateInputComponent.vue').default);
Vue.component('InfiniteLoading',require('vue-infinite-loading'));
Vue.component('app-component', require('./components/AppComponent.vue').default);
Vue.component('table-products',require('./components/products/TableOfAddedProductsComponent.vue').default);
Vue.component('delete-product-component',require('./components/products/DeleteProductComponent.vue').default);
Vue.component('search-product-component',require('./components/products/SearchProductComponent.vue').default)
//Vue.component('Create', require('./views/Create.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.use('InfiniteLoading');
const store = new Vuex.Store({
    state:{
      addedProducts:[],
      product:{},
      products:[],
      productsCount:0,
      page:1
    },
    mutations:{
      increment(state){
        state.productsCount++;
      },
      setProductsCount(state,productsCount){
        state.productsCount = productsCount;
      },
      addProduct(state,product){
        state.addedProducts.unshift(product);
      },
      addProductList(state,products)
      {
        state.addedProducts = products;
      },
      addSearchProducts(state,products){
        state.addedProducts = products;
      },
      setProduct(state,product){
        state.product = product
      },
      setProducts(state,products){
        state.products = state.products.concat(products);
      },
      deleteProductOfArray(state,index){
        state.addedProducts.splice(index,1)
      },
      nextPage(state){
        state.page+=1;
      }
    },
    actions:{
      lastTenProducts: function ({commit}){
        let data = null;
        axios({
          method:'GET',
          url:'/last-ten-products',
          headers:{
						'Accept':'application/json',
						'Content-Type':'application/json'
					}
        }).then((response)=>{
           data = response.data
           commit('addProductList',data);
        }).catch((error)=>{
          console.log(error);
        })
      }, //end of function lastTenProducts
      getAllTheProducts:function({commit},$state){
        axios({
          url:'/products',
          params:{
            page:store.state.page
          }
        })
        .then((response) =>{
          if(response.data.data.length){
            commit('setProducts',response.data.data);
            commit('nextPage');
            $state.loaded();
          }
          else{
            $state.complete();
          }

        })
        .catch((error)=>{
          console.log(error)
        })
      },
      getProductsCount:function({commit}){
        axios({
          url:'/sales/products-count',
          method:'GET'
        }).then((response)=>{
          console.log(response.data)
          commit('setProductsCount',response.data.productsCount);
        }).catch((error)=>{
          console.log(error)
        })
      }
    }
});

import VueRouter from './routes.js'

const app = new Vue({
    el: '#app',
    router:VueRouter,
    store,
    
});
