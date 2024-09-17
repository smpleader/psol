<form class="hidden" method="POST" id="form_delete">
    <input type="hidden" value="<?php echo $this->token ?>" name="token">
    <input type="hidden" value="DELETE" name="_method">
</form>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    document.getElementById('clear_filter').onclick = function() {
        document.getElementById("search").value = "";
        document.getElementById("sort").value = "title asc";
        document.getElementById('filter_form').submit();
    };
    $(document).ready(function() {
        $("#select_all").click( function(){
            $('.checkbox-item').prop('checked', this.checked);
        });
        $(".button_delete_item").click(function() {
            var id = $(this).data('id');
            var result = confirm("You are going to delete 1 record(s). Are you sure ?");
            if (result) {
                $('#form_delete').attr('action', '<?php echo $this->link_form;?>/' + id);
                $('#form_delete').submit();
            }
            else
            {
                return false;
            }
        });
        $('#delete_selected').click(function(){
            var count = 0;
            $('input[name="ids[]"]:checked').each(function() {
                count++;
            });
            if (!count)
            {
                alert('Please select the record before deleting!')
                return false;
            }
            var result = confirm("You are going to delete " + count + " record(s). Are you sure ?");
            if (result) {
                $('#formList').submit();
            }
            else
            {
                return false;
            }
        });
        $('#limit').on("change", function (e) {
            $('#filter_form').submit()
        });
        $(".show_data").click(function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var release_date = $(this).data('release_date');
            var description = $(this).data('description');
            var version_number = $(this).data('version_number');
            
            $('#name').val(name);
            $('#release_date').val(release_date);
            $('#description').val(description);
            document.getElementById('version_number').innerHTML = version_number;

            // show change logs popup
            var title = $(this).data('title');
            var logs = $(this).data('logs');
            $('#log-modal-title').text(title);
            $('#log-modal-content').html(logs);

            $('#save').click(function() {
                if(id == 0) {
                    $('#form_version').attr('action', '<?php echo $this->link_form; ?>/' + id);
                    $('#version').val('POST');
                } else {
                        $('#form_version').attr('action', '<?php echo $this->link_form; ?>/' + id);
                        $('#version').val('PUT');
                }
            });
        });
    });
</script>