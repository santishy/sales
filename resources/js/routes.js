import Vue from 'vue';
import VueRouter from 'vue-router';
import Create from  './views/Create';
import Home from  './views/Home';
import Products from './views/Products';
import ProductsOnSale from './views/ProductsOnSale';
import  Error404 from  './views/Error404';



export default new VueRouter({
  routes:[
    {
      path :'/products/',
      component: Products,
      name:'products'
    },
    {
      path : '/products/create',
      component : Create,
      name:'products.create',
    },
    {
      path : '/',
      component : Home,
      name:'Home',
    },
    {
      path:'/product_sale',
      component:ProductsOnSale,
      name:'product_sale.index'
    },
    {
      path : '*',
      component: Error404
    }
  ],
  mode:'history'
})
Vue.use(VueRouter);
