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
          <tr v-for="product in products">
            <td>{{product.imei}}</td>
            <td>{{product.brand}}</td>
            <td>{{product.model}}</td>
            <td>{{product.pivot.price}}</td>
            <td>
              <transition-group name="slide-fade" mode="out-in">
                <button class="btn btn-primary btn-small" v-if="btn" type="button" name="button" :key="'btn'" @click="change(false)"><i class="fas fa-edit"></i></button>
                <input class="form-control" v-else :keyup.13="change(false)" v-show="!btn" type="number" name="" :key="'price'" value="product.privot.price">
              </transition-group>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return {
        products:[],
        btn:true
    }

  },
  created(){
    this.getProductsOnSale();
  },
  methods:{
    getProductsOnSale(){
      axios({
        url:'product_sale',
        method:'GET'
      }).then((response)=>{
        console.log(response.data)
        this.products = response.data;
      }).catch((error)=>{
        console.log(error)
      })
    },
    change(val){
      this.btn=val;
      console.log("esto es val: "+val)
    }
  }
}
</script>

<style lang="css" scoped>
</style>
