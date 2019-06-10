<template>
  
    <button type="button" class="btn btn-sx btn-danger" name="button" @click="deleteProduct">Delete</button>

</template>

<script>
import {mapMutations} from 'vuex';
export default {
  props:['id','index'],
  methods:{
    ...mapMutations(['deleteProductOfArray']),
    deleteProduct(){
      axios({
        method:'DELETE',
        data:{id:this.id},
        url:'/products/'+this.id
      }).then((response)=>{
        if(response.data==1)
          this.deleteProductOfArray(this.index)
      }).catch((error)=>{
        console.log(error);
      })
    }
  }
}
</script>

<style lang="css" scoped>
</style>
