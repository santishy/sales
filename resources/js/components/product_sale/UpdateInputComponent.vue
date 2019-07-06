<template>
  <input type="text" v-on:keyup.enter="update" class="form-control" name="" value="">
</template>

<script>
export default {
  props:{
    product:{type:Object},
    index:{
      type:String
    },
    price:{
      type:Number
    }
  },
  methods:{
    getPrice(event)
    {
      console.log('este es un emit'+event.target.value)
    },
     update(){
       axios({
         method:'PUT',
         url:'/product_sale/'+this.product.pivot.id,
         data:{price:this.$el.value}
       }).then((response)=>{
            this.$emit('newPrice:event',[5,3])
            this.$el.parentElement.childNodes[0].style.display="inline-block";
            this.$el.parentElement.removeChild(this.$el.parentElement.childNodes[1]);
       }).catch((error)=>{
            console.log(error)
       })
     }
  }
}
</script>
