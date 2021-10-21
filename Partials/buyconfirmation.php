<button onclick="confirmation()">Buy</button>

<script>
    function confirmation() {
        var msg;
        if (confirm('Do you want to buy this dorayaki?')) {
            alert("Dorayaki has been bought!");
        }
    }
</script>
