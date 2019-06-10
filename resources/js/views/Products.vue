<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12 col-md-12">
        <div class="card">
          <div class="card-header">
              Productos
          </div>
          <div class="card-body">
          </div>
            <div class="table-responsive-md table-responsive-xl table-responsive-xl">
              <table class="table table-striped text-center">
                <thead>
                  <th>ID</th>
                  <th>IMEI</th>
                  <th>MARCA</th>
                  <th>MODELO</th>
                  <th>COLOR</th>
                  <th>PRECIO</th>
                  <th>STOCK</th>
                  <th><i class="fas fa-ellipsis-h"></i> </th>
                </thead>
                <tbody>
                  <tr v-for='product in products'>
                    <td>{{product.id}}</td>
                    <td>{{product.imei}}</td>
                    <td>{{product.brand}}</td>
                    <td>{{product.model}}</td>
                    <td>{{product.color}}</td>
                    <td>{{product.sale_price}}</td>
                    <td>{{product.stock}}</td>
                    <td><sale-button-component :product="product" :key="product.id"></sale-button-component></td>
                  </tr>
                </tbody>
              </table>
            </div>
        </div>
      </div>
    </div>
    <infinite-loading spinner="waveDots" @infinite="getAllTheProducts">
      <div slot="no-more">No hay mas resultados</div>
      <div slot="no-results">No hay resultados :( </div>
    </infinite-loading>
  </div>
</template>
<script>

import {mapState} from 'vuex';
import {mapActions} from 'vuex';
export default {

  computed:{
    ...mapState(['products'])
  },
  methods:{
    ...mapActions(['getAllTheProducts'])
  }
}
</script>
