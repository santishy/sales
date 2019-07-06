<template>
  <div class="container">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Venta Actual</h3>
      </div>
      <div class="card-body">
      </div>
      <table class="table text-center">
        <thead>
          <th>IMEI</th>
          <th>Marca</th>
          <th>Modelo</th>
          <th>Precio</th>
          <th>Acciones</th>
        </thead>
        <tbody>
          <tr v-for="(product,index) in products">
            <td>{{product.imei}}</td>
            <td>{{product.brand}}</td>
            <td>{{product.model}}
            </td>
            <td>{{product.pivot.price}}
            </td>
            <td>
               <i class="far fa-edit fa-2x cursor-pointer" :data-index="parseInt(index,10)" :data-product="JSON.stringify(product)"  name="button" :key="product.id" @click="changePrice"></i>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
<script>
import SearchProductComponent from '../components/products/SearchProductComponent';
import UpdateInputComponent from '../components/product_sale/UpdateInputComponent';
export default {
  data(){
    return {
        products:[],
        ban:true,
        num:0,
        on:{
          newprice:function(event){
            console.log('hola mundo')
          }
        }
    }

  },
  created(){
    this.getProductsOnSale();
  },
  components:{
    SearchProductComponent
  },
  methods:{
    getProductsOnSale(){
      axios({
        url:'product_sale',
        method:'GET'
      }).then((response)=>{
        this.products = response.data;
      }).catch((error)=>{
        console.log(error)
      })
    },
    getPrice(event)
    {
      console.log('este es un emit '+event[0])
    },
    changePrice(event){
      var parent,child;
      /*
        Anteriormente tenia un boton y dentro de este un icono en un span, es por eso
        que tuve que crear esta logica para capturar el evente cuando diera click
        sobre el boton o el span
      */
      if(event.toElement.classList[0] == 'far')// parrafo de arriba lo explica
      {
        console.log(event)
        parent = event.toElement.parentNode.parentNode.children[3];
        child = event.toElement;
      }
      else
      {
        parent = event.toElement.parentNode.parentNode;
        child = event.toElement.parentNode;
      }
        var componentClass = Vue.extend(UpdateInputComponent);
        var instance = new componentClass({
          propsData:{
            product:JSON.parse(child.dataset.product),
            index:child.dataset.index,
          },
          parent:this
        });
        instance.$mount();
        instance.$on('newPrice:event',this.getPrice);
        parent.appendChild(instance.$el);
        child.style.display="none";
    },
  }
}
</script>
