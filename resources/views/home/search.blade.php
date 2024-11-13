<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Search</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Search for a Place</h1>


        <form id="searchForm" method="GET" action="{{ route('search') }}">
            @csrf
            <div class="box-bg">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th><label>Pickup Address</label></th>
                        <th>
                            <input type="text" class="form-control green-border" id="autocomplete" name="pickup"
                                required placeholder="Enter Pickup Place">
                        </th>
                        <th><label>Delivery Address</label></th>
                        <th>
                            <input type="text" id="autocomplete1" class="form-control green-border" name="drop"
                                required placeholder="Enter Drop Place">
                        </th>
                        <th rowspan="2">
                            <button type="button" class="btn btn-danger distance" style="margin-top:25px;">Get
                                Distance</button>
                        </th>
                    </tr>
                    <tr>
                        <th>Distance</th>
                        <th><span id="get_distance"></span></th>
                        <th>Timing</th>
                        <th><span id="get_time"></span></th>
                    </tr>
                </table>
            </div>
            {{-- <button type="submit" class="btn btn-primary">Search</button> --}}
        </form>


    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        document.querySelector('.distance').addEventListener('click', function() {
            const pickup = document.getElementById('autocomplete').value;
            const drop = document.getElementById('autocomplete1').value;

            if (pickup && drop) {
                fetch(`{{ route('get.distance') }}?pickup=${pickup}&drop=${drop}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.distance && data.duration) {
                            document.getElementById('get_distance').innerText = data.distance;
                            document.getElementById('get_time').innerText = data.duration;
                        } else {
                            alert(data.msg || 'Failed to get distance information.');
                        }
                    });
            } else {
                alert('Please enter both pickup and drop locations.');
            }
        });
    </script>

</body>

</html>
