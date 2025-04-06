<!DOCTYPE html>
<html>

<head>
    <title>Freelancer Registration</title>
    <link rel="stylesheet" type="text/css" href="seller.css">
</head>

<body>
    <h2>Freelancer Registration Form</h2>
    <form action="submit.php" method="post">
        <fieldset>
            <legend>Registration</legend>

            <table>
                <tr>
                    <td><label for="full_name">Full Name:</label></td>
                    <td><input type="text" id="full_name" name="full_name" required></td>
                </tr>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input type="email" id="email" name="email" required></td>
                </tr>
                <tr>
                    <td><label for="password">Password:</label></td>
                    <td><input type="password" id="password" name="password" required></td>
                </tr>
                <tr>
                    <td><label for="confirm_password">Confirm Password:</label></td>
                    <td><input type="password" id="confirm_password" name="confirm_password" required></td>
                </tr>
                <tr>
                    <td><label for="profile_picture">Profile Picture:</label></td>
                    <td><input type="file" id="profile_picture" name="profile_picture" accept="image/*"></td>
                </tr>
                <tr>
                    <td><label for="phone">Phone Number:</label></td>
                    <td><input type="tel" id="phone" name="phone" required></td>
                </tr>
                <tr>
                    <td><label for="dob">Date of Birth:</label></td>
                    <td><input type="date" id="dob" name="dob" required></td>
                </tr>
                <tr>
                    <td><label for="skills">Skill:</label></td>
                    <td>
                        <select id="skills" name="skills" required>
                            <option value="ml">Machine Learning</option>
                            <option value="web_dev">Web Development</option>
                            <option value="graphic_design">Graphic Design</option>
                            <option value="content_writing">Content Writing</option>
                            <option value="seo">SEO</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="portfolio">Upload Portfolio:</label></td>
                    <td><input type="file" id="portfolio" name="portfolio"></td>
                </tr>
                <tr>
                    <td><label for="hours">Available Hours per Week:</label></td>
                    <td><input type="number" id="hours" name="hours" min="1" max="168" required></td>
                </tr>
                <tr>
                    <td>Preferred Withdraw Method:</td>
                    <td>
                        <input type="radio" id="paypal" name="payment" value="paypal" required> <label
                            for="paypal">PayPal</label>
                        <input type="radio" id="bank_transfer" name="payment" value="bank_transfer"> <label
                            for="bank_transfer">Bank Transfer</label>
                        <input type="radio" id="crypto" name="payment" value="crypto"> <label
                            for="crypto">Cryptocurrency</label>
                    </td>
                </tr>
                <tr>
                    <td><label for="about_you">About You:</label></td>
                    <td><textarea id="about_you" name="about_you" rows="4" cols="30" required></textarea></td>
                </tr>
                <tr>
                    <td><label for="terms">Agree to Terms:</label></td>
                    <td><input type="checkbox" id="terms" name="terms" required> I agree to the <a href="terms.php"
                            target="_blank">terms and conditions</a>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="Register">
                        <input type="reset" value="Reset">
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
</body>

</html>
