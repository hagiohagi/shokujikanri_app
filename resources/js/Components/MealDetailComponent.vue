<template>
  <div>
    <div
      class="mb-3 row d-flex justify-content-between"
      v-for="(mealDetail, index) in mealDetails"
      :mealDetail="mealDetail"
      :key="index"
    >
      <div class="form-group col-4">
        <input class="form-control" type="text" v-model="mealDetail.foods" />
      </div>
      <div class="form-group col-4">
        <input
          class="form-control"
          type="text"
          v-model="mealDetail.ingredients"
        />
      </div>
      <div class="form-group col-4">
        <input class="form-control" type="text" v-model="mealDetail.amounts" />
      </div>
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
      mealDetails: [
        {
          foods: [""],
          ingredients: [""],
          amounts: [""],
        },
      ],
    };
  },
  methods: {
    addForm() {
      this.mealDetails.push(
        [
        {
          foods: [""],
          ingredients: [""],
          amounts: [""],
        },
      ]
      );
      console.log(mealDetails);
    },
    deleteForm(index) {
      this.mealDetails.splice(index, 1);
      console.log(mealDetails);
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