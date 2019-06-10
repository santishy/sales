<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-7">
        <div class="card border-primary mb-3">
          <div class="card-header">Crear Producto</div>
          <div class="card-body text-primary mr-3">
            <h5 class="card-title"></h5>
            <form  id="product-form"  @submit.prevent="submit">
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-3 col-form-label">Proveedor</label>
                <input type="text" id="provider" name="provider" v-model="product.provider" class="form-control col-sm-9">
              </div>
              <input id="id" v-if="product.id" type="hidden" v-model="product.id">

              <div class="form-group row">
                <label for="staticEmail" class="col-sm-3 col-form-label">IMEI</label>
                <input type="text" id="imei" v-model="product.imei" name="imei" value="" class="form-control col-sm-9">
              </div>

              <div class="form-group row">
                <label for="staticEmail" class="col-sm-3 col-form-label">Precio de compra</label>
                <input type="number" id="purcharse_price" v-model="product.purcharse_price" name="purcharse_price" value="" class="form-control col-sm-9">
              </div>

              <div class="form-group row">
                <label for="staticEmail" class="col-sm-3 col-form-label">Precio de venta</label>
                  <input type="number" id="sale_price" name="sale_price" v-model="product.sale_price" class="form-control col-sm-9">
              </div>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-3 col-form-label">Marca</label>
                <input type="text" id="brand" name="brand" v-model="product.brand" class="form-control col-sm-9">
              </div>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-3 col-form-label">Modelo</label>
                  <input type="text" id="model" name="model" v-model="product.model" class="form-control col-sm-9">
              </div>

              <div class="form-group row">
                <label for="staticEmail" class="col-sm-3 col-form-label">Color</label>
                <input type="text" id="color" name="color" v-model="product.color" class="form-control col-sm-9">
              </div>

              <div class="form-group row">
                <label for="staticEmail" class="col-sm-3 col-form-label">Descripción</label>
                <textarea id="description" name="description"  v-model="product.description" class="form-control col-sm-9"></textarea>
              </div>
              <div class="form-group row justify-content-end">
                <div class="col-sm-3">
                  <button v-if="product.id" type="button" @click="update" class="btn btn-primary btn-block">Editar</button>
                  <button  v-else type="submit" name="button" class="btn btn-success btn-block"> Guardar </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-sm-5">
        <table-products/>
      </div>
    </div>
  </div>
</template>
<script>
  import toastr from 'toastr'
  import { mapMutations } from 'vuex';
  import { mapState } from 'vuex';
  export default {
    data(){
      return{
        url:'/products/',
        errors:{provider:'',model:'',color:''},
        list:[],
      }
    },
    mounted(){
      toastr.options.preventDuplicates = true;
    },
    computed:{
      ...mapState(['product'])
    },
    methods:{
      // Actualizar producto

      update(){

        axios({
          url:'/products/'+this.product.id,
          method:'PUT',
          data:this.product
        }).then((response)=>{
          this.setProduct({});
          toastr.success('Se modifico correctamente el producto');


          // Regresar scroll al primer input en el form

          document.querySelector("#provider").scrollIntoView({behavior:'smooth'});
        }).catch((error)=>{
          this.paintError(error);
        })
      },

      // crear producto
      submit:function(e){
        this.errorsToClean();
        axios({
          url:this.url,
          method:'POST',
          data:this.product
        }).then((response)=>{
          if(response.data){
            toastr.success('Producto agregado correctamente');
            this.addProduct(response.data)
            // Regresar scroll al primer input en el form
            document.querySelector("#provider").scrollIntoView({behavior:'smooth'});
          }
        }).catch((error)=>{
          this.paintError(error);
        });
      },
      // Mostrar error en el formculario
      paintError(error){
        var errors;
        errors = error.response.data.errors;
        const firstItem = Object.keys(errors)[0];
        const firstItemDom = document.getElementById(firstItem);
        const firstErrorMessage = errors[firstItem][0];

        //Limpiar Divs con errores generados
        this.errorsToClean();

        firstItemDom.scrollIntoView({behavior:'smooth'})
        firstItemDom.insertAdjacentHTML('afterend',`<div class="text-danger col-sm-12">${firstErrorMessage}</div>`);
        toastr.error('Corrige el error en el formulario');
      },
      errorsToClean(){
        const inputs = document.querySelectorAll('.text-danger');
        inputs.forEach((element)=>element.textContent='');
      },
      ...mapMutations(['addProduct','setProduct'])
    }
  }
</script>
