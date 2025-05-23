<?php
include "../../control/seller/reg_process.php";
// include "../../control/seller/validate_seller.php";
// Define helper functions if not already defined
function displayError($field, $errors)
{
    return isset($errors[$field]) ? "<div style='color: red;'>{$errors[$field]}</div>" : '';
}
function retainValue($field, $values)
{
    return htmlspecialchars($values[$field] ?? '');
}
function retainChecked($field, $value, $values)
{
    return ($values[$field] ?? '') === $value ? 'checked' : '';
}
function retainSelected($field, $value, $values)
{
    return in_array($value, $values[$field] ?? []) ? 'selected' : '';
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Freelancer Registration</title>
    <link rel="stylesheet" type="text/css" href="css/seller_reg.css">
    <!-- <script src="seller.js" defer></script> -->
</head>

<body>
    <h2>Freelancer Registration Form</h2>
    <!-- Added enctype for file uploads, changed action to self -->
    <form action="" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Registration</legend>

            <table>
                <tr>
                    <td><label for="full_name">Full Name:</label></td>
                    <td>
                        <input type="text" id="full_name" name="full_name"
                            value="<?= retainValue('full_name', $values) ?>">
                        <?= displayError('full_name', $errors) ?>
                    </td>
                </tr>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td>
                        <input type="email" id="email" name="email" value="<?= retainValue('email', $values) ?>">
                        <?= displayError('email', $errors) ?>
                    </td>
                </tr>
                <tr>
                    <td><label for="password">Password:</label></td>
                    <td>
                        <input type="password" id="password" name="password">
                        <?= displayError('password', $errors) ?>
                    </td>
                </tr>
                <tr>
                    <td><label for="confirm_password">Confirm Password:</label></td>
                    <td>
                        <input type="password" id="confirm_password" name="confirm_password">
                        <?= displayError('confirm_password', $errors) ?>
                    </td>
                </tr>
                <tr>
                    <td><label for="profile_picture">Profile Picture:</label></td>
                    <td>
                        <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
                        <?= displayError('profile_picture', $errors) ?>
                    </td>
                </tr>
                <tr>
                    <td><label for="phone">Phone Number:</label></td>
                    <td>
                        <input type="tel" id="phone" name="phone" value="<?= retainValue('phone', $values) ?>">
                        <?= displayError('phone', $errors) ?>
                    </td>
                </tr>
                <tr>
                    <td><label for="dob">Date of Birth:</label></td>
                    <td>
                        <input type="date" id="dob" name="dob" value="<?= retainValue('dob', $values) ?>">
                        <?= displayError('dob', $errors) ?>
                    </td>
                </tr>
                <tr>
                    <td><label for="skills">Skill:</label></td>
                    <td>
                        <select id="skills" name="skills[]" multiple>
                            <option value="ml" <?= retainSelected('skills', 'ml', $values) ?>>Machine Learning</option>
                            <option value="web_dev" <?= retainSelected('skills', 'web_dev', $values) ?>>Web Development
                            </option>
                            <option value="graphic_design" <?= retainSelected('skills', 'graphic_design', $values) ?>>
                                Graphic Design</option>
                            <option value="content_writing" <?= retainSelected('skills', 'content_writing', $values) ?>>
                                Content Writing</option>
                            <option value="seo" <?= retainSelected('skills', 'seo', $values) ?>>SEO</option>
                        </select>
                        <?= displayError('skills', $errors) ?>
                    </td>
                </tr>
                <tr>
                    <td><label for="portfolio">Upload Portfolio:</label></td>
                    <td>
                        <input type="file" id="portfolio" name="portfolio">
                        <?= displayError('portfolio', $errors) ?>
                    </td>
                </tr>
                <tr>
                    <td><label for="hours">Available Hours per Week:</label></td>
                    <td>
                        <input type="number" id="hours" name="hours" min="1" max="168"
                            value="<?= retainValue('hours', $values) ?>">
                        <?= displayError('hours', $errors) ?>
                    </td>
                </tr>
                <tr>
                    <td>Preferred Withdraw Method:</td>
                    <td>
                        <input type="radio" id="paypal" name="payment" value="paypal" <?= retainChecked('payment', 'paypal', $values) ?>> <label for="paypal">PayPal</label>
                        <input type="radio" id="bank_transfer" name="payment" value="bank_transfer"
                            <?= retainChecked('payment', 'bank_transfer', $values) ?>> <label for="bank_transfer">Bank
                            Transfer</label>
                        <input type="radio" id="crypto" name="payment" value="crypto" <?= retainChecked('payment', 'crypto', $values) ?>> <label for="crypto">Cryptocurrency</label>
                        <?= displayError('payment', $errors) ?>
                    </td>
                </tr>
                <tr>
                    <td><label for="about_you">About You:</label></td>
                    <td>
                        <textarea id="about_you" name="about_you" rows="4"
                            cols="30"><?= retainValue('about_you', $values) ?></textarea>
                        <?= displayError('about_you', $errors) ?>
                    </td>
                </tr>
                <tr>
                    <td><label for="terms">Agree to Terms:</label></td>
                    <td>
                        <input type="checkbox" id="terms" name="terms" <?= !empty($values['terms']) ? 'checked' : '' ?>>
                        I agree to the <a href="terms.php" target="_blank">terms and conditions</a>
                        <?= displayError('terms', $errors) ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="Register">
                        <input type="reset" value="Reset">
                        <a href="../index.php"><button type="button">Cancel</button></a>
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
</body>

</html>