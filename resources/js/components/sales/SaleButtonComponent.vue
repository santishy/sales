<template>
  <button type="button" class="btn btn-outline-secondary btn-sm" name="button" @click="toSell"><i class="fas fa-plus"></i></button>
</template>

<script>
import {mapMutations} from 'vuex';
export default {
  props:{
    product:Object
  },
  methods:{
    toSell(){
      axios({
        url:'product_sale',
        method:'POST',
        data:{price:this.product.sale_price,product_id:this.product.id},
      }).then((response)=>{
        if(response.data.id)
          this.increment();
      }).catch((error)=>{
        console.log(error);
      })
    },
    ...mapMutations(['increment'])
  }
}
</script>

<style lang="css" scoped>
</style>
