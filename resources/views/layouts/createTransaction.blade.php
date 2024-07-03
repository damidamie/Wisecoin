<!-- Transaction Create -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Transaction</title>
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/createTransaction.css') }}">
</head>

<body>
    @include('sidebar')

    <div class="content">
        <h2>Create New Transaction</h2>

        <form method="POST" action="{{ route('store.transaction') }}">
            @csrf

            <label for="date">Date</label>
            <input type="date" name="date" required>

            <label for="time">Time</label>
            <input type="time" name="time" required>

            <label for="type">Type</label>
            <select name="type" required>
                <option value="Deposit">Deposit</option>
                <option value="Withdraw">Withdraw</option>
                <option value="Transfer">Transfer</option>
                <option value="Payment">Payment</option>
            </select>

            <label for="amount">Amount</label>
            <input type="number" name="amount" step="1" required>

            <label for="category">Category</label>
            <select name="category" required>
                <option value="Income">Income</option>
                <option value="Transport">Transport</option>
                <option value="Shopping">Shopping</option>
                <option value="Food">Food</option>
            </select>

            <label for="description">Description</label>
            <textarea name="description"></textarea>

            <button type="submit">Create</button>
        </form>
    </div>

    <script src="https://kit.fontawesome.com/23c9e34443.js" crossorigin="anonymous"></script>
</body>

</html>