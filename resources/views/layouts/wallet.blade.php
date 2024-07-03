<!-- Wallet -->

<head>
    <title>Wallet</title>
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/wallet.css') }}"> <!-- Add this line -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Bootstrap CSS -->

    <script src="https://kit.fontawesome.com/23c9e34443.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script> <!-- Popper.js -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> <!-- Bootstrap JS -->
</head>

<body>
    @include('sidebar')

    <div class="content">
        <h2>Your Wallet</h2>

        <p>Total Transfer: ${{ $totalBalance }}</p>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createMonthlyExpenseModal">
            Create Monthly Expense
        </button>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateMonthlyExpenseModal">
            Update Monthly Expense
        </button>

        <p>Monthly Expense Target: ${{ $targetMonthlyExpense->amount ?? 0 }}</p>

        <p>Monthly Expense: ${{ $monthlyExpense }}</p> 
        
        <p>Balance: ${{ $totalBalance }}</p>

        <!-- Warning message for balance exceeding monthly expense -->
        @if($monthlyExpense > $targetMonthlyExpense->amount)
            <div class="alert alert-danger">
                Warning: Your spending has exceeded the monthly expense target by (${{ $monthlyExpense - ($targetMonthlyExpense->amount) }}).
            </div>
        @endif


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
        <!-- Other wallet content goes here -->

        @yield('content')
    </div>

    <!-- Create Modal for Monthly Expense -->
    <div class="modal fade" id="createMonthlyExpenseModal" tabindex="-1" role="dialog"
        aria-labelledby="createMonthlyExpenseModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createMonthlyExpenseModalLabel">Create Monthly Expense</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('store.monthly_expense') }}">
                        @csrf

                        <div class="form-group">
                            <label for="expenseAmount">Expense Amount</label>
                            <input type="number" name="monthly_expense" class="form-control" id="expenseAmount"
                                placeholder="Enter expense amount">
                        </div>
                        <!-- Add more form fields as needed -->
                        <button type="submit" class="btn btn-primary">Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Modal for Monthly Expense -->
    <div class="modal fade" id="updateMonthlyExpenseModal" tabindex="-1" role="dialog"
        aria-labelledby="updateMonthlyExpenseModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateMonthlyExpenseModalLabel">Update Monthly Expense</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('update.monthly_expense') }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="expenseAmount">Expense Amount</label>
                            <input type="number" name="monthly_expense" class="form-control" id="expenseAmount"
                                placeholder="Enter expense amount">
                        </div>
                        <!-- Add more form fields as needed -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>

</body>