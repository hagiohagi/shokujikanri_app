<template>
  <div>
    <div class="d-flex" v-for="(mealDetail, index) in mealDetails" :key="index">
      <div class="form-group" style="width: 150px">
        <input
          class="form-control"
          type="text"
          :value="mealDetail.food"
          :name="'mealDetails&#91;' + index + '&#93;&#91;food&#93;'"
        />
      </div>
      <div class="form-group" style="width: 150px">
        <input
          class="form-control"
          type="text"
          :value="mealDetail.ingredient"
          :name="'mealDetails&#91;' + index + '&#93;&#91;ingredient&#93;'"
        />
      </div>
      <div class="form-group" style="width: 150px">
        <input
          class="form-control"
          type="text"
          :value="mealDetail.amount"
          :name="'mealDetails&#91;' + index + '&#93;&#91;amount&#93;'"
        />
      </div>
      <div class="batsu" style="width: 25px" @click.prevent="deleteForm(index)">
        ×
      </div>
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
import { reactive } from "vue";
import { onMounted } from "vue";
export default {
  props: {
    mealDetails: {
      type: Array,
    },
  },
  setup(props) {
    console.log("start vue");
    console.log(props);

    let mealDetails = [
        {
          food: [""],
          ingredient: [""],
          amount: [""],
        },
      ]

    onMounted(() => {
      console.log("start mounted !");
      console.log(props);
    });
    
    const addForm = () => {
      this.mealDetails.push([
        {
          food: [""],
          ingredient: [""],
          amount: [""],
        }
      ]);
      console.log(mealDetails);
    };

    const deleteForm = (index) => {
      this.mealDetails.splice(index, 1);
      console.log(mealDetails);
    };
    return { mealDetails, deleteForm, addForm };
  },

};
</script>
<style>
.batsu {
 font-size: 200%;
  font-weight: bold;
  height: 30px;
}
</style>