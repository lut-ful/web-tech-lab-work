<?php
$errors = [];
$values = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../control/validate_seller.php';
    $result = validateSellerForm($_POST, $_FILES);
    $errors = $result['errors'];
    $values = $result['values'];
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Freelancer Registration</title>
    <link rel="stylesheet" type="text/css" href="seller.css">
    <script src="seller.js" defer></script>
</head>

<body>
    <h2>Freelancer Registration Form</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Registration</legend>

            <table>
                <tr>
                    <td><label for="full_name">Full Name:</label></td>
                    <td>
                        <input type="text" id="full_name" name="full_name" value="<?= htmlspecialchars($values['full_name'] ?? '') ?>">
                        <div style="color: red;"><?= $errors['full_name'] ?? '' ?></div>
                    </td>
                </tr>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td>
                        <input type="email" id="email" name="email" value="<?= htmlspecialchars($values['email'] ?? '') ?>">
                        <div style="color: red;"><?= $errors['email'] ?? '' ?></div>
                    </td>
                </tr>
                <tr>
                    <td><label for="password">Password:</label></td>
                    <td>
                        <input type="password" id="password" name="password">
                        <div style="color: red;"><?= $errors['password'] ?? '' ?></div>
                    </td>
                </tr>
                <tr>
                    <td><label for="confirm_password">Confirm Password:</label></td>
                    <td>
                        <input type="password" id="confirm_password" name="confirm_password">
                        <div style="color: red;"><?= $errors['confirm_password'] ?? '' ?></div>
                    </td>
                </tr>
                <tr>
                    <td><label for="profile_picture">Profile Picture:</label></td>
                    <td>
                        <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
                        <div style="color: red;"><?= $errors['profile_picture'] ?? '' ?></div>
                    </td>
                </tr>
                <tr>
                    <td><label for="phone">Phone Number:</label></td>
                    <td>
                        <input type="tel" id="phone" name="phone" value="<?= htmlspecialchars($values['phone'] ?? '') ?>">
                        <div style="color: red;"><?= $errors['phone'] ?? '' ?></div>
                    </td>
                </tr>
                <tr>
                    <td><label for="dob">Date of Birth:</label></td>
                    <td>
                        <input type="date" id="dob" name="dob" value="<?= htmlspecialchars($values['dob'] ?? '') ?>">
                        <div style="color: red;"><?= $errors['dob'] ?? '' ?></div>
                    </td>
                </tr>
                <tr>
                    <td><label for="skills">Skill:</label></td>
                    <td>
                        <select id="skills" name="skills[]" multiple>
                            <option value="ml" <?= in_array('ml', $values['skills'] ?? []) ? 'selected' : '' ?>>Machine Learning</option>
                            <option value="web_dev" <?= in_array('web_dev', $values['skills'] ?? []) ? 'selected' : '' ?>>Web Development</option>
                            <option value="graphic_design" <?= in_array('graphic_design', $values['skills'] ?? []) ? 'selected' : '' ?>>Graphic Design</option>
                            <option value="content_writing" <?= in_array('content_writing', $values['skills'] ?? []) ? 'selected' : '' ?>>Content Writing</option>
                            <option value="seo" <?= in_array('seo', $values['skills'] ?? []) ? 'selected' : '' ?>>SEO</option>
                        </select>
                        <div style="color: red;"><?= $errors['skills'] ?? '' ?></div>
                    </td>
                </tr>
                <tr>
                    <td><label for="portfolio">Upload Portfolio:</label></td>
                    <td>
                        <input type="file" id="portfolio" name="portfolio">
                        <div style="color: red;"><?= $errors['portfolio'] ?? '' ?></div>
                    </td>
                </tr>
                <tr>
                    <td><label for="hours">Available Hours per Week:</label></td>
                    <td>
                        <input type="number" id="hours" name="hours" min="1" max="168" value="<?= htmlspecialchars($values['hours'] ?? '') ?>">
                        <div style="color: red;"><?= $errors['hours'] ?? '' ?></div>
                    </td>
                </tr>
                <tr>
                    <td>Preferred Withdraw Method:</td>
                    <td>
                        <input type="radio" id="paypal" name="payment" value="paypal" <?= ($values['payment'] ?? '') === 'paypal' ? 'checked' : '' ?>> <label for="paypal">PayPal</label>
                        <input type="radio" id="bank_transfer" name="payment" value="bank_transfer" <?= ($values['payment'] ?? '') === 'bank_transfer' ? 'checked' : '' ?>> <label for="bank_transfer">Bank Transfer</label>
                        <input type="radio" id="crypto" name="payment" value="crypto" <?= ($values['payment'] ?? '') === 'crypto' ? 'checked' : '' ?>> <label for="crypto">Cryptocurrency</label>
                        <div style="color: red;"><?= $errors['payment'] ?? '' ?></div>
                    </td>
                </tr>
                <tr>
                    <td><label for="about_you">About You:</label></td>
                    <td>
                        <textarea id="about_you" name="about_you" rows="4" cols="30"><?= htmlspecialchars($values['about_you'] ?? '') ?></textarea>
                        <div style="color: red;"><?= $errors['about_you'] ?? '' ?></div>
                    </td>
                </tr>
                <tr>
                    <td><label for="terms">Agree to Terms:</label></td>
                    <td>
                        <input type="checkbox" id="terms" name="terms" <?= !empty($values['terms']) ? 'checked' : '' ?>> I agree to the <a href="terms.php" target="_blank">terms and conditions</a>
                        <div style="color: red;"><?= $errors['terms'] ?? '' ?></div>
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
