<template>
          <button type="button" class="btn" @click="deletePictureForm()">
            写真を削除する
            <div class="modal fade" id="deletePictureModal">
              <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                  <div class="modal-body text-center">
                      <h5 class="modal-title" id="logoutModalLabel">写真削除してよろしいですか？</h5>
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
    deletePictureForm(e) {
      $('#deletePictureModal').modal('show');
    },
  }
}
</script>
