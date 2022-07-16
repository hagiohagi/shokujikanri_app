<template>
  <div>
    <div class="col-12 mb-3 row d-flex justify-content-between">
      <div class="form-group col-4" v-for="(food, index) in foods" :key="index">
        <input class="form-control" type="text" v-model="foods[index]" />
      </div>
      <div
        class="form-group col-4"
        v-for="(ingredient, index) in ingredients"
        :key="index"
      >
        <input class="form-control" type="text" v-model="ingredients[index]" />
      </div>
      <div
        class="form-group col-4"
        v-for="(amount, index) in amounts"
        :key="index"
      >
        <input class="form-control" type="text" v-model="amounts[index]" />
      </div>
    </div>
    <div
      class="batsu"
      @click.prevent="deleteForm(index)"
    >
      ×
    </div>

    <button
      class="btn btn-secondary"
      style="width: 450px"
      @click.prevent="addForm()"
    >
      入力欄を追加
    </button>
  </div>
</template>
<script>
import { onMounted } from "vue";
export default {
  setup() {
    console.log("start vue");

    onMounted(() => {
      console.log("start mounted !");
    });
  },
  data() {
    return {
      foods: [""],
      ingredients: [""],
      amounts: [""],
    };
  },
  methods: {
    edit() {
      axios
        .post("/api/meal/edit", {
          foods: this.foods,
          ingredients: this.ingredients,
          amounts: this.amounts,
        })
        .then((response) => {
          console.log(response);
          this.$router.push("/index");
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },

    addForm() {
      this.foods.push("");
      this.ingredients.push("");
      this.amounts.push("");
    },
    deleteForm(index) {
      this.foods.splice(index, 1);
      this.ingredients.splice(index, 1);
      this.amounts.splice(index, 1);
    },
  },
};
</script>
<style>
.batsu {
  font-size: 200%;
  font-weight: bold;
}
</style>