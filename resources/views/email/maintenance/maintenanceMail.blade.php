<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Society Management</title>
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
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

<!-- START HEADER/BANNER -->

		<tbody><tr>
			<td align="center">
				<table class="col-600" width="600" border="0" align="center" cellpadding="0" cellspacing="0">
					<tbody>
                        <tr>
							<table class="col-600" width="600" height="400" border="0" align="center" cellpadding="0" cellspacing="0">

								<tbody><tr>
									<td height="40"></td>
								</tr>


								<tr>
									<td align="center" style="line-height: 0px;">
										<img style="display:block; line-height:0px; font-size:0px; border:0px;" src="{{ asset('storage/logo/' . $logo) }}" width="109" height="103" alt="logo">
									</td>
								</tr>
								<tr>
									<td align="center" style="font-family: 'Raleway', sans-serif; font-size:37px; color:#000000; line-height:24px; font-weight: bold; letter-spacing: 7px;">
									<span style="font-family: 'Raleway', sans-serif; font-size:37px; color:#000000; line-height:39px; font-weight: 300; letter-spacing: 7px;">{{$company_name}}</span>
									</td>
								</tr>
								<tr>
									<td align="center" style="font-family: 'Lato', sans-serif; font-size:15px; color:#000000; line-height:24px; font-weight: 300;">
										A creative email template for your email campaigns, promotions <br>and products across different email platforms.
									</td>
								</tr>
								<tr>
									<td height="50"></td>
								</tr>
							</tbody></table>
						
					</tr>
				</tbody></table>
			</td>
		</tr>


<!-- END HEADER/BANNER -->

<!-- START FOOTER -->

{!! $footer !!}

<!-- END FOOTER -->
				
</tbody></table>
</body>
</html>
