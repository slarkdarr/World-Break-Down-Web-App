<button onclick="confirmation()">Delete</button>

<script>
    function confirmation() {
        var msg;
        if (confirm('Do you want to delete this dorayaki?')) {
            msg = "Dorayaki has been deleted!"
        } else {
            msg = "Deleting dorayaki has been cancelled!"
        }
        alert(msg);
    }
</script>
