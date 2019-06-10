<template>
  <form id="form-search" class="form-inline mb-3 float-right" @submit.prevent="search">
    <input class="form-control mr-sm-2" type="text" id="word" name="word" placeholder="IMEI MODELO MARCA">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
  </form>
</template>

<script>
import {mapMutations} from 'vuex';
export default {
  methods:{
    ...mapMutations(['addSearchProducts']),
    search:function(e){
      axios({
        url:'/products',
        method:'get',
        params:{
          word:document.getElementById('word').value
        }
      }).then((response)=>{
          this.addSearchProducts(response.data)
      }).catch((error) => {
        console.log(error);
      })
    }
  }
}
</script>
