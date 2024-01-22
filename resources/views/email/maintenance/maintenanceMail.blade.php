<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Society Management Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .invoice {
            width: 80%;
            margin: 20px auto;
            border: 1px solid #ccc;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .invoice-table, .invoice-table th, .invoice-table td {
            border: 1px solid #ddd;
        }

        .invoice-table th, .invoice-table td {
            padding: 12px;
            text-align: left;
        }

        .invoice-total {
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>
<body>

    <div class="invoice">
        <div class="invoice-header">
            <p>Invoice Date: January 17, 2024</p>
            <p>{{
            $title
            }}<p>
        </div> 
    </div>

</body>
</html>
