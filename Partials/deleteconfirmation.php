<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../Assets/css/deleteConfirmation.css" />
</head>

<body>
    <button onclick="document.getElementById('id01').style.display='block'">Delete</button>

    <div id="id01" class="modal">
    <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">×</span>
    <form class="modal-content" action="/action_page.php">
        <div class="container">
        <h1>Delete Dorayaki</h1>
        <p>Are you sure you want to delete this dorayaki?</p>
        
        <div class="clearfix">
            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="deletebtn">Delete</button>
        </div>
        </div>
    </form>
    </div>

    <script>
    // Get the modal
    var modal = document.getElementById('id01');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    </script>
</body>
</html>
