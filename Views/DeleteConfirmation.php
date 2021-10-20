<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../Assets/css/confirmation.css" />
    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/55c10e2ab9.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <title>Jajan.id</title>
</head>

<body>
    <script type="text/javascript">
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this Dorayaki!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    swal("Poof! The Dorayaki has been deleted!", {
                    icon: "success",
                    });
                } else {
                    swal("The Dorayaki is safe to eat later :D!");
                }
            });
    </script>
</body>
</html>
