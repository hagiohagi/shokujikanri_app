<template>
  <div>
    <div class="d-flex" v-for="(mealDetail, index) in mealDetails" :key="index">
      <div class="form-group" style="width: 150px">
        <input
          class="form-control"
          type="text"
          v-model="mealDetails[index][food]"
          :name="'mealDetails&#91;' + index + '&#93;&#91;food&#93;'"
        />
      </div>
      <div class="form-group" style="width: 150px">
        <input
          class="form-control"
          type="text"
          v-model="mealDetails[index][ingredient]"
          :name="'mealDetails&#91;' + index + '&#93;&#91;ingredient&#93;'"
        />
      </div>
      <div class="form-group" style="width: 150px">
        <input
          class="form-control"
          type="text"
          v-model="mealDetails[index][amount]"
          :name="'mealDetails&#91;' + index + '&#93;&#91;amount&#93;'"
        />
      </div>
      <div class="batsu" style="width: 30px" @click.prevent="deleteForm(index)">
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
import { ref, onMounted } from "vue";

export default {
  props: {
    mealDetails: {
      type: Array,
    },
  },
  setup(__props) {
    console.log("start vue");

    onMounted(() => {
      console.log("start mounted !");
    });

    const mealDetails = ref([
      {
        foods: [""],
        ingredients: [""],
        amounts: [""],
      },
    ]);

    const addForm = () => {
      mealDetails.value.push([
        {
          foods: [""],
          ingredients: [""],
          amounts: [""],
        },
      ]);
      console.log(mealDetails);
    };
    const deleteForm = (index) => {
      mealDetails.value.splice(index, 1);
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
}
</style>