<template>
  <div>
    <div class="col-12 mb-3 row d-flex justify-content-between">
      <input-field
        v-for="(mealDetail, index) in mealDetails"
        :mealDetail="mealDetail"
        :key="index"
      ></input-field>
    </div>
    <div class="batsu" @click.prevent="deleteForm(index)">×</div>

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
var data_array = ["1", "2", "3"];
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
      mealDetails: data_array,
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
      this.mealDetails.push("");
    },
    deleteForm(index) {
      this.mealDetails.splice(index, 1);
    },
  },
  components: {
    "input-field": {
      template: `
			<div class="form-group col-4">
        <input class="form-control" type="text" v-model="mealDetail.foods" />
      </div>
      <div class="form-group col-4">
        <input class="form-control" type="text" v-model="mealDetail.ingredients" />
      </div>
      <div class="form-group col-4">
        <input class="form-control" type="text" v-model="mealDetail.amounts" />
      </div>`,
      props: ["mealDetail"],
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