<template>
  <div>
    <div
      class="d-flex"
      v-for="(mealDetail, index) in mealDetails"
      :mealDetail="mealDetail"
      :key="index"
    >
      <div class="form-group" style="width:150px">
        <input
          class="form-control"
          type="text"
          v-model="mealDetail.foods"
          :name="'mealDetails&#91;' + index + '&#93;&#91;food&#93;'"
        />
      </div>
      <div class="form-group" style="width:150px">
        <input
          class="form-control"
          type="text"
          v-model="mealDetail.ingredients"
          :name="'mealDetails&#91;' + index + '&#93;&#91;ingredient&#93;'"
        />
      </div>
      <div class="form-group" style="width:150px">
        <input
          class="form-control"
          type="text"
          v-model="mealDetail.amounts"
          :name="'mealDetails&#91;' + index + '&#93;&#91;amount&#93;'"
        />
      </div>
      <div class="batsu" style="width:30px" @click.prevent="deleteForm(index)">×</div>
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
      this.mealDetails.push([
        {
          foods: [""],
          ingredients: [""],
          amounts: [""],
        },
      ]);
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