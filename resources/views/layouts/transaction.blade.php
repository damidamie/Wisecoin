<!-- Transaction -->

<head>
    <title>Transaction</title>

    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/transaction.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Bootstrap CSS -->

    <!-- Script Lists -->
    <script src="https://kit.fontawesome.com/23c9e34443.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script> <!-- Popper.js -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> <!-- Bootstrap JS -->
</head>

<body>
    @include('sidebar')

    <div class="content">
        <h2>Transactions</h2>

        <!-- Button to Trigger Modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createTransactionModal">
            Create New Transaction
        </button>

        <!-- Transactions table -->
        <table id="transaction-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->date }}</td>
                        <td>{{ $transaction->type }}</td>
                        <td>{{ $transaction->amount }}</td>
                        <td>{{ $transaction->category }}</td>
                        <td>{{ $transaction->description }}</td>
                        <td>
                            <!-- Delete button for each transaction -->
                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                data-target="#deleteTransactionModal" data-transaction-id="{{ $transaction->id }}">
                                Delete
                            </button>
                        </td>
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

        @yield('content')
    </div>

    <!-- Create Transaction Modal -->
    <div class="modal fade" id="createTransactionModal" tabindex="-1" role="dialog"
        aria-labelledby="createTransactionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createTransactionModalLabel">Create New Transaction</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form for Creating New Transaction -->
                    <form method="POST" action="{{ route('store.transaction') }}">
                        @csrf

                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" name="date" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="time">Time</label>
                            <input type="time" name="time" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="type">Type</label>
                            <select name="type" class="form-control" required>
                                <option value="Deposit">Deposit</option>
                                <option value="Withdraw">Withdraw</option>
                                <option value="Transfer">Transfer</option>
                                <option value="Payment">Payment</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" name="amount" class="form-control" step="0.01" required>
                        </div>

                        <div class="form-group">
                            <label for="category">Category</label>
                            <select name="category" class="form-control" required>
                                <option value="Income">Income</option>
                                <option value="Transport">Transport</option>
                                <option value="Shopping">Shopping</option>
                                <option value="Food">Food</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Transaction Modal -->
    <div class="modal fade" id="deleteTransactionModal" tabindex="-1" role="dialog"
        aria-labelledby="deleteTransactionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteTransactionModalLabel">Confirm Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this transaction?</p>
                </div>
                <div class="modal-footer">
                    <form id="deleteTransactionForm" method="POST" action="{{ route('delete.transaction') }}">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="transaction_id" id="transactionId">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Transaction Modal Script -->
    <script>
        $(document).ready(function () {
            // Handle click event on delete button
            $('#deleteTransactionModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var transactionId = button.data('transaction-id'); // Extract transaction ID from data-* attributes
                $('#transactionId').val(transactionId); // Set the value of transaction ID in the hidden input field
            });
        });
    </script>

</body>