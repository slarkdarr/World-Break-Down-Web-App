<button onclick="confirmation()">Buy</button>

<script>
    function confirmation() {
        var msg;
        if (confirm('Do you want to buy this dorayaki?')) {
            msg = "Dorayaki has been bought!"
        } else {
            msg = "Buying dorayaki has been cancelled!"
        }
        alert(msg);
    }
</script>
