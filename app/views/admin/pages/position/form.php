<main id="main" class="main">
    <!-- Recent Sales -->
    <a href="/admin/position" class="btn btn-custom btn-primary mb-3" style="min-width: 200px; padding: 6px 32px !important">Quay về</a>
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <h5 class="card-title">Chức vụ</h5>

                <h3 class="text-center text-uppercase"> <?= (!empty($editMode)) ? 'Chỉnh sửa chức vụ' : 'Thêm chức vụ' ?></h3>
                <div class="row">
                    <?php
                    if (!empty($editMode)) {
                        
                        if (!empty($position)) {
                    ?>
                            <div class="col-lg-12">
                                <form id="job-form" action="/admin/position/edit" method="post" class="mx-auto">
                                    <input type="text" id="id" name="id" hidden value="<?=$position['id']?>">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group m-auto mt-2">
                                                <label for="title" class="form-label">Chức vụ</label>
                                                <input name="title" type="text" class="form-control" id="title" placeholder="Nhập chức vụ..." spellcheck="false" autocomplete="off" value="<?=$position['job_title']?>" />
                                                <div class="err-msg title-err-msg"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <button class="btn btn-custom btn-success" style="min-width: 200px; padding: 6px 32px !important">
                                            Hoàn tất
                                        </button>
                                    </div>
                                </form>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <div class="col-lg-12">
                            <form id="job-form" action="/admin/position/add" method="post" class="mx-auto">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group m-auto mt-2">
                                            <label for="title" class="form-label">Chức vụ</label>
                                            <input name="title" type="text" class="form-control" id="title" placeholder="Nhập chức vụ mới..." spellcheck="false" autocomplete="off" />
                                            <div class="err-msg title-err-msg"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <button class="btn btn-custom btn-success" style="min-width: 200px; padding: 6px 32px !important">
                                        Hoàn tất
                                    </button>
                                </div>
                            </form>
                        </div>
                    <?php } ?>
                </div>

            </div>
        </div>
    </div>
    <!-- End Recent Sales -->
</main>
<script>
    $('#job-form').on('submit', function(e) {
        e.preventDefault()
        const action = $(this).attr('action')
        let flag = true
        $('.err-msg').html('')
        if($('#title').val().trim() == ''){
            flag = false
            $('.title-err-msg').html("Chưa nhập chức vụ...")
        }
        if(flag){
            $.ajax({
                type: 'POST',
                url: action,
                data: $(this).serialize(),
                success: function(response) {
                    if (response) {
                        if (JSON.parse(response).status == 1) {
                            window.location = '/admin/position'
                        }else{
                            $('.title-err-msg').html(JSON.parse(response).errMsg)
                        }
                    }
                },
            });
        }
    })
</script>