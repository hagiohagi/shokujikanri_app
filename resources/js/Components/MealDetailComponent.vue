<template>
    <div>
        <label class="control-label mt-3">
          食事内容を入力してください（必須）&nbsp;<a href="#" name="help">ヘルプ</a>
        </label>
        <div class="row">
          <label class="control-label text-center" style="width:150px">食事</label>
          <label class="control-label text-center" style="width:150px">材料</label>
          <label class="control-label text-center" style="width:150px">量</label>
        </div>
        <div class="form-row">
          <div class="form-group" v-for="(food,index) in foods" :key="index">
            <input class="form-control" style="width:150px" type="text" v-model="foods[index]">
          </div>
          <div class="form-group" v-for="(ingredient,index) in ingredients" :key="index">
            <input class="form-control" style="width:150px" type="text" v-model="ingredients[index]">
          </div>
          <div class="form-group" v-for="(amount,index) in amounts" :key="index">
            <input class="form-control" style="width:150px" type="text" v-model="amounts[index]">
          </div>
          <div class="batsu" @click.prevent="deleteForm(index)">
            ×
          </div>
        </div>
        <button class=" btn btn-secondary" style="width:450px" @click.prevent="addForm()">入力欄を追加</button>
      </div>
</template>
<script>
export default {
  data() {
    return {
      foods: [],
      ingredients: [],
      amounts: []
    }
  },
  methods: {

    edit() {
      axios
        .post("/api/meal/edit",{
          foods: this.foods,
          ingredients: this.ingredients,
          amounts: this.amounts
        })
        .then(response => {
          console.log(response);
          this.$router.push("/index");
        })
        .catch(error => {
          this.errors = error.response.data.errors;
        })
    },

    addForm () {
      this.foods.push('')
      this.ingredients.push('')
      this.amounts.push('')
    },
    deleteForm (index) {
      this.foods.splice(index, 1)
      this.ingredients.splice(index, 1)
      this.amounts.splice(index, 1)
    },
  }
}
</script>
<style>
  .batsu{
    font-size: 200%;
    font-weight: bold;
}
</style>