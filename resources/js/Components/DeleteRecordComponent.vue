<template>
  
          <button class="btn btn-light border" style="width:200px" name="delete" @click="deleteRecordForm()">削除する
            <div class="modal fade" id="deleteRecordModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-body text-center">
            <h5 class="modal-title" id="logoutModalLabel">登録を削除してよろしいですか？</h5>
            <div class="row justify-content-around mt-5">
                <input type="button" class="btn btn-secondary" style="width:100px" data-dismiss="modal" value="戻る">
                <input type="button" class="btn btn-secondary" style="width:100px" data-dismiss="modal" value="削除する">
            </div>
        </div>
        </div>
    </div>
  </div>
          </button>


  
</template>
<script>
export default {
  
  methods: {
    deleteRecordForm(e) {
      $('#deleteRecordModal').modal('show');
    },
  }
}
</script>