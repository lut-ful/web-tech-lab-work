<!DOCTYPE html>
<html>

<head>
    <title>Customer Registration</title>
    <link rel="stylesheet" type="text/css" href="customer.css">
</head>

<body>
    <div class="container">
        <h2>Customer Registration Form</h2>
        <form id="customerForm" action="submit.php" method="post" enctype="multipart/form-data">
            <fieldset>
                <legend>Registration</legend>
                
                <table>
                    <tr>
                        <td><label for="full_name">Full Name:</label></td>
                        <td><input type="text" id="full_name" name="full_name" ></td>
                    </tr>
                    <tr>
                        <td><label for="email">Email:</label></td>
                        <td><input type="email" id="email" name="email" ></td>
                    </tr>
                    <tr>
                        <td><label for="phone">Phone Number (Optional):</label></td>
                        <td><input type="tel" id="phone" name="phone" pattern="[0-9]{10,15}" placeholder="Optional (digits only)"></td>
                    </tr>
                    <tr>
                        <td><label for="username">Username:</label></td>
                        <td><input type="text" id="username" name="username" ></td>
                    </tr>
                    <tr>
                        <td><label for="password">Password:</label></td>
                        <td><input type="password" id="password" name="password" ></td>
                    </tr>
                    <tr>
                        <td><label for="confirm_password">Confirm Password:</label></td>
                        <td><input type="password" id="confirm_password" name="confirm_password" ></td>
                    </tr>
                    <tr>
                        <td><label for="profile_picture">Profile Picture:</label></td>
                        <td><input type="file" id="profile_picture" name="profile_picture" accept="image/*"></td>
                    </tr>
                    <tr>
                        <td>Preferred Payment Method (Optional):</td>
                        <td>
                            <input type="radio" id="paypal" name="payment" value="paypal"> 
                            <label for="paypal">PayPal</label>
                            <input type="radio" id="bank_transfer" name="payment" value="bank_transfer"> 
                            <label for="bank_transfer">Bank Transfer</label>
                            <input type="radio" id="crypto" name="payment" value="crypto"> 
                            <label for="crypto">Cryptocurrency</label>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="terms">Agree to Terms:</label></td>
                        <td>
                            <input type="checkbox" id="terms" name="terms" >
                            I agree to the <a href="terms.php" target="_blank">terms and conditions</a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="buttons">
                            <input type="submit" value="Register">
                            <input type="reset" value="Reset">
                            <input type="button" value="Back to home" onclick="window.location.href='index.php'">
                        </td>
                    </tr>
                </table>
            </fieldset>
        </form>
    </div>


    <script src="customer.js"></script>
</body>

</html>
