<template>
<div>
    <button type="button" class="btn " @click="openModal">
        <img :src="'images/logout.jpg'" width="40" alt="ログアウト">
    </button>
        <div class="modal fade" id="modal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    
                <div class="modal-body text-center">
                    <h5 class="modal-title" id="logoutModalLabel">ログアウトしてよろしいですか？</h5>
                    <div class="row justify-content-around mt-5">
                        <input type="button" class="btn btn-secondary" style="width:100px" data-dismiss="modal" value="戻る">
                        <input type="button" class="btn btn-secondary" style="width:100px" data-dismiss="modal" @click="logout" value="はい">
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        methods: {
            openModal(e) {
                    $('#modal').modal('show');
                },
            logout() {
                axios
                    .post("/api/logout")
                    .then(response => {
                        console.log(response);
                    })
                    .get("/login")
                    .catch(error => {
                        console.log(error);
                    });
            }
        }
    }
</script>