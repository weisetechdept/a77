<div id="form">
    <form @submit.prevent="sendData">
        <input type="file" name="file_upload" id="file_upload" @change="onFileChange">
        <input type="submit" value="Submit">
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.1/axios.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>

        var upload = new Vue({
            el: '#form',
            data () {
                return {
                    file_upload: null
                }
            },
            methods: {
                onFileChange(e) {
                    this.file_upload = e.target.files[0];
                },
                sendData() {
                    var formData = new FormData();
                    formData.append('file_upload', this.file_upload);

                    swal({
                        title: "Uploading...",
                        text: "Please wait while the file is being uploaded.",
                        icon: "info",
                        buttons: false,
                        closeOnClickOutside: false,
                        closeOnEsc: false,
                        timer: 3000
                    });

                    axios.post('upload.php', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }).then(res => {
                        console.log(res);

                        if(res.data.success == true) 
                            swal("Success", "File uploaded successfully", "success",{ 
                                button: "OK"
                            }).then((value) => {
                                window.location.href = "/home";
                            });

                        if(res.data.success == false) 
                            swal("Error", "File upload failed", "warning",{ 
                                button: "OK"
                            }
                        );
                    });
                }
            }
        });
</script>