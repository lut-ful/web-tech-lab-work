<!DOCTYPE html>
<html>
<head>
    <title>Customer Registration</title>
    <link rel="stylesheet" href="customer.css">
</head>
<body>
    <div class="container">
        <h2>Customer Registration Form</h2>

        <form action="caction.php" method="post" enctype="multipart/form-data">
            <fieldset>
                <legend>Registration</legend>
                <table>
                    <tr>
                        <td><label for="full_name">Full Name:</label></td>
                        <td>
                            <input type="text" id="full_name" name="full_name" value="">
                            <div class="error"><?php echo $_GET['errors']['full_name'] ?? ''; ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="email">Email:</label></td>
                        <td>
                            <input type="text" id="email" name="email" value="">
                            <div class="error"><?php echo $_GET['errors']['email'] ?? ''; ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="phone">Phone Number (Optional):</label></td>
                        <td>
                            <input type="tel" id="phone" name="phone" placeholder="Optional (digits only)">
                            <div class="error"><?php echo $_GET['errors']['phone'] ?? ''; ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="username">Username:</label></td>
                        <td>
                            <input type="text" id="username" name="username" value="">
                            <div class="error"><?php echo $_GET['errors']['username'] ?? ''; ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="password">Password:</label></td>
                        <td>
                            <input type="password" id="password" name="password">
                            <div class="error"><?php echo $_GET['errors']['password'] ?? ''; ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="confirm_password">Confirm Password:</label></td>
                        <td>
                            <input type="password" id="confirm_password" name="confirm_password">
                            <div class="error"><?php echo $_GET['errors']['confirm_password'] ?? ''; ?></div>
                        </td>
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
                            <div class="error"><?php echo $_GET['errors']['payment'] ?? ''; ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="terms">Agree to Terms:</label></td>
                        <td>
                            <input type="checkbox" id="terms" name="terms">
                            <label for="terms">I agree to the <a href="terms.php" target="_blank">terms and conditions</a></label>
                            <div class="error"><?php echo $_GET['errors']['terms'] ?? ''; ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="buttons">
                            <input type="submit" value="Register">
                            <input type="reset" value="Reset">
                        </td>
                    </tr>
                </table>
            </fieldset>
        </form>
    </div> 
</body>
</html>
