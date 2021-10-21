<button onclick="confirmation()">Delete</button>

<script>
    function confirmation() {
        var msg;
        if (confirm('Do you want to delete this dorayaki?')) {
            alert("Dorayaki has been deleted!");
        }
    }
</script>
