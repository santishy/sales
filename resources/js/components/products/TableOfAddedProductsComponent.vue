<template>
  <div class="card">
    <div class="card-body">
      <search-product-component></search-product-component>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>IMEI</th>
            <th>MODELO</th>
            <th>MARCA</th>
            <th>ACCIONES</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(product,index) in addedProducts" :key="product.id">
            <td>{{product.id}}</td>
            <td>{{product.imei}}</td>
            <td>{{product.model}}</td>
            <td>{{product.brand}}</td>
            <td>
              <button class="btn btn-info btn-xs" @click='setProduct(product)'>Edit</button>
              <delete-product-component :key="product.id" :index="index" :id="product.id"></delete-product-component>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

  </div>
</template>
<script>
import { mapState } from 'vuex';
import { mapActions } from 'vuex';
import { mapMutations } from 'vuex';
export default {
  created(){
    this.lastTenProducts()
    console.log("esto: " + this.addedProducts.indexOf('samsung'))
  },
  computed:{
    ...mapState(['addedProducts'])
  },
  methods:{
    ...mapMutations(['setProduct']),
    ...mapActions(['lastTenProducts']),

  }
}
</script>
