<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Planning</title>
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/transaction.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/23c9e34443.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    @include('sidebar')

    <div class="content">
        <h2>Planning</h2>

        <!-- Button to Trigger Modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createPlanningModal">
            Create New Planning
        </button>

        <!-- Display plans -->
        <table id="planning-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Daily Saving</th>
                </tr>
            </thead>
            <tbody>
                @foreach($plannings as $planning)
                    <tr>
                        <td>{{ $planning->target_date }}</td>
                        <td>{{ $planning->item_name }}</td>
                        <td>{{ $planning->price }}</td>
                        <td>{{ $planning->daily_saving }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Success or failed warning -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('failed'))
            <div class="alert alert-danger">
                {{ session('failed') }}
            </div>
        @endif

        <!-- Create Transaction Modal -->
        <div class="modal fade" id="createPlanningModal" tabindex="-1" role="dialog"
            aria-labelledby="createPlanningModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createPlanningModal">Create New Planning</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form for Creating New Transaction -->
                        <form method="POST" action="{{ route('store.planning') }}">
                            @csrf

                            <div class="form-group">
                                <label for="target_date">Target Date</label>
                                <input type="date" name="target_date" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="item_name">Item name</label>
                                <input type="text" name="item_name" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" name="price" class="form-control" step="0.01" required>
                            </div>


                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>